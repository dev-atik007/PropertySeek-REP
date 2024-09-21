<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    public function allType()
    {
        $pageTitle = 'Property Type';

        $types = PropertyType::latest()->get();

        return view('admin.type.index', compact('pageTitle', 'types'));
    }

    public function addType()
    {
        $pageTitle = 'Add Type';

        return view('admin.type.create', compact('pageTitle'));
    }

    public function storeType(Request $request)
    {
        // validation
        $request->validate([
            'type'  => 'required|unique:property_types|max:200',
            'icon'  => 'required',
        ]);

        $type = new PropertyType();

        $type->type = $request->type;
        $type->icon = $request->icon;
        $type->save();

        $notification = array(
            'message'   => 'Property Type Added Successfully',
            'alert-type'=> 'success',
        );

        return redirect()->route('admin.all.type')->with($notification);
    }

    public function editType($id)
    {
        $pageTitle = 'Type Edit';

        $types = PropertyType::find($id);

        return view('admin.type.edit', compact('pageTitle', 'types'));
    }

    public function updateType(Request $request, $id)
    {
        // validation
        $request->validate([
            'type'  => 'required|unique:property_types,type,'.$id.'|max:200',
            'icon'  => 'required',
        ]);

        $type = PropertyType::find($id);

        $type->type = $request->type;
        $type->icon = $request->icon;
        $type->save();

        $notification = array(
            'message'   => 'Property Type Updated Successfully',
            'alert-type'=> 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function deleteType($id)
    {
        $pageTitle = 'Type Delete';

        $type = PropertyType::find($id); 

        $type->delete();

        $notification = array(
            'message'   => 'Property deleted successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.type')->with($notification);
    }
}
