<input
    type="hidden"
    name="IdPenggunaMain"
    value="{{ old('IdPenggunaMain', $muallaf->IdPenggunaMain ?? 0) }}"
>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Nama Islam -->
    <div>
        <label for="NamaIslam" class="block text-sm font-medium text-gray-900 mb-2">
            Nama Islam <span class="text-red-600">*</span>
        </label>
        <input 
            type="text" 
            id="NamaIslam" 
            name="NamaIslam" 
            value="{{ old('NamaIslam', $muallaf->NamaIslam ?? '') }}"
            required
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Masukkan nama Islam"
        >
        @error('NamaIslam')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Nama Asal -->
    <div>
        <label for="NamaAsal" class="block text-sm font-medium text-gray-900 mb-2">
            Nama Asal
        </label>
        <input 
            type="text" 
            id="NamaAsal" 
            name="NamaAsal" 
            value="{{ old('NamaAsal', $muallaf->NamaAsal ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Masukkan nama asal"
        >
    </div>

    <!-- No. KP -->
    <div>
        <label for="NoKP" class="block text-sm font-medium text-gray-900 mb-2">
            No. Kad Pengenalan
        </label>
        <input 
            type="text" 
            id="NoKP" 
            name="NoKP" 
            value="{{ old('NoKP', $muallaf->NoKP ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Cth: 123456-12-1234"
        >
    </div>

    <!-- Jantina -->
    <div>
        <label for="Jantina" class="block text-sm font-medium text-gray-900 mb-2">
            Jantina
        </label>
        <select 
            id="Jantina" 
            name="Jantina"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="">-- Pilih Jantina --</option>
            <option value="L" {{ old('Jantina', $muallaf->Jantina ?? '') === 'L' ? 'selected' : '' }}>Lelaki</option>
            <option value="P" {{ old('Jantina', $muallaf->Jantina ?? '') === 'P' ? 'selected' : '' }}>Perempuan</option>
        </select>
    </div>

    <!-- Bangsa -->
    <div>
        <label for="Bangsa" class="block text-sm font-medium text-gray-900 mb-2">
            Bangsa
        </label>
        <input 
            type="text" 
            id="Bangsa" 
            name="Bangsa" 
            value="{{ old('Bangsa', $muallaf->Bangsa ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Cth: Melayu, Arab, China"
        >
    </div>

    <!-- Kategori Muallaf -->
    <div>
        <label for="KategoriMuallaf" class="block text-sm font-medium text-gray-900 mb-2">
            Kategori Muallaf
        </label>
        <select 
            id="KategoriMuallaf" 
            name="KategoriMuallaf"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="">-- Pilih Kategori --</option>
            <option value="Baru" {{ old('KategoriMuallaf', $muallaf->KategoriMuallaf ?? '') === 'Baru' ? 'selected' : '' }}>Baru</option>
            <option value="Lama" {{ old('KategoriMuallaf', $muallaf->KategoriMuallaf ?? '') === 'Lama' ? 'selected' : '' }}>Lama</option>
        </select>
    </div>

    <!-- Tarikh Islam -->
    <div>
        <label for="TarikhIslam" class="block text-sm font-medium text-gray-900 mb-2">
            Tarikh Memeluk Islam
        </label>
        <input 
            type="date" 
            id="TarikhIslam" 
            name="TarikhIslam" 
            value="{{ old('TarikhIslam', $muallaf->TarikhIslam ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
    </div>

    <!-- No. Telefon -->
    <div>
        <label for="NoTel1" class="block text-sm font-medium text-gray-900 mb-2">
            No. Telefon
        </label>
        <input 
            type="text" 
            id="NoTel1" 
            name="NoTel1" 
            value="{{ old('NoTel1', $muallaf->NoTel1 ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Cth: 0123456789"
        >
    </div>

    <!-- Negeri -->
    <div>
        <label for="Negeri" class="block text-sm font-medium text-gray-900 mb-2">
            Negeri
        </label>
        <input 
            type="text" 
            id="Negeri" 
            name="Negeri" 
            value="{{ old('Negeri', $muallaf->Negeri ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Cth: Selangor, Kuala Lumpur"
        >
    </div>

    <!-- Bandar -->
    <div>
        <label for="Bandar" class="block text-sm font-medium text-gray-900 mb-2">
            Bandar/Kota
        </label>
        <input 
            type="text" 
            id="Bandar" 
            name="Bandar" 
            value="{{ old('Bandar', $muallaf->Bandar ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Cth: Petaling Jaya"
        >
    </div>

    <!-- Poskod -->
    <div>
        <label for="Poskod" class="block text-sm font-medium text-gray-900 mb-2">
            Poskod
        </label>
        <input 
            type="text" 
            id="Poskod" 
            name="Poskod" 
            value="{{ old('Poskod', $muallaf->Poskod ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Cth: 58000"
        >
    </div>

    <!-- Daerah -->
    <div>
        <label for="Daerah" class="block text-sm font-medium text-gray-900 mb-2">
            Daerah
        </label>
        <input 
            type="text" 
            id="Daerah" 
            name="Daerah" 
            value="{{ old('Daerah', $muallaf->Daerah ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Cth: Petaling"
        >
    </div>

    <!-- Pendakwah -->
    <div>
        <label for="Pendakwah" class="block text-sm font-medium text-gray-900 mb-2">
            Pendakwah
        </label>
        <input 
            type="text" 
            id="Pendakwah" 
            name="Pendakwah" 
            value="{{ old('Pendakwah', $muallaf->Pendakwah ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Masukkan nama pendakwah"
        >
    </div>

    <!-- Status -->
    <div>
        <label for="Status" class="block text-sm font-medium text-gray-900 mb-2">
            Status
        </label>
        <select 
            id="Status" 
            name="Status"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
        >
            <option value="">-- Pilih Status --</option>
            <option value="A" {{ old('Status', $muallaf->Status ?? '') === 'A' ? 'selected' : '' }}>Aktif</option>
            <option value="I" {{ old('Status', $muallaf->Status ?? '') === 'I' ? 'selected' : '' }}>Tidak Aktif</option>
        </select>
    </div>
