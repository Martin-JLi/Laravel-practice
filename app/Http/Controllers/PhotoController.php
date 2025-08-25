<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    // Display all photos
    public function index()
    {
        $photos = Photo::latest()->paginate(10);
        return view('photos.index', compact('photos'));
    }

    // Show form to create a new photo
    public function create()
    {
        return view('photos.create');
    }

    // Store a new photo
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'path' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('path')) {
            // Store the file in storage/app/public/photos and get the path string
            $filePath = $request->file('path')->store('photos', 'public');

            // Replace 'path' in validated data with stored file path
            $validated['path'] = $filePath;
        }

        Photo::create($validated);

        return redirect()->route('photos.index');
    }

    // Show form to edit a photo
    public function edit(Photo $photo)
    {
        return view('photos.edit', compact('photo'));
    }

    // Update an existing photo
    public function update(Request $request, Photo $photo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'path' => 'nullable|image|max:2048', // image optional
        ]);

        if ($request->hasFile('path')) {
            // delete old file if exists
            if ($photo->path) {
                Storage::disk('public')->delete($photo->path);
            }

            // store new file and update path
            $filePath = $request->file('path')->store('photos', 'public');
            $validated['path'] = $filePath;
        }

        $photo->update($validated);

        return redirect()->route('photos.index');
    }

    // Delete a photo
    public function destroy(Photo $photo)
    {
        // delete file if exists
        if ($photo->path) {
            Storage::disk('public')->delete($photo->path);
        }

        $photo->delete();

        return redirect()->route('photos.index');
    }
}
