<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class ManageAgentControlller extends Controller
{
    public function index()
    {
        $pageTitle = 'Agents';

        $agents = User::where('role', 'agent')->latest()->get();

        return view('admin.agent.index', compact('pageTitle', 'agents'));
    }

    public function addAgent()
    {
        $pageTitle = 'Add agent';

        return view('admin.agent.create', compact('pageTitle'));
    }

    public function storeAgent(Request $request)
    {
        User::insert([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'    => $request->address,
            'password'  => Hash::make($request->password),
            'created_at'=> Carbon::now(),
            'role'      => 'agent',
            'status'    => '1',
        ]);

        $notification = array(
            'message'    => 'Agent Created Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('admin.all.agent')->with($notification);
    }

    public function editAgent($id)
    {
        $pageTitle = 'Edit Agent';

        $agents = User::findOrFail($id);

        return view('admin.agent.edit', compact('pageTitle', 'agents'));
    }

    public function updateAgent(Request $request, $id)
    {
        User::findOrFail($id)->update([
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'phone'     => $request->phone,
            'address'    => $request->address,
            'updated_at'=> Carbon::now(),
        ]);

        $notification = array(
            'message'   => 'Agent Updated Successfully',
            'alert-type'=> 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function deleteAgent($id)
    {
        User::findOrFail($id)->delete();

        $notification = array(
            'message'   => 'Agent Deleted Successfully',
            'alert-type'=> 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function changestatus(Request $request)
    {
        $user = User::find($request->user_id);
        $user->status = $request->status;
        $user->save();

        return response()->json(['success' => 'Status Change Successfully']);
    }
}
