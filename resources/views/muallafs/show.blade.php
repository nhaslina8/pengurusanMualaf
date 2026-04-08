<x-app-layout>
    <div class="grid grid-cols-1 gap-6">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-8">
                <h2 class="text-3xl font-bold text-white">{{ $muallaf->NamaIslam }}</h2>
                <p class="text-blue-100 mt-2">
                    @if($muallaf->Status === 'A')
                        <span class="inline-block px-3 py-1 bg-green-500 text-white rounded-full text-sm font-medium">Aktif</span>
                    @else
                        <span class="inline-block px-3 py-1 bg-red-500 text-white rounded-full text-sm font-medium">Tidak Aktif</span>
                    @endif
                </p>
            </div>

            <div class="px-6 py-4 flex gap-2">
                <a href="{{ route('muallafs.edit', $muallaf->Id) }}" class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-md font-medium transition">
                    Ubah
                </a>
                <form action="{{ route('muallafs.destroy', $muallaf->Id) }}" method="POST" class="inline" onsubmit="return confirm('Adakah anda pasti untuk padam rekod ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md font-medium transition">
                        Padam
                    </button>
                </form>
                <a href="{{ route('muallafs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md font-medium transition">
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Maklumat Peribadi</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Nama Asal</p>
                        <p class="text-gray-900 font-medium">{{ $muallaf->NamaAsal ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">No. Kad Pengenalan</p>
                        <p class="text-gray-900 font-medium">{{ $muallaf->NoKP ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Jantina</p>
                        <p class="text-gray-900 font-medium">{{ $jantinaLabel ?? $muallaf->Jantina ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Bangsa</p>
                        <p class="text-gray-900 font-medium">{{ $muallaf->Bangsa ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Maklumat Muallaf</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Kategori Muallaf</p>
                        <p class="text-gray-900 font-medium">{{ $muallaf->KategoriMuallaf ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Tarikh Memeluk Islam</p>
                        <p class="text-gray-900 font-medium">
                            @if($muallaf->TarikhIslam)
                                {{ \Carbon\Carbon::parse($muallaf->TarikhIslam)->format('d/m/Y (l)') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Pendakwah</p>
                        <p class="text-gray-900 font-medium">{{ $muallaf->Pendakwah ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Bilangan Daftar</p>
                        <p class="text-gray-900 font-medium">{{ $muallaf->BilDaftar ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Maklumat Hubungan</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">No. Telefon</p>
                        <p class="text-gray-900 font-medium">{{ $muallaf->NoTel1 ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Alamat</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Alamat Penuh</p>
                        <p class="text-gray-900 font-medium">
                            @if($muallaf->Alamat1 || $muallaf->Alamat2 || $muallaf->Alamat3)
                                @if($muallaf->Alamat1) {{ $muallaf->Alamat1 }}<br> @endif
                                @if($muallaf->Alamat2) {{ $muallaf->Alamat2 }}<br> @endif
                                @if($muallaf->Alamat3) {{ $muallaf->Alamat3 }}<br> @endif
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Poskod</p>
                        <p class="text-gray-900 font-medium">{{ $muallaf->Poskod ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Bandar</p>
                        <p class="text-gray-900 font-medium">{{ $muallaf->Bandar ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Negeri</p>
                        <p class="text-gray-900 font-medium">{{ $muallaf->Negeri ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Daerah</p>
                        <p class="text-gray-900 font-medium">{{ $daerahLabel ?? $muallaf->Daerah ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Maklumat Bank</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Kod Bank</p>
                        <p class="text-gray-900 font-medium">{{ $bankLabel ?? $muallaf->KodBank ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">No. Akaun Bank</p>
                        <p class="text-gray-900 font-medium">{{ $muallaf->NoAkaunBank ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Lampiran</h3>

                @if(($lampiranMuallaf ?? collect())->isEmpty())
                    <p class="text-gray-500">Tiada lampiran.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th class="text-left px-3 py-2">Jenis</th>
                                    <th class="text-left px-3 py-2">Nama Fail</th>
                                    <th class="text-left px-3 py-2">Saiz</th>
                                    <th class="text-left px-3 py-2">Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lampiranMuallaf as $lampiran)
                                    <tr class="border-b border-gray-100">
                                        <td class="px-3 py-2">{{ $lampiranTypeLabels[$lampiran->TYPE2] ?? $lampiran->TYPE2 ?? '-' }}</td>
                                        <td class="px-3 py-2">{{ $lampiran->FILE_NAME ?? '-' }}</td>
                                        <td class="px-3 py-2">{{ isset($lampiran->FILE_SIZE) ? number_format((int) $lampiran->FILE_SIZE / 1024, 2) . ' KB' : '-' }}</td>
                                        <td class="px-3 py-2 break-all text-gray-600">{{ $lampiran->FILE_LOC ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            @if($muallaf->Catatan)
                <div class="md:col-span-2 bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Catatan</h3>
                    <p class="text-gray-900 whitespace-pre-wrap">{{ $muallaf->Catatan }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
