<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jobapplication;

class CompanyController extends Controller
{
    public function index()
    {
        return view('company/index'); // Mengarahkan ke view welcome.blade.php
    }
    public function portofolio()
    {
        return view('company/portofolio'); // Mengarahkan ke view welcome.blade.php
    }
    public function penjualan_perbaikan()
    {
        return view('company/penjualandanperbaikan'); // Mengarahkan ke view welcome.blade.php
    }
    public function layanan_berkala()
    {
        return view('company/layanan_berkala'); // Mengarahkan ke view welcome.blade.php
    }
    public function layanan_borongan()
    {
        return view('company/layanan_borongan'); // Mengarahkan ke view welcome.blade.php
    }
    public function maintenance_contract()
    {
        return view('company/maintenance_contract'); // Mengarahkan ke view welcome.blade.php
    }
    public function profil_perusahaan()
    {
        return view('company/profil_perusahaan'); // Mengarahkan ke view welcome.blade.php
    }
    public function divisi_kerja()
    {
        return view('company/divisi_kerja'); // Mengarahkan ke view welcome.blade.php
    }
    public function kontak()
    {
        return view('company/kontak'); // Mengarahkan ke view welcome.blade.php
    }
    public function karir()
    {
        $jobapplications = Jobapplication::latest()->paginate(10)->where('status', 'Aktif');
        return view('company/karir', compact('jobapplications'));
    }
}
