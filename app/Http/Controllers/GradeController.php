<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role !== 'student') {
            abort(403, 'Hanya siswa yang dapat melihat halaman ini.');
        }

        // Ambil data nilai dengan relasi subject, urutkan berdasarkan semester dan nama mata pelajaran
        $grades = $user->grades()
            ->with('subject')
            ->orderBy('semester')
            ->get()
            ->sortBy('subject.name'); // Sort subjects alphabetically within grouped collection later if needed, but here simple sort

        // Grouping berdasarkan semester
        $gradesBySemester = $grades->groupBy('semester')->sortKeys();

        // Siapkan data untuk chart dan statistik
        $chartData = [
            'labels' => [],
            'averages' => [],
        ];

        foreach ($gradesBySemester as $semester => $data) {
            $chartData['labels'][] = 'Semester ' . $semester;
            $chartData['averages'][] = round($data->avg('score'), 2);
        }

        return view('grades.index', compact('user', 'gradesBySemester', 'chartData'));
    }
}
