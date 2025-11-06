<?php

namespace App\Http\Controllers;

use App\Enums\AlertEnum;
use App\Models\Arsip;
use Cache;
use Illuminate\Http\Request;

class ArsipController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->query('search', '');
        $page = request('page', 1);
        $arsips = Cache::remember(
            'arsip_' . md5($search) . '_page_' . $page,
            30,
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
        ]);

        try {
            Arsip::create([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
            ]);

            return redirect()
                ->route('arsip.index')
                ->with([
                    'alert' => 'Arsip berhasil ditambahkan!',
                    'type' => AlertEnum::SUCCESS->value,
                ]);
        } catch (\Exception $e) {
            return back()->with([
                'alert' => 'Terjadi kesalahan dalam pendataan arsip!',
                'type' => AlertEnum::DANGER->value,
            ]);
        }
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
            'description' => 'required|string|max:255',
        ]);

        $arsip->title = $validated['title'];
        $arsip->description = $validated['description'] ?? null;
        $arsip->save();

        return redirect()
            ->route('arsip.index')
            ->with(['alert' => 'Arsip berhasil diperbarui!', 'type' => AlertEnum::SUCCESS->value]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $arsip = Arsip::findOrFail($id);

        $arsip->delete();
        return redirect()
            ->route('arsip.index')
            ->with([
                'alert' => 'Arsip berhasil dihapus!',
                'type' => AlertEnum::SUCCESS->value,
            ]);
    }
}
