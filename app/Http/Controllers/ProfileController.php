<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function show(Request $request): View
    {
        return view('profile.show', [
            'user' => $request->user()->load('studentProfile'),
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user()->load('studentProfile'),
        ]);
    }

    /**
     * Display the user's profile form (Simple version).
     */
    public function editSimple(Request $request): View
    {
        return view('profile.edit-simple', [
            'user' => $request->user()->load('studentProfile'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        
        $data = $request->validated();
        
        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->studentProfile && $user->studentProfile->photo) {
                $oldPhotoPath = storage_path('app/public/photos/' . $user->studentProfile->photo);
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
            
            // Store new photo
            $file = $request->file('photo');
            $filename = time() . '_' . $user->username . '.' . $file->getClientOriginalExtension();
            $file->storeAs('photos', $filename, 'public');
            $data['photo'] = $filename;
        }
        
        // Update or create student profile
        $user->studentProfile()->updateOrCreate(
            ['user_id' => $user->id],
            $data
        );

        return Redirect::route('profile.show')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
