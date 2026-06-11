<?php

namespace App\Http\Controllers;

use App\Models\MosqueProfile;
use App\Models\Official;
use App\Models\DonationInfo;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function profil()
    {
        return view('profil');
    }

    public function jadwalShalat()
    {
        return view('jadwal-shalat');
    }

    public function donasi()
    {
        return view('donasi');
    }

    public function kontak()
    {
        return view('kontak');
    }
}