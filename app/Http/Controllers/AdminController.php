<?php

namespace App\Http\Controllers;

use App\Mail\VerificationCodeMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // public function AdminLogin(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         $verificationCode = random_int(100000, 999999);
    //         session(['verification_code' => $verificationCode, 'user_id' => $user->id]);
    //         Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));
    //         Auth::logout();

    //         return redirect()->route('custom-verification-form')->with('status', 'Verification code send to your email !');
    //     }

    //     return redirect()->back()->withErrors([
    //         'email' => 'Invalid credentials provided',
    //     ]);

    // }

    public function AdminLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $verificationCode = random_int(100000, 999999);

            session([
                'verification_code' => $verificationCode,
                'user_id' => $user->id,
            ]);

            Log::info('DEV: Verification code for '.$user->email.' is '.$verificationCode);

            Mail::to($user->email)->send(new VerificationCodeMail($verificationCode));
            Auth::logout();

            return redirect()
                ->route('custom-verification-form')
                ->with('status', 'Verification code sent to your email !');
        }

        return redirect()->back()->withErrors([
            'email' => 'Invalid credentials provided',
        ]);
    }

    public function ShowVerification()
    {
        return view('auth.verify');
    }

    public function ShowVerificationVerify(Request $request)
    {
        $request->validate([
            'code' => 'required|numeric',
        ]);
        if ($request->code == session('verification_code')) {
            Auth::loginUsingId(session('user_id'));
            session()->forget(['verification_code', 'user_id']);

            return redirect()->intended('/dashboard');
        }

        return redirect()->back()->withErrors([
            'code' => 'Invalid verification code !',
        ]);

    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_profile', compact('profileData'));
    }

    public function ProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::findOrFail($id);

        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->address = $request->address;

        $oldPhotoPath = $data->photo;

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'), $fileName);

            if ($oldPhotoPath && $oldPhotoPath !== $fileName) {
                $this->deleteOldImage($oldPhotoPath);
            }

            $data->photo = $fileName;
        }

        $data->save();

        $notification = [
            'message' => 'Profile updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->back()->with($notification);
    }

    protected function deleteOldImage(string $oldPhotoPath): void
    {
        $path = public_path('upload/user_images/'.$oldPhotoPath);

        if (File::exists($path)) {
            File::delete($path);
        }
    }

    public function PasswordUpdate(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed|min:8',
        ]);

        if (! Hash::check($request->old_password, $user->password)) {
            $notification = [
                'message' => 'Old password does not match!',
                'alert-type' => 'error',
            ];

            return back()->with($notification);
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        Auth::logout();

        $notification = [
            'message' => 'Password updated successfully',
            'alert-type' => 'success',
        ];

        return redirect()->route('login')->with($notification);
    }
}
