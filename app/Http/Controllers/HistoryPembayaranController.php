<?php

namespace App\Http\Controllers;

use App\Models\HistoryPembayaranModel;
use Illuminate\Http\Request;

class HistoryPembayaranController extends Controller
{
    public function index()
    {
        $historyPembayaran = HistoryPembayaranModel::paginate(10);
        return view('transaksi_pembayaran.history_pembayaran.index', compact('historyPembayaran'));
    }
}
