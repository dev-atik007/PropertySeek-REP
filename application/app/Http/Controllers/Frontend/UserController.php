<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function dashboard()
    {
        $pageTitle = 'User Dashboard';

        return view('templates.user.dashboard', compact('pageTitle'));
    }

    public function logout(Request $request)
    {
        $pageTitle = 'Logout';

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login', compact('pageTitle'));
    }

    public function profile()
    {
        $pageTitle = 'Profile';

        $id = auth()->user()->id;
        $data = User::find($id);

        return view('templates.user.profile', compact('pageTitle', 'data'));
    }

    public function profileUpdate(Request $request)
    {
        $id = auth()->user()->id;
        $data = User::find($id);

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/user/'.$data->image));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/user'), $filename);
            $data['image'] = $filename;
        }

        $data->name     = $request->name;
        $data->username = $request->username;
        $data->email    = $request->email;
        $data->phone    = $request->phone;
        $data->address  = $request->address;
        $data->save();

        $notification = array(
            'message'   => 'Profile Updated Successfully',
            'alert-type'=> 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function security()
    {
        $pageTitle = 'Security';

        return view('templates.user.security', compact('pageTitle'));
    }

    public function securityUpdate(Request $request)
    {
        //validation
        $request->validate([
            'old_password'  => 'required',
            'new_password'  => 'required|confirmed'
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            $notification = array(
                'message'  => 'Old Password Dose not Match',
                'alert-type' => 'error',
            );

            return redirect()->back()->with($notification);
        }
        //update new password
        User::whereId(auth()->user()->id)->update([
            'password'  => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message'  => 'Password updated successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
