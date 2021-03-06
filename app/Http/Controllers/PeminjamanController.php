<?php

namespace App\Http\Controllers;

use App\Buku;
use App\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'admin') {
            $data_peminjaman = Peminjaman::latest()->get();
        } else {
            $data_peminjaman = Peminjaman::where('user_id', auth()->id())->get();
        }
        return view('peminjaman.index', compact('data_peminjaman'));
    }

    public function store(Buku $buku)
    {
        $cek_buku = Buku::where([
            ['id', $buku->id],
            ['status', 1],
            ['stok', '>', 0]
        ])->count();

        if ($cek_buku) {
            Peminjaman::create([
                'user_id' => Auth::id(),
                'buku_id' => $buku->id
            ]);

            $update_buku = Buku::findOrFail($buku->id);
            $update_buku->stok--;
            $update_buku->save();

            session()->flash('success', 'Buku berhasil dipinjam!');
        } else {
            session()->flash('error', 'Buku sudah habis atau tidak aktif!');
        }

        return redirect()->route('buku.index');
    }

    public function changeStatus(Peminjaman $peminjaman)
    {
        if ($peminjaman->status == null) {
            $peminjaman->update([
                'status' => 1
            ]);
        } else {
            $peminjaman->update([
                'status' => 0
            ]);
        }

        return back();
    }

    public function cek()
    {
        return request()->all();
    }
}




// p: line 14 : untuk mengecek buku dengan status & id yang disyaratkan ada
// method count() menghasilkan nilai boolean

// p: line 27: mengurangi stok buku setiap ada peminjaman




// k: status
// null = menunggu verifikasi
// 0 = ditolak
// 1 = disetujui
// 2 = dikembalikan / sudah dipinjam
