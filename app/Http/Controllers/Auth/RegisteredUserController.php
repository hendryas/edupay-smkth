<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OrangTua;
use App\Models\RegistrationSchool;
use App\Models\Siswa;
use App\Models\Tagihan;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate([
        // Validasi User
        'name' => 'required|string|max:255',
        'email' => 'required|string|lowercase|email|max:255|unique:users,email',
        'password' => ['required', 'confirmed', Rules\Password::defaults()],

        // Validasi Biodata Siswa
        'nama_siswa' => 'required|string|max:255',

        // Validasi Biodata Orang Tua
        'nama_orang_tua' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
        'email_orang_tua' => 'nullable|email|max:255',
        'no_hp_orang_tua' => 'required|string|max:20',
        'pekerjaan' => 'nullable|string|max:255',
        'hubungan_dengan_siswa' => 'required|in:Ayah,Ibu,Wali',
    ]);

    DB::beginTransaction();

    try {
        // 1. Buat User Baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 2. Buat Orang Tua
        $orangTua = OrangTua::create([
            'nama_lengkap' => $request->nama_orang_tua,
            'jenis_kelamin' => $request->jenis_kelamin,
            'email' => $request->email_orang_tua,
            'no_hp' => $request->no_hp_orang_tua,
            'alamat' => '-', // Bisa diisi default '-' dulu kalau tidak ada input alamat
            'pekerjaan' => $request->pekerjaan,
            'hubungan_dengan_siswa' => $request->hubungan_dengan_siswa,
        ]);

        // 3. Buat Siswa
        $siswa = Siswa::create([
            'orang_tua_id' => $orangTua->id,
            'nama' => $request->nama_siswa,
            'nis' => '-', // default kosong dulu (karena form tidak input NIS)
            'kelas' => '-', // default kosong juga
            'nomor_wa' => $request->no_hp_orang_tua, // disamakan ke no hp ortu dulu
        ]);

        // 4. Update Siswa_ID di Orang Tua
        $orangTua->update([
            'siswa_id' => $siswa->id,
        ]);

        // 5. Buat RegistrationSchool
        RegistrationSchool::create([
            'orang_tua_id' => $orangTua->id,
            'siswa_id' => $siswa->id,
            'tanggal_pendaftaran' => now(),
            'status_pendaftaran' => 'pending', // default status pendaftaran
            'catatan' => null,
        ]);

        // 6. Insert Tagihan
        Tagihan::create([
            'siswa_id' => $siswa->id,
            'biling_type_id' => '3',
            'nama_tagihan' => 'Pendaftaran Masuk Sekolah',
            'nominal' => 500000,
            'periode' => '2024/2025',
            'deskripsi' => 'Pendaftaran masuk tahun ajaran baru',
        ]);

        DB::commit();

        event(new Registered($user));

        Auth::login($user);

        session([
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role, // pastikan tabel 'users' ada kolom 'role'
        ]);

        return redirect(route('dashboard', absolute: false));
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => 'Pendaftaran gagal. Silakan coba lagi. Error: '.$e->getMessage()]);
    }
}
}
