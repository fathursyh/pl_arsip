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
            Arsip::where('nomor_risalah', 'like', "%$search%")->latest()->paginate(10)
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
        // Validate input
        $validated = $request->validate([
            'nomor_risalah' => 'required|string|max:255|unique:arsips,nomor_risalah',
            'pemohon' => 'required|string|max:255',
            'jenis_lelang' => 'required|in:jenis1,jenis2',
            'uraian_barang' => 'required|string',
        ]);
        try {

            Arsip::create([
                'nomor_risalah' => $validated['nomor_risalah'],
                'pemohon' => $validated['pemohon'],
                'jenis_lelang' => $validated['jenis_lelang'],
                'uraian_barang' => $validated['uraian_barang'],
                'status' => true,
            ]);

            return redirect()
                ->route('arsip.index')
                ->with([
                    'alert' => 'Arsip berhasil ditambahkan!',
                    'type' => AlertEnum::SUCCESS->value,
                ]);
        } catch (\Exception $e) {
            return back()->withInput()->with([
                'alert' => 'Terjadi kesalahan pada server. Silakan coba lagi.',
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
        $input = $request->only(['nomor_risalah', 'pemohon', 'jenis_lelang', 'uraian_barang']);
        $arsip->fill($input);

        if ($arsip->isClean()) {
            return back();
        }

        $validated = $request->validate([
            'nomor_risalah' => 'required|string|max:255|unique:arsips,nomor_risalah,' . $arsip->id,
            'pemohon' => 'required|string|max:255',
            'jenis_lelang' => 'required|in:jenis1,jenis2',
            'uraian_barang' => 'required|string',
        ]);
        try {

            $arsip->nomor_risalah = $validated['nomor_risalah'];
            $arsip->pemohon = $validated['pemohon'];
            $arsip->jenis_lelang = $validated['jenis_lelang'];
            $arsip->uraian_barang = $validated['uraian_barang'];
            $arsip->save();

            return redirect()
                ->route('arsip.index')
                ->with([
                    'alert' => 'Arsip berhasil diperbarui!',
                    'type' => AlertEnum::SUCCESS->value,
                ]);
        } catch (\Exception $e) {
            return back()->withInput()->with([
                'alert' => 'Terjadi kesalahan pada server.',
                'type' => AlertEnum::DANGER->value,
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $arsip = Arsip::findOrFail($id);
            $arsip->delete();

            return redirect()
                ->route('arsip.index')
                ->with([
                    'alert' => 'Arsip berhasil dihapus!',
                    'type' => AlertEnum::SUCCESS->value,
                ]);
        } catch (\Exception $e) {
            return back()->with([
                'alert' => 'Terjadi kesalahan pada server. Silakan coba lagi.',
                'type' => AlertEnum::DANGER->value,
            ]);
        }
    }
}
