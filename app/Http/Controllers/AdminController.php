<?php

namespace App\Http\Controllers;

use App\Livewire\Admin\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use illuminate\Support\Facades\File;
use SawaStacks\Utils\Kropify;
use App\Models\GeneralSetting;

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

    // GENERAL SETTING START
    public function generalSettings(Request $request)
    {
        $data = [
            'pageTitle' => 'General Settings',
        ];
        return view('back.pages.general-settings', $data);
    }

    // Update logo method using "base64 string" Start [Method1]
    public function updateLogo(Request $request)
    {
        $request->validate([
            'cropped_logo' => 'required|string',
        ]);

        $settings = GeneralSetting::take(1)->first();

        if (!is_null($settings)) {
            $data = $request->cropped_logo;

            // Remove base64 header
            $image = str_replace('data:image/png;base64,', '', $data);
            $image = str_replace(' ', '+', $image);

            // New File Name
            $fileName = 'site_logo_' . uniqid() . '.png';
            $path = 'images/site';
            $oldFile = $settings->site_logo;

            // Save file to folder
            $upload = file_put_contents(public_path($path . '/' . $fileName), base64_decode($image));

            if ($upload) {
                // Delete old file if exists
                if ($oldFile != null && file_exists(public_path($path . '/' . $oldFile))) {
                    unlink(public_path($path . '/' . $oldFile));
                }

                // Update database
                $settings->update(['site_logo' => $fileName]);

                return response()->json([
                    'status' => 1,
                    'message' => 'Logo has been updated successfully',
                    'path' => asset($path . '/' . $fileName)
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'Something went wrong while uploading the logo!'
                ]);
            }
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Make sure you have updated your general settings form'
            ]);
        }
    }
    // Update logo method using "base64 string" end [Method1]

    // Update logo method using object/form data start [Method2]
    // public function updateLogo(Request $request)
    // {
    //     $request->validate([
    //         'site_logo' => 'required|required|image|mimes:jpeg,png,jpg',
    //     ]);

    //     $settings = GeneralSetting::take(1)->first();

    //     //If have any row in DB
    //     if (!is_null($settings)) {
    //         $file = $request->file('site_logo');
    //         $fileName = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();
    //         $path = 'images/site';
    //         $oldFile = $settings->site_logo;

    //         // If file upload then move/upload to folder
    //         if ($request->hasFile('site_logo')) {
    //             $upload = $file->move(public_path($path), $fileName);

    //             // After upload, If find old file in the folder and db, then delete old file from folder and update db
    //             if ($upload) {
    //                 if ($oldFile != null && File::exists(public_path($path . '/' . $oldFile))) {
    //                     File::delete(public_path($path . '/' . $oldFile));
    //                 }

    //                 $settings->update(['site_logo' => $fileName]);
    //                 return response()->json(['status' => 1, 'message' => 'Logo has been updated successfully']);
    //             } else {
    //                 return response()->json(['status' => 0, 'message' => 'Something went to wrong when uploading logo!']);
    //             }
    //         }
    //     } else {
    //         return response()->json(['Status' => 0, 'message' => 'Make sure you have updated your general settings form']);
    //     }
    // }
    // Update logo method using object/form data end [Method2]

    // Update Faviocn method using "base64 string" Start [Method1]
    public function updateFavicon(Request $request)
    {
        $request->validate([
            'cropped_favicon' => 'required|string',
        ]);

        $settings = GeneralSetting::take(1)->first();

        if (!is_null($settings)) {
            $data = $request->cropped_favicon;

            // Remove base64 header
            $image = str_replace('data:image/png;base64,', '', $data);
            $image = str_replace(' ', '+', $image);

            // New File Name
            $fileName = 'site_favicon_' . uniqid() . '.png';
            $path = 'images/site';
            $oldFile = $settings->site_favicon;

            // Save file to folder
            $upload = file_put_contents(public_path($path . '/' . $fileName), base64_decode($image));

            if ($upload) {
                // Delete old file if exists
                if ($oldFile != null && file_exists(public_path($path . '/' . $oldFile))) {
                    unlink(public_path($path . '/' . $oldFile));
                }

                // Update database
                $settings->update(['site_favicon' => $fileName]);

                return response()->json([
                    'status' => 1,
                    'message' => 'Favicon has been updated successfully',
                    'path' => asset($path . '/' . $fileName)
                ]);
            } else {
                return response()->json([
                    'status' => 0,
                    'message' => 'Something went wrong while uploading the Favicon!'
                ]);
            }
        } else {
            return response()->json([
                'status' => 0,
                'message' => 'Make sure you have updated your general settings form'
            ]);
        }
    }
    // Update Favicon method using "base64 string" end [Method1]

    // GENERAL SETTING END
}
