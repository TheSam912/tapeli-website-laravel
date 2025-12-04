<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class featuresController extends Controller
{
    public function AllFeatures()
    {
        $features = Feature::latest()->get();

        return view('admin.backend.feature.all_features', compact('features'));
    }

    public function AddFeature()
    {
        return view('admin.backend.feature.add_features');
    }

    public function StoreFeatures(Request $request)
    {

        Feature::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'icon' => $request->input('icon'),
        ]);

        $notification = [
            'message' => 'Feature inserted successfully !',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.feature')->with($notification);
    }

    public function EditFeatures($id)
    {
        $feature = Feature::find($id);

        return view('admin.backend.feature.edit_feature', compact('feature'));
    }

    public function UpdateFeature(Request $request)
    {

        $feature_id = $request->id;

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'icon' => 'nullable|string',
        ]);

        Feature::find($feature_id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'icon' => $request->input('icon'),
        ]);

        $notification = [
            'message' => 'Feature updated successfully !',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.feature')->with($notification);
    }

    public function DeleteFeature($id)
    {
        $feature = Feature::find($id);
        $feature->delete();
        $notification = [
            'message' => 'Feature deleted successfully !',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.feature')->with($notification);
    }
}
