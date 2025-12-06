<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Usability;
use Illuminate\Http\Request;

class UsabilityController extends Controller
{
    public function AllUsability()
    {
        $usability = Usability::latest()->get();

        return view('admin.backend.usability.all_usability', compact('usability'));
    }

    public function AddUsability()
    {
        return view('admin.backend.usability.add_usability');
    }

    public function StoreUsability(Request $request)
    {

        Usability::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $request->input('image'),
            'youtubelink' => $request->input('youtubelink'),
            'link' => $request->input('link'),
        ]);

        $notification = [
            'message' => 'Usability inserted successfully !',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.usability')->with($notification);
    }

    public function EditUsability($id)
    {
        $usability = Usability::find($id);

        return view('admin.backend.usability.edit_usability', compact('usability'));
    }

    public function UpdateUsability(Request $request)
    {

        $usability_id = $request->id;

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|string',
            'youtubelink' => 'nullable|string',
            'link' => 'nullable|string',
        ]);

        Usability::find($usability_id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'image' => $request->input('image'),
            'youtubelink' => $request->input('youtubelink'),
            'link' => $request->input('link'),
        ]);

        $notification = [
            'message' => 'Usability updated successfully !',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.usability')->with($notification);
    }

    public function DeleteUsability($id)
    {
        $usability = Usability::find($id);
        $usability->delete();
        $notification = [
            'message' => 'Usability deleted successfully !',
            'alert-type' => 'success',
        ];

        return redirect()->route('all.usability')->with($notification);
    }
}
