<x-app-layout>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between bg-gradient-to-r from-blue-50 to-indigo-50">
            <h2 class="text-2xl font-bold text-gray-900">Senarai Pendakwah</h2>
            <a href="{{ route('pendakwahs.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-medium transition shadow-md">
                + Tambah Pendakwah
            </a>
        </div>

        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <form method="GET" action="{{ route('pendakwahs.index') }}" class="flex gap-2">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama Islam atau nama asal..."
                    value="{{ request('search') }}"
                    class="flex-1 px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                >
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-medium transition">
                    Cari
                </button>
                <a href="{{ route('pendakwahs.index') }}" class="px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white rounded-md font-medium transition">
                    Reset
                </a>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-100 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Nama Islam</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Nama Asal</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">No. KP</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">No. Tel</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-900">Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendakwahs as $pendakwah)
                        <tr class="border-b border-gray-200 hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $pendakwah->NamaIslam }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $pendakwah->NamaAsal }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $pendakwah->NoKP }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $pendakwah->NoTel1 }}</td>
                            <td class="px-6 py-4 text-right text-sm space-x-2">
                                <a href="{{ route('pendakwahs.show', $pendakwah->Id) }}" class="inline-flex items-center px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white rounded text-xs font-medium transition">
                                    Lihat
                                </a>
                                <a href="{{ route('pendakwahs.edit', $pendakwah->Id) }}" class="inline-flex items-center px-3 py-1 bg-amber-500 hover:bg-amber-600 text-white rounded text-xs font-medium transition">
                                    Ubah
                                </a>
                                <form action="{{ route('pendakwahs.destroy', $pendakwah->Id) }}" method="POST" class="inline" onsubmit="return confirm('Adakah anda pasti untuk padam rekod ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white rounded text-xs font-medium transition">
                                        Padam
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <p class="mb-2">Tiada data pendakwah.</p>
                                <a href="{{ route('pendakwahs.create') }}" class="text-blue-600 hover:text-blue-800 font-medium">Tambah sekarang -></a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
