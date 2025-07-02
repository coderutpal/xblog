<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helpers\Cmail;
use Illuminate\Container\Attributes\Auth;

class Profile extends Component
{
    public $tab = null;
    public $tabname = 'personal_details';
    protected $queryString = ['tab' => ['keep' => true]];

    public $name, $email, $username, $bio;
    public $current_password, $new_password, $new_password_confirmation;

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
        $user = User::findOrFail(auth()->id());
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->bio = $user->bio;
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

        // UPDATE PASSWORD FUNCITION END
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

            Cmail::send($mail_config);

            // Logout and redirect to the login page
            auth()->logout();
            Session::flash('info', 'Password changed successfully. Please login with new password');
            $this->redirectRoute('admin.login');
        } else {
            $this->dispatch('showToastr', type: 'error', message: 'Something went wrong');
        }
    }
    public function render()
    {
        return view('livewire.admin.profile', [
            'user' => User::findOrFail(auth()->id())
        ]);
    }
}
