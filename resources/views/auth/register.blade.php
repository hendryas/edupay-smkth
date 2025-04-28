<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Biodata Siswa -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Biodata Siswa</h2>

            <div>
                <x-input-label for="nama_siswa" :value="__('Nama Siswa')" />
                <x-text-input id="nama_siswa" class="block mt-1 w-full" type="text" name="nama_siswa" :value="old('nama_siswa')"
                    required autofocus />
                <x-input-error :messages="$errors->get('nama_siswa')" class="mt-2" />
            </div>
        </div>

        <!-- Biodata Orang Tua -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Biodata Orang Tua</h2>

            <div>
                <x-input-label for="nama_orang_tua" :value="__('Nama Orang Tua')" />
                <x-text-input id="nama_orang_tua" class="block mt-1 w-full" type="text" name="nama_orang_tua"
                    :value="old('nama_orang_tua')" required />
                <x-input-error :messages="$errors->get('nama_orang_tua')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="jenis_kelamin" :value="__('Jenis Kelamin')" />
                <select id="jenis_kelamin" name="jenis_kelamin" class="block mt-1 w-full rounded-md shadow-sm">
                    <option value="">-- Pilih Jenis Kelamin --</option>
                    <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <x-input-error :messages="$errors->get('jenis_kelamin')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email_orang_tua" :value="__('Email Orang Tua')" />
                <x-text-input id="email_orang_tua" class="block mt-1 w-full" type="email" name="email_orang_tua"
                    :value="old('email_orang_tua')" />
                <x-input-error :messages="$errors->get('email_orang_tua')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="no_hp_orang_tua" :value="__('No HP Orang Tua')" />
                <x-text-input id="no_hp_orang_tua" class="block mt-1 w-full" type="text" name="no_hp_orang_tua"
                    :value="old('no_hp_orang_tua')" required />
                <x-input-error :messages="$errors->get('no_hp_orang_tua')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="pekerjaan" :value="__('Pekerjaan Orang Tua')" />
                <x-text-input id="pekerjaan" class="block mt-1 w-full" type="text" name="pekerjaan"
                    :value="old('pekerjaan')" />
                <x-input-error :messages="$errors->get('pekerjaan')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="hubungan_dengan_siswa" :value="__('Hubungan dengan Siswa')" />
                <select id="hubungan_dengan_siswa" name="hubungan_dengan_siswa"
                    class="block mt-1 w-full rounded-md shadow-sm">
                    <option value="">-- Pilih Hubungan --</option>
                    <option value="Ayah" {{ old('hubungan_dengan_siswa') == 'Ayah' ? 'selected' : '' }}>Ayah</option>
                    <option value="Ibu" {{ old('hubungan_dengan_siswa') == 'Ibu' ? 'selected' : '' }}>Ibu</option>
                    <option value="Wali" {{ old('hubungan_dengan_siswa') == 'Wali' ? 'selected' : '' }}>Wali</option>
                </select>
                <x-input-error :messages="$errors->get('hubungan_dengan_siswa')" class="mt-2" />
            </div>
        </div>

        <!-- Informasi Akun -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-4">Registrasi Akun</h2>

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <!-- Tombol Submit -->
        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
