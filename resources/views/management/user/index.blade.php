{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="page-heading">
        <h3>Management User</h3>
    </div>

    {{-- Tambahkan komponen dashboard kamu di sini --}}
    <div class="page-heading">
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        Data Management User
                    </h5>
                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahUser">Tambah +</a>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Peran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td>
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- ✅ Tampilkan link pagination --}}
{{ $users->links() }}
                </div>
            </div>
    
        </section>
    </div>

    {{-- Modal --}}
    <!-- Modal -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="modalTambahUserLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="formTambahUser">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTambahUserLabel">Tambah User Baru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body">
            <div class="mb-3">
                <label>Peran</label>
                <select name="role" class="form-control" required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                    <option value="user">User</option>
                </select>
                <div class="invalid-feedback" id="error-role"></div>
            </div>          
            <div class="mb-3">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" required>
                <div class="invalid-feedback" id="error-name"></div>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
                <div class="invalid-feedback" id="error-email"></div>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
                <div class="invalid-feedback" id="error-password"></div>
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
  <script>
   $(document).ready(function () {
    $('#formTambahUser').on('submit', function (e) {
        e.preventDefault();

        let $form = $(this);
        let $submitBtn = $form.find('button[type="submit"]');
        $submitBtn.prop('disabled', true).text('Menyimpan...');

        // Bersihkan error sebelumnya
        $form.find('.form-control').removeClass('is-invalid');
        $form.find('.invalid-feedback').text('');

        $.ajax({
            url: "{{ route('admin.users.store') }}",
            type: "POST",
            data: $form.serialize(),
            success: function (res) {
                $('#modalTambahUser').modal('hide');
                $form[0].reset();
                $submitBtn.prop('disabled', false).text('Simpan');

                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: res.message ?? 'User berhasil ditambahkan.',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    location.reload();
                });
            },
            error: function (xhr) {
                $submitBtn.prop('disabled', false).text('Simpan');

                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;
                    $.each(errors, function (key, messages) {
                        const input = $(`[name="${key}"]`);
                        input.addClass('is-invalid');
                        $(`#error-${key}`).text(messages[0]);
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: 'Terjadi kesalahan saat menyimpan data.'
                    });
                }
            }
        });
    });
});
  </script>
@endsection
