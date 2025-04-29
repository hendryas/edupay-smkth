<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class LihatSemuaPembayaranController extends Controller
{
    public function index()
    {
        $email = session('email');

        $orangTua = OrangTua::where('email', $email)->first();

        if(!$orangTua){
            return redirect()->back()->withErrors(['error' => 'Data orang tua tidak ditemukan.']);
        }

        $siswaId = $orangTua->siswa_id;

        $tagihan = Tagihan::where('siswa_id', $siswaId)->paginate(10);

        return view('transaksi_pembayaran.lihat_semua_pembayaran.index', compact('tagihan'));
    }
}
