@extends('layouts.app')

@section('content')
    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>
    <section class="row">
        <div class="col-12 col-lg-9">
            <div class="row">
                <div class="col-6 col-lg-4 col-md-6">
                    <div class="card">
                        <div class="card-body px-4 py-4-5">
                            <div class="d-flex align-items-center">
                                <div class="stats-icon purple mb-2">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                                <div class="ms-3">
                                    <h6 class="text-muted font-semibold">Siswa Terdaftar</h6>
                                    <h6 class="font-extrabold mb-0">124</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- Tambahkan kartu lainnya --}}
            </div>
        </div>
    </section>
@endsection
