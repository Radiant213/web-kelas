<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileSetupController extends Controller
{
    // 1. FUNGSI INPUT (TAMPILAN FORM)
    public function create()
    {
        $user = Auth::user();
        // Ambil data profil kalau user mau EDIT, kalau baru INPUT dia bakal null
        $profile = $user->studentProfile;

        return view('profile.setup', compact('profile'));
    }

    // 2. FUNGSI SIMPAN (INPUT & EDIT JADI SATU)
    public function store(Request $request)
    {
        // Validasi inputan biar gak asal-asalan
        $request->validate([
            'full_name' => 'required|string|max:255',
            'place_of_birth' => 'required|string|max:100',
            'date_of_birth' => 'required|date',
            'origin_school' => 'required|string|max:100',
            'address' => 'required|string',
            'child_number' => 'required|integer|min:1',
        ]);

        $user = Auth::user();

        // updateOrCreate: Kalau belum ada dia create (Input), kalau udah ada dia update (Edit)
        $user->studentProfile()->updateOrCreate(
            ['user_id' => $user->id], // Kunci pencarian
            [
                'full_name' => $request->full_name,
                'place_of_birth' => $request->place_of_birth,
                'date_of_birth' => $request->date_of_birth,
                'origin_school' => $request->origin_school,
                'address' => $request->address,
                'child_number' => $request->child_number,

                'is_completed' => true,
            ]
        );

        return redirect()->route('dashboard')->with('success', 'Biodata berhasil disimpan!');
    }
}