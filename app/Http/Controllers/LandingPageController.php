<?php

namespace App\Http\Controllers;

use App\Models\Iklan;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function halamanBeranda()
    {


        $iklan = Iklan::with(['detail_iklan' => function ($query) {
            $query->where('status_iklan', 'aktif')
                ->where('tanggal_mulai', '<=', now())
                ->where('tanggal_akhir', '>=', now());
        }])
            ->orderBy('created_at', 'desc')

            ->get();
        return view('landing-page.index', compact('iklan'));
    }

    public function halaman_destinasi()
    {
        return view('landing-page.destinasi');
    }
    public function halaman_sewabarang()
    {
        return view('landing-page.sewaBarang');
    }
    public function halaman_testimoni()
    {
        return view('landing-page.testimoni');
    }
}
