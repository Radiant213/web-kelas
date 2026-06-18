<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login beserta profilnya (jika ada)
        $user = auth()->check() ? auth()->user()->load('studentProfile') : null;
        
        // Ambil semua siswa dengan profil mereka, diurutkan berdasarkan NIS
        $students = \App\Models\User::where('role', 'student')
            ->with('studentProfile')
            ->orderBy('username', 'asc')
            ->get();
        
        // Ambil pengumuman aktif terbaru
        $announcements = \App\Models\Announcement::where('is_active', true)
            ->with('author')
            ->latest()
            ->take(3) // Ambil 3 pengumuman terbaru
            ->get();
        
        // Ambil data wali kelas (role teacher)
        $teacher = \App\Models\User::where('role', 'teacher')->first();

        // Ambil pengaturan umum (gambar hero, about, teacher, quote)
        $settings = \App\Models\GeneralSetting::first();

        // Ambil data struktur kelas dari database
        $classStructures = \App\Models\ClassStructure::with(['student', 'user'])
            ->orderBy('order')
            ->get();

        // Grouping data untuk mempermudah tampilan di view
        $structure = [
            'ketua' => $classStructures->where('role', 'Ketua')->first(),
            'wakil' => $classStructures->where('role', 'Wakil Ketua')->first(),
            'sekertaris' => $classStructures->filter(function ($item) {
                return \Illuminate\Support\Str::startsWith($item->role, 'Sekertaris');
            }),
            'bendahara' => $classStructures->filter(function ($item) {
                return \Illuminate\Support\Str::startsWith($item->role, 'Bendahara');
            }),
            'tim_it' => $classStructures->filter(function ($item) {
                return \Illuminate\Support\Str::startsWith($item->role, 'Tim IT');
            }),
            'tim_pdd' => $classStructures->filter(function ($item) {
                return \Illuminate\Support\Str::startsWith($item->role, 'Tim PDD');
            }),
        ];
        
        return view('dashboard', compact('user', 'students', 'announcements', 'teacher', 'structure', 'settings'));
    }

    public function showStudent($id)
    {
        $student = \App\Models\User::with('studentProfile')
            ->where('id', $id)
            ->where('role', 'student')
            ->firstOrFail();
        
        return view('student-profile', compact('student'));
    }
}
