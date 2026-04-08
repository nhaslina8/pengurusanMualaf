<input
    type="hidden"
    name="IdPenggunaMain"
    value="{{ old('IdPenggunaMain', $muallaf->IdPenggunaMain ?? 0) }}"
>

@php
    $labelClass = 'mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-600';
    $controlClass = 'w-full rounded-lg border border-slate-300 bg-white px-3.5 py-2.5 text-sm text-slate-800 shadow-sm transition duration-150 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100';
@endphp

<div class="mx-auto max-w-6xl rounded-2xl border border-slate-200 bg-gradient-to-b from-white to-slate-50 p-5 shadow-sm md:p-7">
    <div class="mb-6 border-b border-slate-200 pb-4">
        <h2 class="text-xl font-semibold text-slate-800">Maklumat Muallaf</h2>
        <p class="mt-1 text-sm text-slate-500">Lengkapkan maklumat penting di bawah dengan ringkas dan tersusun.</p>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <div>
            <label for="BilDaftar" class="{{ $labelClass }}">Bil Daftar</label>
            <input
                type="text"
                id="BilDaftar"
                name="BilDaftar"
                value="{{ old('BilDaftar', $muallaf->BilDaftar ?? '') }}"
                class="{{ $controlClass }}"
                placeholder="Masukkan bil daftar"
            >
        </div>

        <div>
            <label for="NamaIslam" class="{{ $labelClass }}">Nama Islam <span class="text-red-600">*</span></label>
            <input
                type="text"
                id="NamaIslam"
                name="NamaIslam"
                value="{{ old('NamaIslam', $muallaf->NamaIslam ?? '') }}"
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
                value="{{ old('NamaAsal', $muallaf->NamaAsal ?? '') }}"
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
                value="{{ old('NoKP', $muallaf->NoKP ?? '') }}"
                class="{{ $controlClass }}"
                placeholder="Cth: 123456-12-1234"
            >
        </div>

        <div>
            <label for="Jantina" class="{{ $labelClass }}">Jantina</label>
            <select id="Jantina" name="Jantina" class="{{ $controlClass }}">
                <option value="">-- Pilih Jantina --</option>
                @foreach(($jantinaOptions ?? collect()) as $option)
                    <option value="{{ $option->Code }}" {{ old('Jantina', $muallaf->Jantina ?? '') === $option->Code ? 'selected' : '' }}>
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
                value="{{ old('Bangsa', $muallaf->Bangsa ?? '') }}"
                class="{{ $controlClass }}"
                placeholder="Cth: Melayu, Arab, China"
            >
        </div>

        <div>
            <label for="TarikhIslam" class="{{ $labelClass }}">Tarikh Memeluk Islam</label>
            <input
                type="date"
                id="TarikhIslam"
                name="TarikhIslam"
                value="{{ old('TarikhIslam', $muallaf->TarikhIslam ?? '') }}"
                class="{{ $controlClass }}"
            >
        </div>

        <div>
            <label for="Daerah" class="{{ $labelClass }}">Daerah Masuk Islam</label>
            <select id="Daerah" name="Daerah" class="{{ $controlClass }}">
                <option value="">-- Pilih Daerah --</option>
                @foreach(($daerahOptions ?? collect()) as $option)
                    <option value="{{ $option->Code }}" {{ old('Daerah', $muallaf->Daerah ?? '') === $option->Code ? 'selected' : '' }}>
                        {{ $option->Description }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="md:col-span-2 grid grid-cols-1 gap-4 md:grid-cols-3">
            <div>
                <label for="KategoriMuallaf" class="{{ $labelClass }}">Kategori Muallaf</label>
                <select id="KategoriMuallaf" name="KategoriMuallaf" class="{{ $controlClass }}">
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Malaysia" {{ old('KategoriMuallaf', $muallaf->KategoriMuallaf ?? '') === 'Malaysia' ? 'selected' : '' }}>Malaysia</option>
                    <option value="Sabah" {{ old('KategoriMuallaf', $muallaf->KategoriMuallaf ?? '') === 'Sabah' ? 'selected' : '' }}>Sabah</option>
                    <option value="Sarawak" {{ old('KategoriMuallaf', $muallaf->KategoriMuallaf ?? '') === 'Sarawak' ? 'selected' : '' }}>Sarawak</option>
                    <option value="Orang Asli" {{ old('KategoriMuallaf', $muallaf->KategoriMuallaf ?? '') === 'Orang Asli' ? 'selected' : '' }}>Orang Asli</option>
                    <option value="Bukan Warganegara" {{ old('KategoriMuallaf', $muallaf->KategoriMuallaf ?? '') === 'Bukan Warganegara' ? 'selected' : '' }}>Bukan Warganegara</option>
                </select>
            </div>

            <div>
                <label for="NoTel1" class="{{ $labelClass }}">No. Telefon</label>
                <input
                    type="text"
                    id="NoTel1"
                    name="NoTel1"
                    value="{{ old('NoTel1', $muallaf->NoTel1 ?? '') }}"
                    class="{{ $controlClass }}"
                    placeholder="Cth: 0123456789"
                >
            </div>

            <div>
                <label for="Pendakwah" class="{{ $labelClass }}">Pendakwah</label>
                <input
                    type="text"
                    id="Pendakwah"
                    name="Pendakwah"
                    value="{{ old('Pendakwah', $muallaf->Pendakwah ?? '') }}"
                    class="{{ $controlClass }}"
                    placeholder="Masukkan nama pendakwah"
                >
            </div>
        </div>

        <!-- <div>
            <label for="Status" class="{{ $labelClass }}">Status</label>
            <select id="Status" name="Status" class="{{ $controlClass }}">
                <option value="">-- Pilih Status --</option>
                <option value="A" {{ old('Status', $muallaf->Status ?? '') === 'A' ? 'selected' : '' }}>Aktif</option>
                <option value="I" {{ old('Status', $muallaf->Status ?? '') === 'I' ? 'selected' : '' }}>Tidak Aktif</option>
            </select>
        </div> -->
    </div>

    <div class="mt-7 space-y-5 border-t border-slate-200 pt-6">
        <div class="rounded-xl border border-slate-200 bg-white/70 p-4 md:p-5">
            <p class="mb-4 text-sm font-semibold text-slate-700">Alamat</p>

            <div class="grid grid-cols-1 gap-4">
                <div>
                    <label for="Alamat1" class="{{ $labelClass }}">Alamat 1</label>
                    <input
                        type="text"
                        id="Alamat1"
                        name="Alamat1"
                        value="{{ old('Alamat1', $muallaf->Alamat1 ?? '') }}"
                        class="{{ $controlClass }}"
                        placeholder="Baris alamat pertama"
                    >
                </div>

                <div>
                    <label for="Alamat2" class="{{ $labelClass }}">Alamat 2</label>
                    <input
                        type="text"
                        id="Alamat2"
                        name="Alamat2"
                        value="{{ old('Alamat2', $muallaf->Alamat2 ?? '') }}"
                        class="{{ $controlClass }}"
                        placeholder="Baris alamat kedua"
                    >
                </div>

                <div>
                    <label for="Alamat3" class="{{ $labelClass }}">Alamat 3</label>
                    <input
                        type="text"
                        id="Alamat3"
                        name="Alamat3"
                        value="{{ old('Alamat3', $muallaf->Alamat3 ?? '') }}"
                        class="{{ $controlClass }}"
                        placeholder="Baris alamat ketiga (opsional)"
                    >
                </div>

                <div>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        <div>
                            <label for="Negeri" class="{{ $labelClass }}">Negeri</label>
                            <input
                                type="text"
                                id="Negeri"
                                name="Negeri"
                                value="{{ old('Negeri', $muallaf->Negeri ?? '') }}"
                                class="{{ $controlClass }} bg-slate-100 text-slate-600"
                                readonly
                            >
                        </div>

                        <div>
                            <label for="Bandar" class="{{ $labelClass }}">Bandar/Kota</label>
                            <input
                                type="text"
                                id="Bandar"
                                name="Bandar"
                                value="{{ old('Bandar', $muallaf->Bandar ?? '') }}"
                                class="{{ $controlClass }} bg-slate-100 text-slate-600"
                                readonly
                            >
                        </div>

                        <div>
                            <label for="Poskod" class="{{ $labelClass }}">Poskod</label>
                            <input
                                type="text"
                                id="Poskod"
                                name="Poskod"
                                value="{{ old('Poskod', $muallaf->Poskod ?? '') }}"
                                class="{{ $controlClass }} bg-slate-100 text-slate-600"
                                readonly
                            >
                        </div>
                    </div>
                </div>

                <div>
                    <label for="Catatan" class="{{ $labelClass }}">Catatan</label>
                    <textarea
                        id="Catatan"
                        name="Catatan"
                        rows="3"
                        class="{{ $controlClass }}"
                        placeholder="Masukkan catatan tambahan"
                    >{{ old('Catatan', $muallaf->Catatan ?? '') }}</textarea>
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
                            <option value="{{ $option->Code }}" {{ old('KodBank', $muallaf->KodBank ?? '') === $option->Code ? 'selected' : '' }}>
                                {{ $option->Description }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="NoAkaunBank" class="{{ $labelClass }}">No. Akaun Bank</label>
                    <input
                        type="text"
                        id="NoAkaunBank"
                        name="NoAkaunBank"
                        value="{{ old('NoAkaunBank', $muallaf->NoAkaunBank ?? '') }}"
                        class="{{ $controlClass }}"
                        placeholder="Masukkan no. akaun"
                    >
                </div>
            </div>
        </div>

        <div class="rounded-xl border border-slate-200 bg-white/70 p-4 md:p-5">
            <div class="mb-3 flex flex-wrap items-center justify-between gap-3">
                <p class="text-sm font-semibold text-slate-700">Lampiran</p>
                <button
                    type="button"
                    id="add-lampiran-btn"
                    class="rounded-lg bg-blue-600 px-3 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-200"
                >
                    + Tambah Lampiran
                </button>
            </div>

            <div id="lampiran-list" class="space-y-3"></div>

            <template id="lampiran-template">
                <div class="lampiran-row grid grid-cols-1 items-start gap-3 rounded-lg border border-slate-200 bg-white p-3 md:grid-cols-12 md:gap-4">
                    <div class="md:col-span-5">
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-600">Jenis Lampiran</label>
                        <select name="attachment_type2[]" class="{{ $controlClass }}">
                            <option value="">-- Pilih Jenis Lampiran --</option>
                            <option value="NOKP">Lampiran NoKP</option>
                            <option value="KAD_ISLAM">Lampiran Kad Islam</option>
                            <option value="AKAUN_BANK">Lampiran Akaun Bank</option>
                            <option value="SURAT_BERMAUSTATIN">Lampiran Surat Bermaustatin</option>
                        </select>
                    </div>

                    <div class="md:col-span-5">
                        <label class="mb-1.5 block text-xs font-semibold uppercase tracking-wide text-slate-600">Fail</label>
                        <input
                            type="file"
                            name="attachment_files[]"
                            class="{{ $controlClass }} file:mr-3 file:rounded-md file:border-0 file:bg-slate-100 file:px-2.5 file:py-1.5 file:text-xs file:font-semibold file:text-slate-700 hover:file:bg-slate-200"
                            accept=".pdf,.jpg,.jpeg,.png"
                        >
                        <p class="mt-1 text-xs text-slate-500">Format: PDF/JPG/PNG, max 5MB</p>
                    </div>

                    <div class="md:col-span-2 md:self-end md:pb-[22px]">
                        <button
                            type="button"
                            class="remove-lampiran-btn w-full rounded-lg bg-red-600 px-3 py-2 text-sm font-semibold text-white transition hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-100"
                        >
                            Buang
                        </button>
                    </div>

                    <p class="lampiran-feedback hidden text-sm font-medium text-red-600 md:col-span-12"></p>
                </div>
            </template>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const list = document.getElementById('lampiran-list');
    const template = document.getElementById('lampiran-template');
    const addButton = document.getElementById('add-lampiran-btn');
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

    const getLampiranRows = () => {
        if (!list) {
            return [];
        }
        return Array.from(list.querySelectorAll('.lampiran-row'));
    };

    const showLampiranFeedback = (row, message) => {
        const feedback = row?.querySelector('.lampiran-feedback');
        if (!feedback) {
            if (message) {
                window.alert(message);
            }
            return;
        }

        if (!message) {
            feedback.textContent = '';
            feedback.classList.add('hidden');
            return;
        }

        feedback.textContent = message;
        feedback.classList.remove('hidden');
    };

    const getFileSignature = (file) => {
        if (!file) {
            return '';
        }
        return `${file.name}__${file.size}__${file.lastModified}`;
    };

    const refreshLampiranTypeOptions = () => {
        const rows = getLampiranRows();
        const selectedValues = rows
            .map((row) => row.querySelector('select[name="attachment_type2[]"]')?.value || '')
            .filter(Boolean);

        rows.forEach((row) => {
            const select = row.querySelector('select[name="attachment_type2[]"]');
            if (!select) {
                return;
            }

            Array.from(select.options).forEach((option) => {
                if (!option.value) {
                    option.disabled = false;
                    return;
                }

                const selectedElsewhere = selectedValues.includes(option.value) && select.value !== option.value;
                option.disabled = selectedElsewhere;
            });
        });
    };

    const validateDuplicateTypeForRow = (currentRow) => {
        const currentSelect = currentRow?.querySelector('select[name="attachment_type2[]"]');
        const currentValue = currentSelect?.value || '';
        if (!currentSelect || !currentValue) {
            showLampiranFeedback(currentRow, '');
            return true;
        }

        const duplicated = getLampiranRows().some((row) => {
            if (row === currentRow) {
                return false;
            }
            const select = row.querySelector('select[name="attachment_type2[]"]');
            return select?.value === currentValue;
        });

        if (duplicated) {
            currentSelect.value = '';
            showLampiranFeedback(currentRow, 'Jenis lampiran ini sudah dipilih pada row lain. Sila pilih jenis yang berbeza.');
            return false;
        }

        showLampiranFeedback(currentRow, '');
        return true;
    };

    const validateDuplicateFileForRow = (currentRow) => {
        const currentInput = currentRow?.querySelector('input[name="attachment_files[]"]');
        const currentFile = currentInput?.files?.[0];
        if (!currentInput || !currentFile) {
            showLampiranFeedback(currentRow, '');
            return true;
        }

        const currentSignature = getFileSignature(currentFile);
        const duplicated = getLampiranRows().some((row) => {
            if (row === currentRow) {
                return false;
            }

            const fileInput = row.querySelector('input[name="attachment_files[]"]');
            const file = fileInput?.files?.[0];
            return file && getFileSignature(file) === currentSignature;
        });

        if (duplicated) {
            currentInput.value = '';
            showLampiranFeedback(currentRow, 'Fail yang sama sudah dipilih pada row lain. Sila pilih fail yang berbeza.');
            return false;
        }

        showLampiranFeedback(currentRow, '');
        return true;
    };

    const validateAllLampiranRows = () => {
        const rows = getLampiranRows();
        const typeSet = new Set();
        const fileSet = new Set();
        let isValid = true;

        rows.forEach((row) => {
            showLampiranFeedback(row, '');
        });

        rows.forEach((row) => {
            const select = row.querySelector('select[name="attachment_type2[]"]');
            const typeValue = select?.value || '';
            if (typeValue) {
                if (typeSet.has(typeValue)) {
                    showLampiranFeedback(row, 'Jenis lampiran tidak boleh berulang.');
                    isValid = false;
                } else {
                    typeSet.add(typeValue);
                }
            }

            const fileInput = row.querySelector('input[name="attachment_files[]"]');
            const file = fileInput?.files?.[0];
            const signature = getFileSignature(file);
            if (signature) {
                if (fileSet.has(signature)) {
                    showLampiranFeedback(row, 'Fail yang dipilih telah digunakan pada row lain.');
                    isValid = false;
                } else {
                    fileSet.add(signature);
                }
            }
        });

        refreshLampiranTypeOptions();
        return isValid;
    };

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

    const addLampiranRow = () => {
        const clone = template.content.cloneNode(true);
        list.appendChild(clone);
        refreshLampiranTypeOptions();
    };

    addButton.addEventListener('click', addLampiranRow);

    list.addEventListener('change', function (event) {
        const target = event.target;
        const row = target.closest('.lampiran-row');
        if (!row) {
            return;
        }

        if (target.matches('select[name="attachment_type2[]"]')) {
            const validType = validateDuplicateTypeForRow(row);
            if (!validType) {
                window.alert('Jenis lampiran ini telah dipilih. Sila pilih jenis lampiran yang lain.');
            }
            refreshLampiranTypeOptions();
            return;
        }

        if (target.matches('input[name="attachment_files[]"]')) {
            const validFile = validateDuplicateFileForRow(row);
            if (!validFile) {
                window.alert('Fail yang sama tidak dibenarkan untuk lebih dari satu lampiran.');
            }
        }
    });

    list.addEventListener('click', function (event) {
        const target = event.target;
        if (!target.classList.contains('remove-lampiran-btn')) {
            return;
        }

        const row = target.closest('.lampiran-row');
        if (row) {
            row.remove();
            refreshLampiranTypeOptions();
        }
    });

    [alamat1, alamat2, alamat3].forEach((input) => {
        input?.addEventListener('input', syncAlamatInfo);
        input?.addEventListener('change', syncAlamatInfo);
    });

    const parentForm = list.closest('form');
    if (parentForm) {
        parentForm.addEventListener('submit', function (event) {
            if (!validateAllLampiranRows()) {
                event.preventDefault();
                window.alert('Terdapat duplikasi pada lampiran. Sila semak semula jenis lampiran dan fail.');
            }
        });
    }

    syncAlamatInfo();
});
</script>
