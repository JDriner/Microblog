<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilePictureUpdateRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Validator;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function view(Request $request): View
    {
        $my_posts = Post::where('user_id', Auth::user()->id)
            ->latest()
            ->get();

        return view('profile.view-profile', [
            'user' => $request->user(),
        ], compact('my_posts'));
    }

    public function viewUser($user_id)
    {
        $user = User::find($user_id);
        $my_posts = Post::where('user_id', $user_id)
            ->latest()
            ->get();
        // print($user);
        return view('profile.view-profile', compact('my_posts', 'user'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
            $request->user()->is_activated = false;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')
            ->with('success', 'Your profile has been updated successfully!');
    }

    public function updatePicture(ProfilePictureUpdateRequest $request)
    {
        $image_path = $request->file('profile_picture')
            ->store('user_picture', 'public');

        $user = Auth::user();
        $user->profile_picture = $image_path;
        $user->save();

        return response()->json([
            'success' => 'Profile picture has been updated.'
        ]);

    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}