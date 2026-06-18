<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script>
            const theme = localStorage.getItem('theme') || 'system';
            if (theme === 'dark' || (theme === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        </script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <main>
                <!-- Background Decoration -->
                <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
                    <div class="absolute -top-[20%] -right-[10%] w-[70rem] h-[70rem] bg-purple-100/40 dark:bg-purple-900/10 rounded-full blur-3xl opacity-60 mix-blend-multiply dark:mix-blend-lighten animate-blob"></div>
                    <div class="absolute -bottom-[20%] -left-[10%] w-[70rem] h-[70rem] bg-indigo-100/40 dark:bg-indigo-900/10 rounded-full blur-3xl opacity-60 mix-blend-multiply dark:mix-blend-lighten animate-blob animation-delay-2000"></div>
                </div>

                <div class="fixed top-4 left-4 z-50">
                    <a href="{{ route('profile.show') }}" class="group flex items-center gap-2 px-4 py-2 bg-white/80 dark:bg-gray-800/80 backdrop-blur-md border border-white/20 dark:border-gray-700 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <svg class="w-5 h-5 text-gray-600 dark:text-gray-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span class="text-sm font-bold text-gray-600 dark:text-gray-300 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors hidden group-hover:block">Kembali</span>
                    </a>
                </div>

                <div class="py-6 relative">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
                        
                        <!-- Top Section: Profile & Chart Grid -->
                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                            
                            <!-- Hero User Profile Card -->
                            <div class="lg:col-span-1 relative group h-full">
                                <div class="absolute -inset-1 bg-gradient-to-r from-blue-600 to-purple-600 rounded-3xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                                <div class="relative h-full bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl border border-white/20 dark:border-gray-700 rounded-3xl p-6 shadow-2xl flex flex-col items-center text-center transform transition-all hover:scale-[1.01]">
                                    
                                    <!-- Avatar Area -->
                                    <div class="relative shrink-0 mb-4">
                                        <div class="w-24 h-24 rounded-full p-1 bg-gradient-to-br from-blue-500 to-purple-600 shadow-xl">
                                             @if(optional($user->studentProfile)->photo)
                                                <img src="{{ asset('storage/photos/' . $user->studentProfile->photo) }}" class="w-full h-full object-cover rounded-full border-4 border-white dark:border-gray-800" alt="{{ $user->studentProfile?->full_name ?? $user->username }}">
                                            @else
                                                <div class="w-full h-full rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center text-4xl font-extrabold text-white border-2 border-white dark:border-gray-800">
                                                    {{ strtoupper(substr($user->studentProfile?->full_name ?? $user->username, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="absolute bottom-0 right-1 w-6 h-6 bg-green-500 rounded-full border-4 border-white dark:border-gray-800 flex items-center justify-center shadow-lg" title="Status Aktif">
                                            <svg class="w-3 h-3 text-white" style="width: 0.75rem; height: 0.75rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                        </div>
                                    </div>

                                    <!-- Info Area -->
                                    <div class="w-full">
                                        <h2 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight leading-tight">{{ $user->studentProfile?->full_name ?? $user->username }}</h2>
                                        @php
                                            $overallAvg = collect($gradesBySemester)->flatten()->avg('score');
                                            $title = 'Siswa Aktif';
                                            if ($overallAvg >= 90) {
                                                $title = 'Siswa Berprestasi';
                                            } elseif ($overallAvg >= 80) {
                                                $title = 'Siswa Teladan';
                                            }
                                        @endphp
                                        <p class="text-blue-500 font-bold uppercase tracking-widest text-xs mt-1 mb-4">{{ $title }}</p>
                                        
                                        <div class="grid grid-cols-3 gap-3 text-left">
                                            <div class="bg-gray-50 dark:bg-gray-700/50 p-3 rounded-xl border border-gray-100 dark:border-gray-600/50">
                                                <p class="text-[10px] text-gray-400 uppercase font-bold">No. Absen</p>
                                                @php
                                                    $absen = '-';
                                                    if ($user->studentProfile) {
                                                        $absen = \App\Models\Student::orderBy('full_name')->pluck('id')->search($user->studentProfile->id);
                                                        $absen = $absen !== false ? $absen + 1 : '-';
                                                    }
                                                @endphp
                                                <p class="text-sm font-bold text-gray-800 dark:text-gray-100">{{ $absen }}</p>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-gray-700/50 p-3 rounded-xl border border-gray-100 dark:border-gray-600/50">
                                                <p class="text-[10px] text-gray-400 uppercase font-bold">NIS</p>
                                                <p class="text-sm font-bold text-gray-800 dark:text-gray-100">{{ $user->username }}</p>
                                            </div>
                                            <div class="bg-gray-50 dark:bg-gray-700/50 p-3 rounded-xl border border-gray-100 dark:border-gray-600/50">
                                                <p class="text-[10px] text-gray-400 uppercase font-bold">Kelas</p>
                                                <p class="text-sm font-bold text-gray-800 dark:text-gray-100">XI PPLG 2</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Stats Chart Section -->
                            <div class="lg:col-span-2 bg-white/70 dark:bg-gray-800/60 backdrop-blur-lg rounded-3xl shadow-xl border border-white/50 dark:border-gray-700/50 p-6 flex flex-col justify-between">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center gap-3">
                                        <div class="p-2 bg-indigo-100 dark:bg-indigo-900/50 rounded-lg text-indigo-600 dark:text-indigo-400">
                                            <svg class="w-5 h-5" style="width: 1.25rem; height: 1.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"/></svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Grafik Akademik</h3>
                                    </div>
                                    @php
                                        $overallAvg = collect($gradesBySemester)->flatten()->avg('score');
                                    @endphp
                                    <div class="text-right">
                                        <p class="text-[10px] text-gray-500 uppercase font-bold">Rata-rata Total</p>
                                        <p class="text-xl font-black text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">{{ round($overallAvg, 2) }}</p>
                                    </div>
                                </div>
                                <div id="gradeChart" class="w-full h-64 rounded-xl overflow-hidden"></div>
                            </div>
                        </div>

                        <!-- Semesters Grid -->
                        <div class="space-y-6">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="h-6 w-1 bg-gradient-to-b from-blue-500 to-purple-600 rounded-full"></div>
                                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Riwayat Semester</h3>
                            </div>

                            @if($gradesBySemester->isEmpty())
                                 <div class="text-center py-12 bg-white/50 dark:bg-gray-800/50 rounded-3xl border-2 border-dashed border-gray-300 dark:border-gray-700">
                                    <svg class="mx-auto h-10 w-10 text-gray-400" style="width: 2.5rem; height: 2.5rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">Belum ada data nilai</h3>
                                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Nilai akan muncul setelah diinput oleh guru.</p>
                                </div>
                            @else
                                <div class="grid gap-6 md:grid-cols-1">
                                    @foreach($gradesBySemester as $semester => $grades)
                                        @php
                                            $average = $grades->avg('score');
                                            $bgGradient = $average >= 85 ? 'from-green-500 to-emerald-600' : ($average >= 75 ? 'from-blue-500 to-indigo-600' : ($average >= 60 ? 'from-yellow-400 to-orange-500' : 'from-red-500 to-pink-600'));
                                            $shadowColor = $average >= 85 ? 'shadow-emerald-500/10' : ($average >= 75 ? 'shadow-indigo-500/10' : ($average >= 60 ? 'shadow-orange-500/10' : 'shadow-red-500/10'));
                                        @endphp

                                        <div class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-lg {{ $shadowColor }} overflow-hidden hover:shadow-xl transition-all duration-300 border border-gray-100 dark:border-gray-700/50">
                                            
                                            <!-- Header Semester -->
                                            <div class="absolute top-0 left-0 w-1.5 h-full bg-gradient-to-b {{ $bgGradient }}"></div>
                                            
                                            <div class="p-5 sm:p-6">
                                                <div class="flex flex-wrap justify-between items-center mb-6 gap-3">
                                                    <div class="flex items-center gap-3">
                                                        <div class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 font-bold text-lg border border-gray-200 dark:border-gray-600">
                                                            {{ $semester }}
                                                        </div>
                                                        <div>
                                                            <h4 class="text-xl font-bold text-gray-800 dark:text-white leading-tight">Semester {{ $semester }}</h4>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="px-4 py-1.5 rounded-full bg-gradient-to-r {{ $bgGradient }} text-white shadow-md transform group-hover:scale-105 transition-transform flex items-center gap-2">
                                                        <span class="text-[10px] font-medium text-white/90 uppercase">Rata-rata</span>
                                                        <span class="text-lg font-bold">{{ round($average, 2) }}</span>
                                                    </div>
                                                </div>

                                                <!-- Table Container -->
                                                <div class="overflow-hidden rounded-xl border border-gray-100 dark:border-gray-700 bg-gray-50/30 dark:bg-gray-900/30">
                                                    <table class="w-full text-left border-collapse">
                                                        <thead>
                                                            <tr class="text-[11px] font-bold uppercase tracking-wider text-gray-500 border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                                                                <th class="px-4 py-3">Mata Pelajaran</th>
                                                                <th class="px-4 py-3 text-center w-20">KKM</th>
                                                                <th class="px-4 py-3 text-right w-24">Nilai</th>
                                                                <th class="px-4 py-3 text-center w-20">Predikat</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700/50">
                                                            @foreach($grades as $grade)
                                                                @php
                                                                    $score = $grade->score;
                                                                    $predikat = $score >= 90 ? 'A' : ($score >= 80 ? 'B' : ($score >= 70 ? 'C' : 'D'));
                                                                    $color = $score >= 75 ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400';
                                                                @endphp
                                                                <tr class="group/row hover:bg-white dark:hover:bg-gray-800 transition-colors text-sm">
                                                                    <td class="px-4 py-3 font-semibold text-gray-700 dark:text-gray-300">
                                                                        <div class="flex items-center gap-2">
                                                                            {{ $grade->subject->name }}
                                                                            @if($grade->subject->code)
                                                                                <span class="text-[10px] font-normal text-gray-400 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 px-1.5 py-0.5 rounded">{{ $grade->subject->code }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-4 py-3 text-center text-gray-400 font-medium">75</td>
                                                                    <td class="px-4 py-3 text-right">
                                                                        <span class="font-bold {{ $color }}">{{ $score }}</span>
                                                                    </td>
                                                                    <td class="px-4 py-3 text-center">
                                                                        <span class="inline-flex items-center justify-center w-6 h-6 rounded-full text-[10px] font-bold
                                                                            {{ $predikat === 'A' ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 
                                                                              ($predikat === 'B' ? 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' : 
                                                                              ($predikat === 'C' ? 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400')) }}">
                                                                            {{ $predikat }}
                                                                        </span>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- ApexCharts Script -->
                <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        const isDark = document.documentElement.classList.contains('dark');
                        
                        var options = {
                            series: [{
                                name: 'Rata-rata Semester',
                                data: @json($chartData['averages'])
                            }],
                            chart: {
                                height: 350,
                                type: 'area',
                                fontFamily: 'Inter, sans-serif',
                                toolbar: { show: false },
                                animations: {
                                    enabled: true,
                                    easing: 'easeinout',
                                    speed: 800,
                                },
                                dropShadow: {
                                    enabled: true,
                                    top: 10,
                                    left: 0,
                                    blur: 10,
                                    color: '#4f46e5',
                                    opacity: 0.2
                                }
                            },
                            colors: ['#6366f1'],
                            dataLabels: {
                                enabled: false
                            },
                            stroke: {
                                curve: 'smooth',
                                width: 4
                            },
                            fill: {
                                type: 'gradient',
                                gradient: {
                                    shadeIntensity: 1,
                                    opacityFrom: 0.6,
                                    opacityTo: 0.1,
                                    stops: [0, 90, 100]
                                }
                            },
                            xaxis: {
                                categories: @json($chartData['labels']),
                                axisBorder: { show: false },
                                axisTicks: { show: false },
                                labels: {
                                    style: {
                                        colors: isDark ? '#9ca3af' : '#64748b',
                                        fontSize: '12px',
                                        fontWeight: 500
                                    }
                                },
                                crosshairs: {
                                    show: true,
                                    stroke: { color: '#6366f1', width: 1, dashArray: 4 }
                                }
                            },
                            yaxis: {
                                min: 0,
                                max: 100,
                                tickAmount: 5,
                                labels: {
                                    style: {
                                        colors: isDark ? '#9ca3af' : '#64748b',
                                        fontSize: '12px',
                                        fontWeight: 500
                                    },
                                    formatter: (value) => value.toFixed(0)
                                }
                            },
                            grid: {
                                borderColor: isDark ? '#374151' : '#f1f5f9',
                                strokeDashArray: 4,
                                padding: { top: 0, right: 0, bottom: 0, left: 10 }
                            },
                            tooltip: {
                                theme: isDark ? 'dark' : 'light',
                                y: {
                                    formatter: function (val) {
                                        return val
                                    }
                                },
                                style: { fontSize: '12px' },
                                marker: { show: true },
                                x: { show: false }
                            },
                            markers: {
                                size: 6,
                                colors: ['#fff'],
                                strokeColors: '#6366f1',
                                strokeWidth: 3,
                                hover: { size: 8 }
                            }
                        };

                        var chart = new ApexCharts(document.querySelector("#gradeChart"), options);
                        chart.render();
                    });
                </script>

                <!-- Custom Style for Animations -->
                <style>
                    @keyframes blob {
                        0% { transform: translate(0px, 0px) scale(1); }
                        33% { transform: translate(30px, -50px) scale(1.1); }
                        66% { transform: translate(-20px, 20px) scale(0.9); }
                        100% { transform: translate(0px, 0px) scale(1); }
                    }
                    .animate-blob {
                        animation: blob 7s infinite;
                    }
                    .animation-delay-2000 {
                        animation-delay: 2s;
                    }
                </style>
            </main>
        </div>
    </body>
</html>
