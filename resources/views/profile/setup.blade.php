@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10 px-4">
        <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Lengkapi Biodata Kamu</h2>

            <form action="{{ route('profile.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                    <input type="text" name="full_name" class="w-full border rounded px-3 py-2"
                        value="{{ old('full_name', $profile->full_name ?? '') }}" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Tempat Lahir</label>
                        <input type="text" name="place_of_birth" class="w-full border rounded px-3 py-2"
                            value="{{ old('place_of_birth', $profile->place_of_birth ?? '') }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Tanggal Lahir</label>
                        <input type="date" name="date_of_birth" class="w-full border rounded px-3 py-2"
                            value="{{ old('date_of_birth', $profile->date_of_birth ?? '') }}" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Asal SMP</label>
                        <input type="text" name="origin_school" placeholder="Contoh: SMPN 1 Konoha"
                            class="w-full border rounded px-3 py-2"
                            value="{{ old('origin_school', $profile->origin_school ?? '') }}" required>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2">Anak Ke-</label>
                        <input type="number" name="child_number" class="w-full border rounded px-3 py-2"
                            value="{{ old('child_number', $profile->child_number ?? '') }}" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2">Alamat Rumah</label>
                    <textarea name="address" rows="3" class="w-full border rounded px-3 py-2"
                        required>{{ old('address', $profile->address ?? '') }}</textarea>
                </div>

                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded font-bold hover:bg-blue-700 w-full">
                    Simpan Data
                </button>
            </form>
        </div>
    </div>
@endsection