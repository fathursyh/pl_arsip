<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Cache;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        $tab = $request->query('tab', 'pending');
        $page = $request->query('page', 1);
        $peminjamans = Cache::remember(
            "peminjaman_{$tab}_page_{$page}",
            30,
            fn() =>
            Peminjaman::with(['arsip:id,title', 'user:id,name'])
                ->where('status', $tab)
                ->latest()->paginate(10)
        );
        return view('admin.peminjaman', compact('peminjamans', 'tab'));
    }
}
