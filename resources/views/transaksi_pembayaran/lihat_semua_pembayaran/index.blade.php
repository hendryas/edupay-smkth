{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-heading">
        <h3>Management Billing Type</h3>
    </div>

    {{-- Tambahkan komponen dashboard kamu di sini --}}
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Lihat Semua Pembayaran
                    </h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Tagihan</th>
                                <th>Nominal</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tagihan as $data)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $data->nama_tagihan }}</td>
                                    <td>{{ number_format($data->nominal, 0) }}</td>
                                    <td>{{ $data->deskripsi }}</td>
                                    <td>
                                        <a href="javascript:void(0)" class="btn btn-sm btn-warning btn-payment"
                                            data-id="{{ $data->id }}" data-siswa-id="{{ $data->siswa_id }}"
                                            data-biling-type-id="{{ $data->biling_type_id }}"
                                            data-nama-tagihan="{{ $data->nama_tagihan }}"
                                            data-nominal="{{ $data->nominal }}" data-periode="{{ $data->periode }}"
                                            data-deskripsi="{{ $data->deskripsi }}">Payment</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- ✅ Tampilkan link pagination --}}
                    {{ $tagihan->links() }}
                </div>
            </div>

        </section>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formTambah">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTambahLabel">Tambah Jenis Pembayaran Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Kode</label>
                            <input type="text" name="code" class="form-control" required>
                            <div class="invalid-feedback" id="error-code"></div>
                        </div>
                        <div class="mb-3">
                            <label>Jenis Pembiayaan</label>
                            <input type="text" name="billing_type" class="form-control" required>
                            <div class="invalid-feedback" id="error-billing-type"></div>
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <input type="text" name="description" class="form-control" required>
                            <div class="invalid-feedback" id="error-description"></div>
                        </div>
                        <div class="mb-3">
                            <label>Amount</label>
                            <input type="text" name="amount" class="form-control" required>
                            <div class="invalid-feedback" id="error-amount"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formEdit">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" id="edit_id"> <!-- Hidden ID -->

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEditLabel">Edit Jenis Pembayaran Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Kode</label>
                            <input type="text" name="code" id="edit_code" class="form-control" required>
                            <div class="invalid-feedback" id="error-code"></div>
                        </div>
                        <div class="mb-3">
                            <label>Jenis Pembiayaan</label>
                            <input type="text" name="billing_type" id="edit_billing_type" class="form-control" required>
                            <div class="invalid-feedback" id="error-billing-type"></div>
                        </div>
                        <div class="mb-3">
                            <label>Deskripsi</label>
                            <input type="text" name="description" id="edit_description" class="form-control" required>
                            <div class="invalid-feedback" id="error-description"></div>
                        </div>
                        <div class="mb-3">
                            <label>Amount</label>
                            <input type="text" name="amount" id="edit_amount" class="form-control" required>
                            <div class="invalid-feedback" id="error-amount"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- Jquery --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        $(document).ready(function() {
            $('.btn-payment').click(function() {
                let id = $(this).data('id');

                $.ajax({
                    url: '{{ route('payment.token') }}',
                    type: 'POST',
                    data: {
                        id: id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        window.snap.pay(response.snapToken, {
                            onSuccess: function(result) {
                                alert('Pembayaran sukses!');
                                console.log(result);
                                // TODO: Kirim ke server untuk update status pembayaran
                            },
                            onPending: function(result) {
                                alert('Menunggu pembayaran...');
                                console.log(result);
                            },
                            onError: function(result) {
                                alert('Pembayaran gagal!');
                                console.log(result);
                            }
                        });
                    },
                    error: function(xhr, status, error) {
                        alert('Gagal mengambil snap token');
                    }
                });
            });

        });
    </script>
    </script>
@endsection
