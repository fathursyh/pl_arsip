<?php

namespace App\Http\Controllers;

use App\Enums\AlertEnum;
use App\Models\Arsip;
use App\Models\Peminjaman;
use App\Models\User;
use Auth;
use Cache;
use DB;
use Illuminate\Http\Request;

class UserRoleController extends Controller
{

    public function index()
    {
        $totalArsip = Arsip::count();
        $activeLoans = Peminjaman::where('status', 'approved')->count();
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $loanHistory = Peminjaman::where('status', 'returned')->count();
        $chartData = Peminjaman::selectRaw('MONTHNAME(borrowed) as month, COUNT(*) as count')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get()->toArray();

        return view('user.home', [
            'totalArsip' => $totalArsip,
            'activeLoans' => $activeLoans,
            'totalUsers' => $totalUsers,
            'loanHistory' => $loanHistory,
            'chartData' => $chartData
        ]);
    }
    public function arsip(Request $request)
    {
        $search = $request->query('search', '');
        $page = request('page', 1);
        $arsips = Cache::remember(
            'arsip_' . md5($search) . '_page_' . $page,
            30,
            fn() =>
            Arsip::where('nomor_risalah', 'like', "%$search%")->latest()->paginate(10)
        );
        return view('user.arsip', compact('arsips'));
    }

    public function peminjaman(Request $request)
    {
        $userId = Auth::id();
        $page = $request->query('page', 1);
        $search = $request->query('search', '');

        // Cache key must include User ID to separate data between users
        $peminjamans = Cache::remember(
            "peminjaman_user_{$userId}_page_{$page}_search_{$search}",
            30,
            fn() =>
            Peminjaman::with(['arsip']) // No need to eager load 'user', we know who it is
                ->where('user_id', $userId) // STRICTLY filter by logged-in user
                ->when($search, function ($query, $search) {
                    $query->whereHas('arsip', function ($q) use ($search) {
                        $q->where('nomor_risalah', 'LIKE', "%{$search}%");
                    });
                })
                ->latest()
                ->paginate(10)
        );

        // Make sure this points to the new User Blade file you created
        return view('user.peminjaman', compact('peminjamans'));
    }

    public function pinjamArsip(string $id)
    {
        try {
            $arsip = Arsip::findOrFail($id);
        } catch (exeption) {
            return redirect()
                ->route('user.arsip')
                ->with([
                    'alert' => 'Arsip tidak ditemukan.',
                    'type' => AlertEnum::DANGER->value,
                ]);
        }

        if (!$arsip->status) {
            return back()->with([
                'alert' => 'Maaf, Arsip ini sudah tidak tersedia (sedang dipinjam).',
                'type' => AlertEnum::DANGER->value,
            ]);
        }

        // 3. Use DB Transaction for data integrity
        DB::transaction(function () use ($arsip) {
            // A. Create the Loan Record
            Peminjaman::create([
                'user_id' => Auth::id(),
                'arsip_id' => $arsip->nomor_risalah,
                'borrowed' => now(),        // Date of request
                'status' => 'pending',      // Default status waiting for admin approval
            ]);
        });

        return redirect()->route('user.arsip') // Ensure this route name exists
            ->with([
                'alert' => 'Pengajuan peminjaman berhasil dikirim!',
                'type' => AlertEnum::SUCCESS->value, // or 'success'
            ]);
    }
}
