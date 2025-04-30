<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistoryPembayaranModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaksi_pembayaran';

    protected $fillable = [
        'siswa_id',
        'tagihan_id',
        'tanggal_bayar',
        'jumlah_bayar',
        'metode',
        'status',
        'dibuat_oleh',
    ];

    protected $dates = ['deleted_at'];
}
