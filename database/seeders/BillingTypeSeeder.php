<?php

namespace Database\Seeders;

use App\Models\BillingType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BillingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BillingType::insert([
            [
                'code' => 'UG01',
                'name' => 'Uang Gedung',
                'description' => 'Pembayaran Uang Gedung Tahap 1',
                'amount' => 1500000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SPP07',
                'name' => 'SPP Bulanan',
                'description' => 'SPP Bulan Juli 2025',
                'amount' => 300000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PM01',
                'name' => 'Pendaftaran',
                'description' => 'Pendaftaran Masuk Sekolah',
                'amount' => 500000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'SRG01',
                'name' => 'Seragam Sekolah',
                'description' => 'Pembelian Seragam Sekolah',
                'amount' => 500000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
