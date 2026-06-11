# Masjid Al-Kautsar Green Jagakarsa

Website resmi Masjid Al-Kautsar Green Jagakarsa — platform informasi ibadah, donasi, kegiatan, dan berita masjid.

## Tech Stack

- **Backend:** Laravel 12 (PHP 8.2+)
- **Admin Panel:** Filament 5
- **CSS:** Tailwind CSS 4.3
- **JS:** Alpine.js 3.15
- **Database:** MySQL 8
- **Auth:** Spatie Laravel Permission + Filament Shield

## Fitur

- Halaman publik: Beranda, Profil, Jadwal Shalat, Donasi, Kontak
- Manajemen konten: Berita, Kategori, Acara, Galeri, Streaming, Pengumuman
- Manajemen data: Profil Masjid, Pengurus, Info Donasi
- Admin Panel dengan RBAC (super_admin, editor, bendahara)
- OWASP Security: Rate limiting, Security headers, CSRF, Session management
- SEO: Meta tags, Open Graph, Sitemap XML, robots.txt
- Performance: Caching, Image compression, Lazy loading

## Deployment Checklist

```bash
# 1. Clone & masuk direktori
git clone https://github.com/nekoport/Al-Kautsar.git
cd Al-Kautsar

# 2. Install dependencies
composer install --no-dev --optimize-autoloader
npm install && npm run build

# 3. Environment
cp .env.example .env
# Edit .env: DB credentials, APP_URL, APP_KEY nanti

# 4. Generate key & migrate
php artisan key:generate
php artisan migrate --force
php artisan db:seed --class=DatabaseSeeder --force

# 5. Storage link & optimize
php artisan storage:link
php artisan optimize

# 6. Generate sitemap
php artisan sitemap:generate

# 7. Set permissions (Linux)
# chmod -R 775 storage bootstrap/cache
# chown -R www-data:www-data storage bootstrap/cache
```

## Admin Panel

- URL: `https://your-domain.com/admin`
- Credentials: diset via `ADMIN_PASSWORD` di `.env` saat pertama deploy (lihat `.env.example`)

### Roles

| Role | Akses |
|------|-------|
| super_admin | Semua resource (full access) |
| editor | Post, Category, Event, Gallery, GalleryItem, Streaming, Announcement, Official |
| bendahara | DonationInfo only |

## Security

- HTTPS force di production via `URL::forceScheme()`
- Security headers: X-Frame-Options, X-Content-Type-Options, Referrer-Policy, HSTS
- Rate limiter login: 5 attempts/menit per IP
- Session lifetime: 120 menit, secure cookie, http_only, same_site=strict
- CRUD activity logging ke channel 'admin'
- Login failure logging ke channel 'admin'

## Maintenance

```bash
# Generate sitemap (cron: daily recommended)
php artisan sitemap:generate

# Clear cache
php artisan optimize:clear

# Backup database (contoh)
mysqldump -u user -p masjid_alkautsar > backup_$(date +%Y%m%d).sql
```

## License

Hak cipta milik Masjid Al-Kautsar Green Jagakarsa.
