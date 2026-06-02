<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index(Request $request)
    {
        $query = Media::query();

        if ($request->filled('type')) {
            $query->where('mime_type', 'like', $request->type.'%');
        }

        if ($request->filled('date')) {
            $query->whereDate('created_at', $request->date);
        }

        if ($request->filled('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }

        $mediaItems = $query->paginate(12);
        $dates = Media::selectRaw('DATE(created_at) as date')->distinct()->pluck('date');

        return view('admin.media.index', compact('mediaItems', 'dates'));
    }

    public function bulkDelete(Request $request)
    {
        Media::whereIn('id', $request->selected)->delete();
        return redirect()->route('admin.media.index')->with('success', 'Selected media deleted successfully.');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    // Validate incoming files
    $request->validate([
        'file.*' => 'required|file|mimes:jpg,jpeg,png,gif,pdf,mp4|max:20480',
    ]);

    $uploaded = [];

    foreach ($request->file('file') as $file) {
        // Save file to storage/app/public/media
        $path = $file->store('media', 'public');

        // Create DB record using your Media model
        $media = Media::create([
            'file_name'  => $file->getClientOriginalName(),
            'file_path'  => $path,
            'mime_type'  => $file->getMimeType(),
            'uploaded_by'=> auth()->id(), // optional, if you track user
        ]);

        $uploaded[] = [
            'id'   => $media->id,
            'url'  => $media->url, // comes from getUrlAttribute()
            'name' => $media->file_name,
        ];
    }

    return response()->json($uploaded);
}





    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
