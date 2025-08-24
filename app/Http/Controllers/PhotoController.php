<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Post;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::latest()->paginate(5);
        return view('photos.index', compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'path' => 'required|image|max:2048',
        ]);

        // store the file and get the path string
        $filePath = $request->file('path')->store('photos', 'public');

        // replace the 'path' value in validated array with the stored path
        $validated['path'] = $filePath;

        Photo::create($validated);

        return redirect()->route('photos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Photo $photo)
    {
        return view('photos.edit', compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'path' => 'nullable|image|max:2048', // use column name
        ]);

        if ($request->hasFile('path')) {
            $filePath = $request->file('path')->store('photos', 'public');
            $photo->path = $filePath; // save to correct column
        }

        $photo->title = $validated['title'];
        $photo->save();

        return redirect()->route('photos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return redirect()->route('photos.index');
    }
}
