<?php

namespace App\Http\Controllers;

use App\Enums\AlertEnum;
use App\Models\Arsip;
use Cache;
use DB;
use Illuminate\Http\Request;
use Str;

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

    public function upload(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');

        if (($handle = fopen($file->getRealPath(), 'r')) !== FALSE) {

            // 1. GET THE HEADER ROW
            $headerRow = fgetcsv($handle);

            if (!$headerRow) {
                return redirect()->back()->with('error', 'File is empty');
            }

            // 2. MAP HEADERS TO INDICES
            // Example Result: ['nomor_risalah' => 0, 'pemohon' => 1, 'uraian_barang' => 3]
            $headerMap = [];
            foreach ($headerRow as $index => $columnName) {
                // Convert "Nomor Risalah" -> "nomor_risalah" (lowercase, no spaces)
                $slug = Str::slug($columnName, '_');
                $headerMap[$slug] = $index;
            }

            // 3. CHECK FOR MISSING REQUIRED COLUMNS
            $requiredColumns = ['nomor_risalah', 'pemohon', 'jenis_lelang', 'uraian_barang'];
            $missingColumns = [];

            foreach ($requiredColumns as $col) {
                if (!array_key_exists($col, $headerMap)) {
                    $missingColumns[] = str_replace('_', ' ', ucfirst($col));
                }
            }

            if (!empty($missingColumns)) {
                return redirect()->back()->with([
                'alert' => 'Kolom berikut tidak ditemukan di CSV: ' . implode(', ', $missingColumns),
                'type' => AlertEnum::DANGER->value,
                ]);
            }

            // 4. PROCESS THE DATA
            DB::beginTransaction();
            try {
                while (($row = fgetcsv($handle, 1000, ',')) !== FALSE) {

                    // Use the MAP to find data, regardless of order
                    $nomorVal = $row[$headerMap['nomor_risalah']] ?? null;
                    $pemohonVal = $row[$headerMap['pemohon']] ?? null;
                    $jenisRaw = $row[$headerMap['jenis_lelang']] ?? '';
                    $uraianVal = $row[$headerMap['uraian_barang']] ?? null;

                    // Skip empty rows (common issue at end of CSVs)
                    if (!$nomorVal)
                        continue;

                    // Normalize Jenis Lelang
                    $jenisClean = strtolower(trim($jenisRaw));
                    $validJenis = in_array($jenisClean, ['jenis1', 'jenis2']) ? $jenisClean : 'jenis1';

                    Arsip::updateOrCreate(
                        ['nomor_risalah' => $nomorVal],
                        [
                            'pemohon' => $pemohonVal,
                            'jenis_lelang' => $validJenis,
                            'uraian_barang' => $uraianVal,
                            'status' => true,
                        ]
                    );
                }

                DB::commit();
                fclose($handle);
                return redirect()->route('arsip.index')->with([
                    'alert' => 'Berhasil mengupload file arsip!',
                    'type' => AlertEnum::SUCCESS->value,
                ]);

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with([
                    'alert' => $e->getMessage(),
                    'type' => AlertEnum::DANGER->value,
                ]);
            }
        }

        return redirect()->back()->with('error', 'Gagal membuka file.');
    }
}
