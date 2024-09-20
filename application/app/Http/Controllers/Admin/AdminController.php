<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pageTitle = 'Dashboard';
        return view('admin.dashboard',compact('pageTitle'));
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $pageTitle = 'Logout';
        return redirect()->route('admin.login', compact('pageTitle'));
    }

    public function profile()
    {
        $id = Auth::user()->id;
        $ProfileData  = User::find($id);
        $pageTitle = 'profile';
        return view('admin.profile', compact('ProfileData', 'pageTitle'));
    }

    public function profileUpdate(Request $request)
    {
        $id     = Auth::user()->id;
        $data   = User::find($id);

        if ($request->file('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/admin/'.$data->image));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin'), $filename);
            $data['image'] = $filename;
        }

        $data->name     = $request->name;
        $data->username = $request->username;
        $data->email    = $request->email;
        $data->phone    = $request->phone;
        $data->address  = $request->address;
        $data->save();

        $notification = array(
            'message'   => 'Admin Profile Updated Successfully',
            'alert-type'=> 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function password()
    {
        $id = Auth::user()->id;
        $password = User::find($id);

        $pageTitle = 'Password';
        return view('admin.password', compact('password', 'pageTitle'));
    }

    public function passwordUpdate(Request $request)
    {
        //validation
        $request->validate([
            'old_password'  => 'required',
            'new_password'  => 'required|confirmed',
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
            'message'   => 'Password Change Successfully',
            'alert-type'=> 'success'
        );
        return back()->with($notification);
    }
}
