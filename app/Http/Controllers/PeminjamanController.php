<?php

namespace App\Http\Controllers;

use App\Enums\AlertEnum;
use App\Models\Arsip;
use App\Models\Peminjaman;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'pending');
        $page = $request->query('page', 1);
        $search = $request->query('search', '');

        $peminjamans = Cache::remember(
            "peminjaman_{$tab}_page_{$page}_search_{$search}",
            30,
            fn() =>
            Peminjaman::with(['arsip', 'user:id,name'])
                ->when($search, function ($query, $search) {
                    $query->whereHas('arsip', function ($q) use ($search) {
                        // Update: Search by nomor_risalah or uraian_barang
                        $q->where('nomor_risalah', 'LIKE', "%{$search}%")
                            ->orWhere('uraian_barang', 'LIKE', "%{$search}%");
                    });
                })
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })
                ->where('status', $tab)
                ->latest()
                ->paginate(10)
        );
        return view('admin.peminjaman', compact('peminjamans', 'tab'));
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
        //
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
        $status = $request->input('status');
        // Eager load 'arsip' so we can update it easily
        $peminjaman = Peminjaman::with('arsip')->findOrFail($id);

        $peminjaman->status = $status;

        if ($status === 'approved') {
            // Update Arsip Status
            // We use the relationship because arsip_id is a string (nomor_risalah)
            // Ensure your Peminjaman Model has: return $this->belongsTo(Arsip::class, 'arsip_id', 'nomor_risalah');
            if ($peminjaman->arsip) {
                $peminjaman->arsip->update([
                    'status' => 0 // Assuming 0 = unavailable/dipinjam based on previous context
                ]);
            }
        } else if ($status === 'returned') {
            $peminjaman->returned = now();

            if ($peminjaman->arsip) {
                $peminjaman->arsip->update([
                    'status' => 1 // Assuming 1 = available/tersedia
                ]);
            }

            // Flush cache to reflect 'available' status in other lists
            Cache::flush();
        }

        $peminjaman->save();

        return redirect()
            ->to(url()->previous())
            ->with(['alert' => 'Status peminjaman berhasil diperbarui!', 'type' => AlertEnum::SUCCESS->value]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        $peminjaman->delete();

        // Optional: Clear cache on delete to update lists
        Cache::flush();

        return redirect()
            ->route('peminjaman.index')
            ->with([
                'alert' => 'Ajuan peminjaman ditolak',
                'type' => AlertEnum::INFO->value,
            ]);
    }

    public function history(Request $request)
    {
        $page = $request->query('page', 1);
        $search = $request->query('search', '');

        $riwayat = Cache::remember(
            "peminjaman_riwayat_page_{$page}_search_{$search}",
            30,
            fn() =>
            Peminjaman::with(['arsip', 'user:id,name'])
                ->when($search, function ($query, $search) {
                    $query->whereHas('arsip', function ($q) use ($search) {
                        // Update: Search by nomor_risalah or uraian_barang
                        $q->where('nomor_risalah', 'LIKE', "%{$search}%")
                            ->orWhere('uraian_barang', 'LIKE', "%{$search}%");
                    });
                })
                ->orWhereHas('user', function ($q) use ($search) {
                    $q->where('name', 'LIKE', "%{$search}%");
                })
                ->where('status', 'returned')
                ->latest()
                ->paginate(10)
        );

        return view('admin.riwayat', compact('riwayat'));
    }
}
