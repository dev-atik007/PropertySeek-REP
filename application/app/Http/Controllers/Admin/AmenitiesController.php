<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use Illuminate\Http\Request;

class AmenitiesController extends Controller
{
    public function index()
    {
        $pageTitle = 'Amenities';

        $amenities = Amenities::latest()->get();

        return view('admin.amenities.index', compact('pageTitle', 'amenities'));
    }

    public function addAminites()
    {
        $pageTitle = 'Create Amenities';

        return view('admin.amenities.create', compact('pageTitle'));
    }

    public function storeAminites(Request $request)
    {
        $amenities = new Amenities();

        $amenities->name = $request->name;
        $amenities->save();

        $notification = array(
            'message'   => 'Amenities Added Successfully',
            'alert-type'=> 'success',
        );

        return redirect()->route('admin.index.amenities')->with($notification);
    }

    public function editAminites($id)
    {
        $pageTitle = 'Details Page';

        $amenities =Amenities::find($id);

        return view('admin.amenities.edit', compact('pageTitle', 'amenities'));
    }

    public function updateAminites(Request $request, $id)
    {
        $amenities = Amenities::find($id);

        $amenities->name = $request->name;
        $amenities->save();

        $notification = array(
            'message'   => 'Amenities Updates Successfully',
            'alert-type'=> 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function deleteAminites($id)
    {
        $pageTitle = 'Amenities delete';

        $amenities = Amenities::find($id);
        $amenities->delete();

        $notification = array(
            'message'   => 'Amenities Deleted Successfully',
            'alert-type'=> 'success',
        );

        return redirect()->back()->with($notification);
    }
}
