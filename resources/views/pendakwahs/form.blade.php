<input
    type="hidden"
    name="IdAkaunPengguna"
    value="{{ old('IdAkaunPengguna', $pendakwah->IdAkaunPengguna ?? '') }}"
>

@php
    $labelClass = 'mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-600';
    $controlClass = 'w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 shadow-sm transition duration-150 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100';
    $oldLantikans = old('lantikans');
    $existingLantikans = isset($pendakwah) ? ($pendakwah->lantikans ?? collect())->map(function ($item) {
        return [
            'Tahun' => $item->Tahun,
            'TarikhMula' => $item->TarikhMula,
            'TarikhAkhir' => $item->TarikhAkhir,
            'Status' => $item->Status,
            'Catatan' => $item->Catatan,
        ];
    })->toArray() : [];
    $lantikansData = is_array($oldLantikans) ? $oldLantikans : $existingLantikans;
@endphp

<div class="mx-auto max-w-6xl rounded-2xl border border-slate-200 bg-gradient-to-b from-white to-slate-50 p-5 shadow-sm md:p-7">
    <div class="mb-6 border-b border-slate-200 pb-4">
        <h2 class="text-xl font-semibold text-slate-800">Maklumat Pendakwah</h2>
        <p class="mt-1 text-sm text-slate-500">Lengkapkan maklumat penting di bawah dengan ringkas dan tersusun.</p>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <div>
            <label for="NamaIslam" class="{{ $labelClass }}">Nama Islam <span class="text-red-600">*</span></label>
            <input
                type="text"
                id="NamaIslam"
                name="NamaIslam"
                value="{{ old('NamaIslam', $pendakwah->NamaIslam ?? '') }}"
                required
                class="{{ $controlClass }}"
                placeholder="Masukkan nama Islam"
            >
            @error('NamaIslam')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="NamaAsal" class="{{ $labelClass }}">Nama Asal</label>
            <input
                type="text"
                id="NamaAsal"
                name="NamaAsal"
                value="{{ old('NamaAsal', $pendakwah->NamaAsal ?? '') }}"
                class="{{ $controlClass }}"
                placeholder="Masukkan nama asal"
            >
        </div>

        <div>
            <label for="NoKP" class="{{ $labelClass }}">No. Kad Pengenalan</label>
            <input
                type="text"
                id="NoKP"
                name="NoKP"
                value="{{ old('NoKP', $pendakwah->NoKP ?? '') }}"
                class="{{ $controlClass }}"
                placeholder="Cth: 123456-12-1234"
            >
        </div>

        <div>
            <label for="Jantina" class="{{ $labelClass }}">Jantina</label>
            <select id="Jantina" name="Jantina" class="{{ $controlClass }}">
                <option value="">-- Pilih Jantina --</option>
                @foreach(($jantinaOptions ?? collect()) as $option)
                    <option value="{{ $option->Code }}" {{ old('Jantina', $pendakwah->Jantina ?? '') === $option->Code ? 'selected' : '' }}>
                        {{ $option->Description }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="Bangsa" class="{{ $labelClass }}">Bangsa</label>
            <input
                type="text"
                id="Bangsa"
                name="Bangsa"
                value="{{ old('Bangsa', $pendakwah->Bangsa ?? '') }}"
                class="{{ $controlClass }}"
                placeholder="Cth: Melayu, Arab, Cina"
            >
        </div>

        <div>
            <label for="Kategori" class="{{ $labelClass }}">Kategori</label>
            <input
                type="text"
                id="Kategori"
                name="Kategori"
                value="{{ old('Kategori', $pendakwah->Kategori ?? '') }}"
                class="{{ $controlClass }}"
                placeholder="Cth: Sukarela / Tetap"
            >
        </div>

        <div>
            <label for="TarikhIslam" class="{{ $labelClass }}">Tarikh Memeluk Islam</label>
            <input
                type="date"
                id="TarikhIslam"
                name="TarikhIslam"
                value="{{ old('TarikhIslam', $pendakwah->TarikhIslam ?? '') }}"
                class="{{ $controlClass }}"
            >
        </div>

        <div>
            <label for="Daerah" class="{{ $labelClass }}">Daerah</label>
            <select id="Daerah" name="Daerah" class="{{ $controlClass }}">
                <option value="">-- Pilih Daerah --</option>
                @foreach(($daerahOptions ?? collect()) as $option)
                    <option value="{{ $option->Code }}" {{ old('Daerah', $pendakwah->Daerah ?? '') === $option->Code ? 'selected' : '' }}>
                        {{ $option->Description }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="NoTel1" class="{{ $labelClass }}">No. Telefon</label>
            <input
                type="text"
                id="NoTel1"
                name="NoTel1"
                value="{{ old('NoTel1', $pendakwah->NoTel1 ?? '') }}"
                class="{{ $controlClass }}"
                placeholder="Cth: 0123456789"
            >
        </div>

        <div>
            <label for="Status" class="{{ $labelClass }}">Status</label>
            <select id="Status" name="Status" class="{{ $controlClass }}">
                <option value="Y" {{ old('Status', $pendakwah->Status ?? 'Y') === 'Y' ? 'selected' : '' }}>Aktif</option>
                <option value="N" {{ old('Status', $pendakwah->Status ?? '') === 'N' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div>
    </div>

    <div class="mt-7 space-y-5 border-t border-slate-200 pt-6">
        <div class="rounded-xl border border-slate-200 bg-white/70 p-4 md:p-5">
            <p class="mb-4 text-sm font-semibold text-slate-700">Alamat</p>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="Alamat1" class="{{ $labelClass }}">Alamat 1</label>
                    <input type="text" id="Alamat1" name="Alamat1" value="{{ old('Alamat1', $pendakwah->Alamat1 ?? '') }}" class="{{ $controlClass }}" placeholder="Baris alamat pertama">
                </div>
                <div>
                    <label for="Alamat2" class="{{ $labelClass }}">Alamat 2</label>
                    <input type="text" id="Alamat2" name="Alamat2" value="{{ old('Alamat2', $pendakwah->Alamat2 ?? '') }}" class="{{ $controlClass }}" placeholder="Baris alamat kedua">
                </div>
                <div>
                    <label for="Alamat3" class="{{ $labelClass }}">Alamat 3</label>
                    <input type="text" id="Alamat3" name="Alamat3" value="{{ old('Alamat3', $pendakwah->Alamat3 ?? '') }}" class="{{ $controlClass }}" placeholder="Baris alamat ketiga">
                </div>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    <div>
                        <label for="Negeri" class="{{ $labelClass }}">Negeri</label>
                        <input type="text" id="Negeri" name="Negeri" value="{{ old('Negeri', $pendakwah->Negeri ?? '') }}" class="{{ $controlClass }}">
                    </div>
                    <div>
                        <label for="Bandar" class="{{ $labelClass }}">Bandar</label>
                        <input type="text" id="Bandar" name="Bandar" value="{{ old('Bandar', $pendakwah->Bandar ?? '') }}" class="{{ $controlClass }}">
                    </div>
                    <div>
                        <label for="Poskod" class="{{ $labelClass }}">Poskod</label>
                        <input type="text" id="Poskod" name="Poskod" value="{{ old('Poskod', $pendakwah->Poskod ?? '') }}" class="{{ $controlClass }}">
                    </div>
                </div>
                <div>
                    <label for="Catatan" class="{{ $labelClass }}">Catatan</label>
                    <textarea id="Catatan" name="Catatan" rows="3" class="{{ $controlClass }}" placeholder="Masukkan catatan tambahan">{{ old('Catatan', $pendakwah->Catatan ?? '') }}</textarea>
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white/70 p-4 md:p-5">
            <p class="mb-4 text-sm font-semibold text-slate-700">Maklumat Bank</p>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div>
                    <label for="KodBank" class="{{ $labelClass }}">Kod Bank</label>
                    <select id="KodBank" name="KodBank" class="{{ $controlClass }}">
                        <option value="">-- Pilih Bank --</option>
                        @foreach(($bankOptions ?? collect()) as $option)
                            <option value="{{ $option->Code }}" {{ old('KodBank', $pendakwah->KodBank ?? '') === $option->Code ? 'selected' : '' }}>
                                {{ $option->Description }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="NoAkaunBank" class="{{ $labelClass }}">No. Akaun Bank</label>
                    <input type="text" id="NoAkaunBank" name="NoAkaunBank" value="{{ old('NoAkaunBank', $pendakwah->NoAkaunBank ?? '') }}" class="{{ $controlClass }}" placeholder="Masukkan no. akaun">
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white/70 p-4 md:p-5">
            <div class="mb-3 flex flex-wrap items-center justify-between gap-3">
                <p class="text-sm font-semibold text-slate-700">Maklumat Lantikan</p>
                <button
                    type="button"
                    id="add-lantikan-btn"
                    class="rounded-lg bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200"
                >
                    + Tambah Lantikan
                </button>
            </div>

            <div id="lantikan-list" class="space-y-3"></div>

            <template id="lantikan-template">
                <div class="lantikan-row grid grid-cols-1 items-start gap-3 rounded-lg border border-slate-200 bg-white p-3 md:grid-cols-12 md:gap-4">
                    <div class="md:col-span-2">
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-600">Tahun</label>
                        <input type="number" min="1900" max="2100" data-name="Tahun" class="{{ $controlClass }}" placeholder="2026">
                    </div>

                    <div class="md:col-span-3">
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-600">Tarikh Mula</label>
                        <input type="date" data-name="TarikhMula" class="{{ $controlClass }}">
                    </div>

                    <div class="md:col-span-3">
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-600">Tarikh Akhir</label>
                        <input type="date" data-name="TarikhAkhir" class="{{ $controlClass }}">
                    </div>

                    <div class="md:col-span-2">
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-600">Status</label>
                        <select data-name="Status" class="{{ $controlClass }}">
                            <option value="Y">Aktif</option>
                            <option value="N">Tidak Aktif</option>
                        </select>
                    </div>

                    <div class="md:col-span-2 md:self-end md:pb-[22px]">
                        <button
                            type="button"
                            class="remove-lantikan-btn w-full rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-100"
                        >
                            Buang
                        </button>
                    </div>

                    <div class="md:col-span-12">
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-600">Catatan Lantikan</label>
                        <textarea rows="2" data-name="Catatan" class="{{ $controlClass }}" placeholder="Masukkan catatan lantikan"></textarea>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const list = document.getElementById('lantikan-list');
    const template = document.getElementById('lantikan-template');
    const addButton = document.getElementById('add-lantikan-btn');
    const initialData = @json($lantikansData ?? []);
    const alamat1 = document.getElementById('Alamat1');
    const alamat2 = document.getElementById('Alamat2');
    const alamat3 = document.getElementById('Alamat3');
    const negeriInput = document.getElementById('Negeri');
    const bandarInput = document.getElementById('Bandar');
    const poskodInput = document.getElementById('Poskod');

    const negeriList = [
        'Johor',
        'Kedah',
        'Kelantan',
        'Melaka',
        'Negeri Sembilan',
        'Pahang',
        'Perak',
        'Perlis',
        'Pulau Pinang',
        'Sabah',
        'Sarawak',
        'Selangor',
        'Terengganu',
        'Kuala Lumpur',
        'Labuan',
        'Putrajaya'
    ];

    const escapeRegex = (text) => text.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');

    const getAlamatGabung = () => {
        return [alamat1?.value, alamat2?.value, alamat3?.value]
            .filter(Boolean)
            .join(', ')
            .replace(/\s+/g, ' ')
            .trim();
    };

    const detectPoskod = (alamatText) => {
        const match = alamatText.match(/\b\d{5}\b/);
        return match ? match[0] : '';
    };

    const detectNegeri = (alamatText) => {
        const lower = alamatText.toLowerCase();
        for (const negeri of negeriList) {
            const pattern = new RegExp(`\\b${escapeRegex(negeri.toLowerCase())}\\b`, 'i');
            if (pattern.test(lower)) {
                return negeri;
            }
        }
        return '';
    };

    const cleanBandarText = (text) => {
        return text
            .replace(/\b\d{5}\b/g, '')
            .replace(/\s+/g, ' ')
            .replace(/^[-,\s]+|[-,\s]+$/g, '')
            .trim();
    };

    const detectBandar = (alamatText, poskod, negeri) => {
        const parts = alamatText
            .split(',')
            .map((item) => item.trim())
            .filter(Boolean);

        if (!parts.length) {
            return '';
        }

        if (poskod) {
            const partWithPoskodIndex = parts.findIndex((part) => part.includes(poskod));
            if (partWithPoskodIndex >= 0) {
                const cleaned = cleanBandarText(parts[partWithPoskodIndex]);
                if (cleaned && cleaned.toLowerCase() !== negeri.toLowerCase()) {
                    return cleaned;
                }
                if (partWithPoskodIndex > 0) {
                    return cleanBandarText(parts[partWithPoskodIndex - 1]);
                }
            }
        }

        if (negeri) {
            const negeriIndex = parts.findIndex((part) => {
                const pattern = new RegExp(`\\b${escapeRegex(negeri)}\\b`, 'i');
                return pattern.test(part);
            });
            if (negeriIndex > 0) {
                return cleanBandarText(parts[negeriIndex - 1]);
            }
        }

        return '';
    };

    const syncAlamatInfo = () => {
        if (!negeriInput || !bandarInput || !poskodInput) {
            return;
        }

        const alamatText = getAlamatGabung();
        if (!alamatText) {
            negeriInput.value = '';
            bandarInput.value = '';
            poskodInput.value = '';
            return;
        }

        const poskod = detectPoskod(alamatText);
        const negeri = detectNegeri(alamatText);
        const bandar = detectBandar(alamatText, poskod, negeri);

        negeriInput.value = negeri;
        bandarInput.value = bandar;
        poskodInput.value = poskod;
    };

    if (!list || !template || !addButton) {
        if (alamat1 || alamat2 || alamat3) {
            [alamat1, alamat2, alamat3].forEach((input) => {
                input?.addEventListener('input', syncAlamatInfo);
                input?.addEventListener('change', syncAlamatInfo);
            });
            syncAlamatInfo();
        }
        return;
    }

    const updateIndexes = () => {
        const rows = Array.from(list.querySelectorAll('.lantikan-row'));

        rows.forEach((row, index) => {
            row.querySelectorAll('[data-name]').forEach((input) => {
                const key = input.getAttribute('data-name');
                input.name = `lantikans[${index}][${key}]`;
                input.id = `lantikans_${index}_${key}`;
            });
        });
    };

    const bindRow = (row) => {
        const removeButton = row.querySelector('.remove-lantikan-btn');
        if (removeButton) {
            removeButton.addEventListener('click', () => {
                row.remove();
                updateIndexes();
            });
        }
    };

    const addRow = (value = {}) => {
        const node = template.content.firstElementChild.cloneNode(true);

        node.querySelectorAll('[data-name]').forEach((input) => {
            const key = input.getAttribute('data-name');
            input.value = value[key] ?? '';
        });

        bindRow(node);
        list.appendChild(node);
        updateIndexes();
    };

    if (Array.isArray(initialData) && initialData.length > 0) {
        initialData.forEach((item) => addRow(item || {}));
    } else {
        addRow({ Status: 'Y' });
    }

    addButton.addEventListener('click', () => addRow({ Status: 'Y' }));

    [alamat1, alamat2, alamat3].forEach((input) => {
        input?.addEventListener('input', syncAlamatInfo);
        input?.addEventListener('change', syncAlamatInfo);
    });

    syncAlamatInfo();
});
</script>
