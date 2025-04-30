{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-heading">
        <h3>History Pembayaran</h3>
    </div>

    {{-- Tambahkan komponen dashboard kamu di sini --}}
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Lihat History Pembayaran
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Bayar</th>
                                <th>Jumlah Bayar</th>
                                <th>Metode</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historyPembayaran as $data)
                                <tr>
                                    <td>{{ $loop->tanggal_bayar }}</td>
                                    <td>{{ number_format($data->jumlah_bayar, 0) }}</td>
                                    <td>{{ $data->metode }}</td>
                                    <td>{{ $data->status }}</td>
                                    <td>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- ✅ Tampilkan link pagination --}}
                    {{ $historyPembayaran->links() }}
                </div>
            </div>

        </section>
    </div>


    {{-- Jquery --}}
@endsection
