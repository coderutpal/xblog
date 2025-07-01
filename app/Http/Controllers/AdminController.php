<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use illuminate\Support\Facades\File;
use SawaStacks\Utils\Kropify;

class AdminController extends Controller
{
    // Admin dashboard view function
    public function adminDashboard(Request $request)
    {
        $data = [
            'pageTitle' => 'Dashboard'
        ];
        return view('back.pages.dashboard', $data);
    }

    // Logout handler function
    public function logoutHandler(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login')->with('fail', 'You are now logged out!');
    }
    //END METHOD

    // PROFILE VIEW FUNCTION START
    public function profileView(Request $request)
    {
        $data = [
            'pageTitle' => 'Profile'
        ];
        return view('back.pages.profile', $data);
    }
    // PROFILE VIEW FUNCTION END

    // UPDATE PROFILE PICTURE FUNCTION START
    public function updateProfilePicture(Request $request)
    {
        $user = User::findOrFail(auth()->id());
        $path = 'images/users';
        $file = $request->file('profilePictureFile');
        $old_picture = $user->getAttributes()['picture'];
        $filename = 'IMG' . uniqid() . '.png';

        $upload = Kropify::getFile($file, $filename)
            ->setPath($path)
            ->useMove()
            ->save();

        if ($upload) {
            $info = $upload->getUploadedInfo();

            // Delete the old profile picture if exists
            if ($old_picture != null && File::exists(public_path($path . '/' . $old_picture))) {
                File::delete(public_path($path . '/' . $old_picture));
            }

            $user->update(['picture' => $info['filename']]);

            return response()->json([
                'status' => 1,
                'message' => 'Your profile picture has been updated successfully',
                'image' => $info['url']
            ]);
        } else {
            return response()->json(['status' => 0, 'message' => 'Something went wrong!']);
        }
    }
    // UPDATE PROFILE PICTURE FUNCTION END

}