</div>

<!-- Alamat (Full Width) -->
<div class="grid grid-cols-1 gap-6 mt-6">
    <div>
        <label for="Alamat1" class="block text-sm font-medium text-gray-900 mb-2">
            Alamat 1
        </label>
        <input 
            type="text" 
            id="Alamat1" 
            name="Alamat1" 
            value="{{ old('Alamat1', $muallaf->Alamat1 ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Baris alamat pertama"
        >
    </div>

    <div>
        <label for="Alamat2" class="block text-sm font-medium text-gray-900 mb-2">
            Alamat 2
        </label>
        <input 
            type="text" 
            id="Alamat2" 
            name="Alamat2" 
            value="{{ old('Alamat2', $muallaf->Alamat2 ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Baris alamat kedua"
        >
    </div>

    <div>
        <label for="Alamat3" class="block text-sm font-medium text-gray-900 mb-2">
            Alamat 3
        </label>
        <input 
            type="text" 
            id="Alamat3" 
            name="Alamat3" 
            value="{{ old('Alamat3', $muallaf->Alamat3 ?? '') }}"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Baris alamat ketiga (opsional)"
        >
    </div>

    <!-- Catatan -->
    <div>
        <label for="Catatan" class="block text-sm font-medium text-gray-900 mb-2">
            Catatan
        </label>
        <textarea 
            id="Catatan" 
            name="Catatan"
            rows="4"
            class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
            placeholder="Masukkan catatan tambahan"
        >{{ old('Catatan', $muallaf->Catatan ?? '') }}</textarea>
    </div>

    <!-- Bank Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="KodBank" class="block text-sm font-medium text-gray-900 mb-2">
                Kod Bank
            </label>
            <input 
                type="text" 
                id="KodBank" 
                name="KodBank" 
                value="{{ old('KodBank', $muallaf->KodBank ?? '') }}"
                class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Cth: 012"
            >
        </div>

        <div>
            <label for="NoAkaunBank" class="block text-sm font-medium text-gray-900 mb-2">
                No. Akaun Bank
            </label>
            <input 
                type="text" 
                id="NoAkaunBank" 
                name="NoAkaunBank" 
                value="{{ old('NoAkaunBank', $muallaf->NoAkaunBank ?? '') }}"
                class="w-full px-4 py-2 border border-gray-300  rounded-md   focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Masukkan no. akaun"
            >
        </div>
    </div>
</div>
