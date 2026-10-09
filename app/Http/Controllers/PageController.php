<?php

namespace App\Http\Controllers;

/**
 * Controller khusus halaman (Blade).
 * Semua data diambil lewat API (Sanctum Bearer token) dari sisi browser,
 * jadi controller ini hanya merender view.
 */
class PageController extends Controller
{
    // Publik
    public function landing()
    {
        return view('landing.index');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register()
    {
        return view('auth.register');
    }

    // Aplikasi (dijaga di sisi klien oleh js/shell.js)
    public function dashboard()
    {
        return view('dashboard.index');
    }

    public function reports()
    {
        return view('reports.index');
    }

    public function reportCreate()
    {
        return view('reports.create');
    }

    public function reportShow(int $id)
    {
        return view('reports.detail', ['id' => $id]);
    }

    public function facilities()
    {
        return view('facilities.index');
    }

    public function categories()
    {
        return view('categories.index');
    }

    public function users()
    {
        return view('users.index');
    }

    public function profile()
    {
        return view('profile.index');
    }
}
