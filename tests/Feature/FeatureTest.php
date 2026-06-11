<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use App\Models\Event;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class FeatureTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('shield:generate', [
            '--all' => true,
            '--panel' => 'admin',
            '--option' => 'permissions',
        ]);

        $this->seed();

        $superAdmin = Role::where('name', 'super_admin')->first();
        $editor = Role::where('name', 'editor')->first();
        $bendahara = Role::where('name', 'bendahara')->first();

        if ($superAdmin) {
            $superAdmin->syncPermissions(Permission::all());
        }
        if ($editor) {
            $editor->syncPermissions(
                Permission::where('name', 'like', '%_post')
                    ->orWhere('name', 'like', '%_category')
                    ->orWhere('name', 'like', '%_event')
                    ->orWhere('name', 'like', '%_gallery')
                    ->orWhere('name', 'like', '%_gallery_item')
                    ->orWhere('name', 'like', '%_streaming')
                    ->orWhere('name', 'like', '%_announcement')
                    ->orWhere('name', 'like', '%_official')
                    ->get()
            );
        }
        if ($bendahara) {
            $bendahara->syncPermissions(
                Permission::where('name', 'like', '%_donation_info')->get()
            );
        }
    }

    public function test_home_page_returns_200()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_profil_page_returns_200()
    {
        $response = $this->get('/profil');

        $response->assertStatus(200);
    }

    public function test_jadwal_shalat_page_returns_200()
    {
        $response = $this->get('/jadwal-shalat');

        $response->assertStatus(200);
    }

    public function test_donasi_page_returns_200()
    {
        $response = $this->get('/donasi');

        $response->assertStatus(200);
    }

    public function test_kontak_page_returns_200()
    {
        $response = $this->get('/kontak');

        $response->assertStatus(200);
    }

    public function test_berita_page_returns_200()
    {
        Post::factory()->count(5)->create();

        $response = $this->get('/berita');

        $response->assertStatus(200);
    }

    public function test_berita_detail_page_returns_200()
    {
        $post = Post::factory()->create([
            'title' => 'Test Berita',
            'slug' => 'test-berita',
        ]);

        $response = $this->get('/berita/test-berita');

        $response->assertStatus(200);
    }

    public function test_berita_detail_returns_404_for_unknown_slug()
    {
        $response = $this->get('/berita/tidak-ada');

        $response->assertStatus(404);
    }

    public function test_kegiatan_page_returns_200()
    {
        Event::factory()->count(3)->create();

        $response = $this->get('/kegiatan');

        $response->assertStatus(200);
    }

    public function test_galeri_page_returns_200()
    {
        $response = $this->get('/galeri');

        $response->assertStatus(200);
    }

    public function test_streaming_page_returns_200()
    {
        $response = $this->get('/streaming');

        $response->assertStatus(200);
    }

    public function test_admin_login_page_returns_200()
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
    }

    public function test_admin_dashboard_redirects_to_login_when_unauthenticated()
    {
        $response = $this->get('/admin');

        $response->assertStatus(302);
        $response->assertRedirect('/admin/login');
    }

    public function test_admin_dashboard_accessible_when_authenticated()
    {
        $user = User::where('email', 'admin@masjidalkautsar.id')->first();

        $this->assertTrue($user->hasRole('super_admin'));

        $this->actingAs($user, 'web');

        $this->assertTrue(auth()->check());
        $this->assertEquals($user->id, auth()->id());

        $response = $this->get('/admin');

        $response->assertStatus(200);
    }

    public function test_admin_posts_page_accessible_by_editor()
    {
        $user = User::where('email', 'admin@masjidalkautsar.id')->first();
        $user->syncRoles('editor');
        $user = $user->fresh();

        $this->assertTrue($user->hasRole('editor'));
        $this->assertTrue($user->can('view_post'));

        $this->actingAs($user, 'web');

        $response = $this->get('/admin/posts');

        $response->assertStatus(200);
    }

    public function test_home_page_has_seo_meta_tags()
    {
        $response = $this->get('/');

        $response->assertSee('<meta name="description"', false);
        $response->assertSee('<meta property="og:', false);
        $response->assertSee('<meta name="twitter:card"', false);
        $response->assertSee('<link rel="canonical"', false);
    }

    public function test_home_page_has_security_headers()
    {
        $response = $this->get('/');

        $response->assertHeader('X-Frame-Options', 'DENY');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->assertHeader('X-XSS-Protection', '1; mode=block');
    }

    public function test_robots_txt_exists()
    {
        $this->assertFileExists(public_path('robots.txt'));

        $content = file_get_contents(public_path('robots.txt'));
        $this->assertStringContainsString('Disallow: /admin', $content);
    }

    public function test_sitemap_xml_exists()
    {
        $this->artisan('sitemap:generate');

        $this->assertFileExists(public_path('sitemap.xml'));
    }

    public function test_admin_users_page_not_accessible_by_editor()
    {
        $user = User::where('email', 'admin@masjidalkautsar.id')->first();
        $user->syncRoles('editor');
        $user = $user->fresh();

        $this->assertFalse($user->can('view_user'));

        $response = $this->actingAs($user, 'web')->get('/admin/users');

        $response->assertStatus(403);
    }

    public function test_admin_donation_infos_page_accessible_by_bendahara()
    {
        $user = User::where('email', 'admin@masjidalkautsar.id')->first();
        $user->syncRoles('bendahara');
        $user = $user->fresh();

        $this->assertTrue($user->hasRole('bendahara'));
        $this->assertTrue($user->can('view_donation_info'));
        $this->assertFalse($user->can('view_post'));

        $this->actingAs($user, 'web');

        $response = $this->get('/admin/donation-infos');

        $response->assertStatus(200);
    }

    public function test_admin_posts_page_not_accessible_by_bendahara()
    {
        $user = User::where('email', 'admin@masjidalkautsar.id')->first();
        $user->syncRoles('bendahara');
        $user = $user->fresh();

        $this->assertFalse($user->can('view_post'));

        $response = $this->actingAs($user, 'web')->get('/admin/posts');

        $response->assertStatus(403);
    }

    public function test_admin_redirect_uses_admin_prefix()
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('Masjid Al-Kautsar');
    }
}
