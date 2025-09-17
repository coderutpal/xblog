<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helpers\CMail;
use App\Models\UserSocialLink;

class Profile extends Component
{
    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab' => ['keep' => true]];

    public $name, $email, $username, $bio;
    public $current_password, $new_password, $new_password_confirmation;
    public $facebook_url, $instagram_url, $youtube_url, $linkedin_url, $twitter_url, $github_url;

    protected $listeners = [
        'updateProfile' => '$refresh'
    ];

    public function selectTab($tab)
    {
        $this->tab = $tab;
    }

    public function mount()
    {
        $this->tab = Request('tab') ? Request('tab') : $this->tabname;
        // Populate
        $user = User::with(['social_links'])->findOrFail(auth()->id());
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->bio = $user->bio;

        // Populate Social link form
        if (!is_null($user->social_links)) {
            $this->facebook_url = $user->social_links->facebook_url;
            $this->instagram_url = $user->social_links->instagram_url;
            $this->youtube_url = $user->social_links->youtube_url;
            $this->linkedin_url = $user->social_links->linkedin_url;
            $this->twitter_url = $user->social_links->twitter_url;
            $this->github_url = $user->social_links->github_url;
        }
    }

    // UPDATE PERSONAL DETAILS FUNCITION START
    public function updatePersonalDetails()
    {
        $user = User::findOrFail(auth()->id());
        $this->validate([
            'name' => 'required',
            'username' => 'required|unique:users,username,' . $user->id,
        ]);

        // Update user info
        $user->name = $this->name;
        $user->username = $this->username;
        $user->bio = $this->bio;
        $updated = $user->save();

        sleep(0.5);

        if ($updated) {
            $this->dispatch('showToastr', type: 'success', message: 'Personal details updated successfully');
            $this->dispatch('updateUserInfo')->to(TopUserInfo::class);
        } else {
            $this->dispatch('showToastr', type: 'error', message: 'Something went wrong');
        }
    }
    // UPDATE PERSONAL DETAILS FUNCITION END


    // UPDATE PASSWORD FUNCITION START
    public function updatePassword()
    {
        $user = User::findOrFail(auth()->id());
        // Validate form
        $this->validate([
            'current_password' => [
                'required',
                'min:5',
                function ($attribute, $value, $fail) use ($user) {
                    if (!Hash::check($value, $user->password)) {
                        return $fail(__('Password does not match our records.'));
                    }
                }
            ],
            'new_password' => 'required|min:5|confirmed|different:current_password'
        ]);
        // Update user password
        $updated = $user->update(['password' => Hash::make($this->new_password)]);

        if ($updated) {
            $data = array(
                'user' => $user,
                'new_password' => $this->new_password,
            );

            $mail_body = view('email-templates.password-changes-template', $data)->render();

            $mail_config = array(
                'recipient_address' => $user->email,
                'recipient_name' => $user->name,
                'subject' => 'Password changed',
                'body' => $mail_body
            );

            CMail::send($mail_config);

            // Logout and redirect to the login page
            auth()->logout();
            Session::flash('info', 'Password changed successfully. Please login with new password');
            $this->redirectRoute('admin.login');
        } else {
            $this->dispatch('showToastr', type: 'error', message: 'Something went wrong');
        }
    }
    // UPDATE PASSWORD FUNCITION END

    // UPDATE SOCIAL LINK START
    public function updateSocialLink()
    {
        $this->validate([
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'youtube_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'github_url' => 'nullable|url'
        ]);

        $user = User::findOrFail(auth()->id());

        $data = array(
            'facebook_url' => $this->facebook_url,
            'instagram_url' => $this->instagram_url,
            'youtube_url' => $this->youtube_url,
            'linkedin_url' => $this->linkedin_url,
            'twitter_url' => $this->twitter_url,
            'github_url' => $this->github_url,
        );

        if (!is_null($user->social_links)) {
            // Update query
            $query = $user->social_links()->update($data);
        } else {
            // Insert new data
            $data['user_id'] = $user->id;
            $query = UserSocialLink::insert($data);
        }
        if ($query) {
            $this->dispatch('showToastr', type: 'success', message: 'Your social links have been updated successfully');
        } else {
            $this->dispatch('showToastr', type: 'error', message: 'Something went wrong');
        }
    }
    // UPDATE SOCIAL LINK END

    public function render()
    {
        return view('livewire.admin.profile', [
            'user' => User::findOrFail(auth()->id())
        ]);
    }
}
