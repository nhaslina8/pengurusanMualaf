<x-app-layout>
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
            <h2 class="text-2xl font-bold text-gray-900">Tambah Pendakwah Baru</h2>
            <p class="text-sm text-gray-600 mt-1">Sila isi borang di bawah untuk menambah rekod pendakwah baru</p>
        </div>

        <form action="{{ route('pendakwahs.store') }}" method="POST" class="p-6">
            @csrf

            @include('pendakwahs.form')

            <div class="flex gap-4 mt-8 pt-6 border-t border-gray-200">
                <button type="submit" class="inline-flex items-center px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-medium transition">
                    Simpan
                </button>
                <a href="{{ route('pendakwahs.index') }}" class="inline-flex items-center px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-md font-medium transition">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-app-layout>
