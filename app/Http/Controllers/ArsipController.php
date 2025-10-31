<?php

namespace App\Http\Controllers;

use App\Models\Arsip;
use Cache;
use Illuminate\Http\Request;
use Storage;

class ArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $arsips = Cache::remember(
            'arsip',
            1,
            fn() =>
            Arsip::where('title', 'like', "%$search%")->latest()->paginate(10)
        );
        return view('admin.arsip', compact('arsips'));
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
        // 1️⃣ Validate input
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'path' => 'required|file|max:20480', // 20MB limit
        ]);

        // 2️⃣ Save original file name
        $originalName = $request->file('path')->getClientOriginalName();

        // 3️⃣ Store file (Laravel will generate a unique hashed name)
        $filePath = $request->file('path')->store('arsip', 'public');

        // 4️⃣ Save to database
        $arsip = Arsip::create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'path' => $filePath,
            'original_name' => $originalName,
        ]);

        // 5️⃣ Redirect back with success message
        return redirect()
            ->route('admin.arsip')
            ->with([
                'alert' => 'Arsip berhasil ditambahkan!',
                'type' => 'success',
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Arsip $arsip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Arsip $arsip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Arsip $arsip)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'path' => 'nullable|file|max:20480',
        ]);

        // If user uploads a new file, delete the old one
        if ($request->hasFile('path')) {

            // ✅ Delete old file if exists
            if ($arsip->path && Storage::disk('public')->exists($arsip->path)) {
                Storage::disk('public')->delete($arsip->path);
            }

            // ✅ Store new file
            $originalName = $request->file('path')->getClientOriginalName();
            $newFilePath = $request->file('path')->store('arsip', 'public');

            // ✅ Update fields
            $arsip->path = $newFilePath;
            $arsip->original_name = $originalName;
        }

        $arsip->title = $validated['title'];
        $arsip->description = $validated['description'] ?? null;
        $arsip->save();

        return redirect()
            ->route('admin.arsip')
            ->with(['alert' => 'Arsip berhasil diperbarui!', 'type' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);

        // 1️⃣ Delete file if exists
        if ($arsip->path && Storage::disk('public')->exists($arsip->path)) {
            Storage::disk('public')->delete($arsip->path);
        }

        // 2️⃣ Delete database record
        $arsip->delete();

        // 3️⃣ Redirect with success alert
        return redirect()
            ->route('admin.arsip')
            ->with([
                'alert' => 'Arsip berhasil dihapus!',
                'type' => 'success',
            ]);
    }
}
