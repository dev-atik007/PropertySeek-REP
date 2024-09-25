<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AgentController extends Controller
{
    public function dashboard()
    {
        $pageTitle = 'Dashboard';

        $id = Auth::user()->id;
        $agentCheck = User::find($id);
        $status = $agentCheck->status;

        return view('agent.dashboard', compact('pageTitle', 'status'));
    }

    public function login()
    {
        $pageTitle = 'Agent Login';
        return view('agent.login', compact('pageTitle'));
    }

    public function register(Request $request)
    {
        $agent = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'agent',
            'status' => '0',
        ]);

        event(new Registered($agent));

        Auth::login($agent);

        return redirect(RouteServiceProvider::AGENT);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();


        return redirect()->route('agent.login');
    }

    public function profile()
    {
        $pageTitle = 'Profile';

        $id = Auth::user()->id;
        $agentData = User::find($id);

        return view('agent.profile', compact('pageTitle', 'agentData'));
    }

    public function profileUpdate(Request $request)
    {
        $id = Auth::user()->id;
        $profile = User::find($id);

        if ($request->has('image')) {
            $file = $request->file('image');
            @unlink(public_path('upload/agent/'.$profile->image));
            $filename = date('YmdHi').$file->getClientOriginalExtension();
            $file->move(public_path('upload/agent'), $filename);
            $profile['image'] = $filename;
        }

        $profile->name     = $request->name;
        $profile->username = $request->username;
        $profile->email    = $request->email;
        $profile->phone    = $request->phone;
        $profile->address  = $request->address;
        $profile->save();

        $notification = array(
            'message'   => 'Your Profile Updated Successfully',
            'alert-type'=> 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function security()
    {
        $pageTitle = 'Security';

        $id = Auth::user()->id;
        $password = User::find($id);

        return view('agent.password', compact('pageTitle', 'password'));
    }

    public function securityUpdate(Request $request)
    {
        //Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, auth()->user()->password)) {
            
            $notification = array(
                'message' => 'Old Password Does not Match',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }
        //update new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Change successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    
}
