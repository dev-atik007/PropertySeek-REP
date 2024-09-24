<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\User;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use PHPUnit\Framework\Constraint\Count;

class PropertyController extends Controller
{
    public function propertyIndex()
    {
        $pageTitle = 'Property List';

        $property = Property::latest()->get();

        return view('admin.property.index', compact('pageTitle', 'property'));
    }

    public function propertyCreate()
    {
        $pageTitle = 'Property Create';

        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::agent()->active()->latest()->get();

        return view('admin.property.create', compact('pageTitle', 'propertyType', 'amenities', 'activeAgent'));
    }

    public function propertyStore(Request $request)
    {
        $ame = $request->amenities_id;
        $amenities = implode(",", $ame);
        // dd($amenities);

        $pcode = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);

        $image = $request->file('thumbnail');
        if ($image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 250)->save('application/public/upload/property/thumbnail/' . $name_gen);
            $save_url = 'application/public/upload/property/thumbnail/' . $name_gen;
        }


        $property = new Property();

        $property->ptype_id       = $request->ptype_id;
        $property->amenities_id   = $amenities;
        $property->name           = $request->name;
        $property->slug           = strtolower(str_replace(' ', '-', $request->name));
        $property->property_code  = $pcode;
        $property->property_status = $request->property_status;

        $property->lower_price    = $request->lower_price;
        $property->max_price      = $request->max_price;
        $property->short_desc     = $request->short_desc;
        $property->long_desc      = $request->long_desc;
        $property->bedrooms       = $request->bedrooms;
        $property->bathrooms      = $request->bathrooms;

        $property->garage         = $request->garage;
        $property->garage_size    = $request->garage_size;
        $property->video          = $request->video;
        $property->property_size  = $request->property_size;
        $property->address        = $request->address;
        $property->city           = $request->city;

        $property->state          = $request->state;
        $property->postal_code    = $request->postal_code;
        $property->neightborhood  = $request->neightborhood;
        $property->latitude       = $request->latitude;
        $property->longitude      = $request->longitude;
        $property->featured       = $request->featured;

        $property->hot            = $request->hot;
        $property->agent_id       = $request->agent_id;
        $property->thumbnail      = $save_url;
        $property->status         = 1;
        $property->created_at     = Carbon::now();
        $property->save();

        ///Multiple Image upload from here//

        $images = $request->file('image');
        foreach ($images as $img) {

            $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
            Image::make($img)->resize(770, 520)->save('application/public/upload/property/multi-img/' . $name_gen);
            $multi_img = 'application/public/upload/property/multi-img/' . $name_gen;

            $multi_images = new MultiImage();

            $multi_images->property_id  = $property->id;
            $multi_images->image        = $multi_img;
            $multi_images->created_at   = Carbon::now();
            $multi_images->save();
        }
        /// end multi image


        ///Facility from Here

        $facilites = Count($request->facility_name);

        if ($facilites != NULL) {
            for ($i = 0; $i < $facilites; $i++) {
                $fcount = new Facility();
                $fcount->property_id    = $property->id;
                $fcount->facility_name  = $request->facility_name[$i];
                $fcount->distance       = $request->distance[$i];
                $fcount->created_at     = Carbon::now();
                $fcount->save();
            }
        }
        ///End Facility from Here

        $notification = array(
            'message'   => 'Property Inserted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.property.index')->with($notification);
    }

    public function propertyDetails($id)
    {
        $pageTitle = 'Property Details';

        $property = Property::findOrFail($id);
        $type = $property->amenities_id;
        $property_ame = explode(',', $type);

        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::agent()->active()->latest()->get();
        $multiImage = MultiImage::where('property_id', $id)->get();

        $facilites = Facility::where('property_id', $id)->get();

        return view('admin.property.edit', compact('pageTitle', 'property', 'propertyType', 'amenities', 'activeAgent', 'property_ame', 'multiImage', 'facilites'));
    }

    public function propertyUpdate(Request $request)
    {
        $ame = $request->amenities_id;
        $amenities = implode(",", $ame);

        $property_id = $request->id;

        $properties = Property::find($property_id);

        $properties->ptype_id       = $request->ptype_id;
        $properties->amenities_id   = $amenities;
        $properties->name           = $request->name;
        $properties->slug           = strtolower(str_replace(' ', '-', $request->name));
        $properties->property_status = $request->property_status;

        $properties->lower_price    = $request->lower_price;
        $properties->max_price      = $request->max_price;
        $properties->short_desc     = $request->short_desc;
        $properties->long_desc      = $request->long_desc;
        $properties->bedrooms       = $request->bedrooms;
        $properties->bathrooms      = $request->bathrooms;

        $properties->garage         = $request->garage;
        $properties->garage_size    = $request->garage_size;
        $properties->video          = $request->video;
        $properties->property_size  = $request->property_size;
        $properties->address        = $request->address;
        $properties->city           = $request->city;

        $properties->state          = $request->state;
        $properties->postal_code    = $request->postal_code;
        $properties->neightborhood  = $request->neightborhood;
        $properties->latitude       = $request->latitude;
        $properties->longitude      = $request->longitude;
        $properties->featured       = $request->featured;

        $properties->hot            = $request->hot;
        $properties->agent_id       = $request->agent_id;
        $properties->updated_at     = Carbon::now();
        $properties->save();

        $notification = array(
            'message'   => 'Property Updated Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('admin.property.index')->with($notification);
    }

    public function updateThumbnail(Request $request)
    {
        $pro_id = $request->id;
        $oldImg = $request->old_img;

        $image = $request->file('thumbnail');
        if ($image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 250)->save('application/public/upload/property/thumbnail/' . $name_gen);
            $save_url = 'application/public/upload/property/thumbnail/' . $name_gen;

            if (file_exists($oldImg)) {
                unlink($oldImg);
            }

            $update_img = Property::findOrFail($pro_id);
            $update_img->thumbnail = $save_url;
            $update_img->updated_at = Carbon::now();
            $update_img->save();

            $notification = array(
                'message'   => 'Property Image Thumbnail Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }

        $notification = array(
            'message'   => 'Please select an image before submitting.',
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }


    public function updateMultiImage(Request $request)
    {
        $imgs = $request->multi_image;


        if ($imgs) {
            foreach ($imgs as $id => $img) {
                $imgDel = MultiImage::findOrFail($id);
                $imagePath = str_replace('application/public/', '', $imgDel->image);
                unlink(public_path($imagePath));


                $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                Image::make($img)->resize(770, 520)->save('application/public/upload/property/multi-img/' . $name_gen);
                $multi_img = 'application/public/upload/property/multi-img/' . $name_gen;


                $up_img = MultiImage::findOrFail($id);

                $up_img->image = $multi_img;
                $up_img->updated_at = Carbon::now();
                $up_img->save();
            }

            $notification = array(
                'message'   => 'Property Multi-Image Updated Successfully',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message'   => 'Please select an image before submitting.',
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    public function multiImageDelete($id)
    {
        $oldImg = MultiImage::findOrFail($id);
        unlink($oldImg->image);

        $delete = MultiImage::findOrFail($id);
        $delete->delete();

        $notification = array(
            'message'   => 'Property Multi-Image Deleted Successfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function storeNewMultiImage(Request $request)
    {
        $new_multi = $request->imageid;

        $image = $request->file('multiImg');
        if ($image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(770, 520)->save('application/public/upload/property/multi-img/' . $name_gen);
            $multi_img = 'application/public/upload/property/multi-img/' . $name_gen;

            $up_img = new MultiImage();

            $up_img->property_id = $new_multi;
            $up_img->image = $multi_img;
            $up_img->created_at = Carbon::now();
            $up_img->save();

            $notification = array(
                'message'   => 'Property Multi-Image Added Successfully',
                'alert-type' => 'success',
            );
            return redirect()->back()->with($notification);
        }
        $notification = array(
            'message'   => 'Please select an image before submitting.',
            'alert-type' => 'error',
        );
        return redirect()->back()->with($notification);
    }

    public function updateFacilites(Request $request)
    {
        $pro_id = $request->id;

        if ($request->facility_name == NULL) {
            return redirect()->back();
        } else {
            Facility::where('property_id', $pro_id)->delete();

            $facilites = Count($request->facility_name);

            for ($i = 0; $i < $facilites; $i++) {
                $fcount = new Facility();
                $fcount->property_id    = $pro_id;
                $fcount->facility_name  = $request->facility_name[$i];
                $fcount->distance       = $request->distance[$i];
                $fcount->created_at     = Carbon::now();
                $fcount->save();
            }
        }
        $notification = array(
            'message'   => 'Property Facility Updated Succesfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function propertyDelete($id)
    {
        $property = Property::findOrFail($id);
        unlink($property->thumbnail);

        Property::findOrFail($id)->delete();

        $image = MultiImage::where('property_id', $id)->get();
        foreach ($image as $img) {
            unlink($img->image);
            MultiImage::where('property_id', $id)->delete();
        }

        $facilites = Facility::where('property_id', $id)->get();
        foreach ($facilites as $facility) {
            $facility->facility_name;
            Facility::where('property_id', $id)->delete();
        }

        $notification = array(
            'message'   => 'Property Deleted Succesfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function propertyView($id)
    {
        $pageTitle = 'Property View Details';

        $property = Property::findOrFail($id);
        $type = $property->amenities_id;
        $property_ame = explode(',', $type);

        $propertyType = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $activeAgent = User::agent()->active()->latest()->get();
        $multiImage = MultiImage::where('property_id', $id)->get();

        $facilites = Facility::where('property_id', $id)->get();

        return view('admin.property.view', compact('pageTitle', 'property', 'propertyType', 'amenities', 'activeAgent', 'property_ame', 'multiImage', 'facilites'));
    }

    public function inactiveProperty(Request $request)
    {
        $pid = $request->id;

        Property::findOrFail($pid)->update([
            'status' => 0,
        ]);

        $notification = array(
            'message'   => 'Property Inactive Succesfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function activeProperty(Request $request)
    {
        $id = $request->id;

        Property::findOrFail($id)->update([
            'status' => 1,
        ]);

        $notification = array(
            'message'   => 'Property Active Succesfully',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }
}
