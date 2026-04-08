<x-app-layout>
    <div class="grid grid-cols-1 gap-6">
        <div class="bg-white shadow rounded-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 px-6 py-8">
                <h2 class="text-3xl font-bold text-white">{{ $pendakwah->NamaIslam }}</h2>
                <p class="text-blue-100 mt-2">
                    @if($pendakwah->Status === 'Y')
                        <span class="inline-block px-3 py-1 bg-green-500 text-white rounded-full text-sm font-medium">Aktif</span>
                    @else
                        <span class="inline-block px-3 py-1 bg-red-500 text-white rounded-full text-sm font-medium">Tidak Aktif</span>
                    @endif
                </p>
            </div>

            <div class="px-6 py-4 flex gap-2">
                <a href="{{ route('pendakwahs.edit', $pendakwah->Id) }}" class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white rounded-md font-medium transition">
                    Ubah
                </a>
                <form action="{{ route('pendakwahs.destroy', $pendakwah->Id) }}" method="POST" class="inline" onsubmit="return confirm('Adakah anda pasti untuk padam rekod ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md font-medium transition">
                        Padam
                    </button>
                </form>
                <a href="{{ route('pendakwahs.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md font-medium transition">
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
                        <p class="text-gray-900 font-medium">{{ $pendakwah->NamaAsal ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">No. Kad Pengenalan</p>
                        <p class="text-gray-900 font-medium">{{ $pendakwah->NoKP ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Jantina</p>
                        <p class="text-gray-900 font-medium">{{ $jantinaLabel ?? $pendakwah->Jantina ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Bangsa</p>
                        <p class="text-gray-900 font-medium">{{ $pendakwah->Bangsa ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Maklumat Pendakwah</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Kategori</p>
                        <p class="text-gray-900 font-medium">{{ $pendakwah->Kategori ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Tarikh Memeluk Islam</p>
                        <p class="text-gray-900 font-medium">
                            @if($pendakwah->TarikhIslam)
                                {{ \Carbon\Carbon::parse($pendakwah->TarikhIslam)->format('d/m/Y (l)') }}
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Daerah</p>
                        <p class="text-gray-900 font-medium">{{ $daerahLabel ?? $pendakwah->Daerah ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">No. Telefon</p>
                        <p class="text-gray-900 font-medium">{{ $pendakwah->NoTel1 ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Alamat</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Alamat Penuh</p>
                        <p class="text-gray-900 font-medium">
                            @if($pendakwah->Alamat1 || $pendakwah->Alamat2 || $pendakwah->Alamat3)
                                @if($pendakwah->Alamat1) {{ $pendakwah->Alamat1 }}<br> @endif
                                @if($pendakwah->Alamat2) {{ $pendakwah->Alamat2 }}<br> @endif
                                @if($pendakwah->Alamat3) {{ $pendakwah->Alamat3 }}<br> @endif
                            @else
                                -
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Poskod</p>
                        <p class="text-gray-900 font-medium">{{ $pendakwah->Poskod ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Bandar</p>
                        <p class="text-gray-900 font-medium">{{ $pendakwah->Bandar ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Negeri</p>
                        <p class="text-gray-900 font-medium">{{ $pendakwah->Negeri ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Maklumat Bank</h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-sm text-gray-600">Kod Bank</p>
                        <p class="text-gray-900 font-medium">{{ $bankLabel ?? $pendakwah->KodBank ?? '-' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">No. Akaun Bank</p>
                        <p class="text-gray-900 font-medium">{{ $pendakwah->NoAkaunBank ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2 bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Maklumat Lantikan</h3>

                @if(($pendakwah->lantikans ?? collect())->isEmpty())
                    <p class="text-gray-500">Tiada rekod lantikan.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-200">
                                    <th class="text-left px-3 py-2">Tahun</th>
                                    <th class="text-left px-3 py-2">Tarikh Mula</th>
                                    <th class="text-left px-3 py-2">Tarikh Akhir</th>
                                    <th class="text-left px-3 py-2">Status</th>
                                    <th class="text-left px-3 py-2">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pendakwah->lantikans as $lantikan)
                                    <tr class="border-b border-gray-100">
                                        <td class="px-3 py-2">{{ $lantikan->Tahun ?? '-' }}</td>
                                        <td class="px-3 py-2">{{ $lantikan->TarikhMula ? \Carbon\Carbon::parse($lantikan->TarikhMula)->format('d/m/Y') : '-' }}</td>
                                        <td class="px-3 py-2">{{ $lantikan->TarikhAkhir ? \Carbon\Carbon::parse($lantikan->TarikhAkhir)->format('d/m/Y') : '-' }}</td>
                                        <td class="px-3 py-2">{{ ($lantikan->Status ?? 'Y') === 'Y' ? 'Aktif' : 'Tidak Aktif' }}</td>
                                        <td class="px-3 py-2">{{ $lantikan->Catatan ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            @if($pendakwah->Catatan)
                <div class="md:col-span-2 bg-white shadow rounded-lg p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 pb-2 border-b border-gray-200">Catatan</h3>
                    <p class="text-gray-900 whitespace-pre-wrap">{{ $pendakwah->Catatan }}</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
