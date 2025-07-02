<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PengaturanController extends Controller
{
    public function __construct()
    {
        // Pastikan semua method hanya bisa diakses oleh user yang sudah login
        $this->middleware('auth');
    }

    // Halaman utama pengaturan, bisa berisi form site_name, tahun akademik, profil user, dsb
    public function index()
    {
        // Ambil data setting via helper setting() atau model Setting, contoh:
        $siteName = setting('site_name', 'SIAKAD Admin');
        $tahunAktif = setting('tahun_akademik', '2024/2025');
        $user = Auth::user();

        return view('pengaturan.index', compact('siteName', 'tahunAktif', 'user'));
    }

    // Update site name
    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
        ]);

        setting(['site_name' => $request->site_name]);

        return back()->with('success', 'Pengaturan berhasil diperbarui.');
    }

    // Update tahun akademik aktif
    public function updateTahunAkademik(Request $request)
    {
        $request->validate([
            'tahun_akademik' => 'required|string|max:20',
        ]);

        setting(['tahun_akademik' => $request->tahun_akademik]);

        return back()->with('success', 'Tahun akademik berhasil diubah.');
    }

    // Update profil user (nama)
    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user->name = $request->name;
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    // Update password user
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        // Cek password lama
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors(['current_password' => 'Password lama salah.']);
        }

        Auth::user()->update(['password' => bcrypt($request->password)]);

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}
