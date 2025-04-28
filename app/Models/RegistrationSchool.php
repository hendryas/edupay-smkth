<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RegistrationSchool extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'registration_school';

    protected $fillable = [
        'orang_tua_id',
        'siswa_id',
        'tanggal_pendaftaran',
        'status_pendaftaran',
        'catatan',
    ];

    protected $dates = ['deleted_at'];
}
