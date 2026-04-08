# Pengurusan Muallaf

Sistem Laravel untuk pengurusan rekod muallaf dengan pendekatan hybrid:

- Web route + Blade untuk paparan UI
- API route untuk operasi data (create, update, delete)

Dokumen ini bertujuan beri gambaran penuh architecture supaya developer baru boleh terus faham aliran projek.

## 1) Ringkasan Architecture

### Komponen utama

- Frontend UI: Blade (`resources/views/muallafs/*`)
- Web controller: `app/Http/Controllers/MuallafController.php`
- API controller: `app/Http/Controllers/Api/MuallafController.php`
- Model utama: `app/Models/Muallaf.php`
- Model rujukan kod: `app/Models/Mastercode.php`
- Model lampiran: `app/Models/UploadFileMuallaf.php`
- Service upload fail: `app/Services/SynologyFileService.php`

### Konsep hybrid Web + API

- User buka page melalui route web (`/muallafs`, `/muallafs/create`, dll).
- Bila submit form (create/edit/delete), JavaScript akan intercept dan call endpoint API (`/api/muallafs...`).
- API controller yang urus validasi, transaksi DB, dan response JSON.

## 2) Aliran Request End-to-End

### A. Listing / paparan page

1. Browser buka `/muallafs`.
2. `routes/web.php` hantar ke `MuallafController@index`.
3. Controller query data dan return `view('muallafs.index')`.

### B. Create Muallaf

1. User buka `/muallafs/create`.
2. Web controller return `muallafs.create` + option mastercode.
3. User klik Simpan.
4. Script `public/js/api-handler.js` intercept submit form.
5. Script hantar `POST /api/muallafs` (multipart/form-data).
6. API controller validate + simpan data + simpan lampiran.
7. API pulangkan JSON success, frontend redirect ke `/muallafs`.

### C. Update Muallaf

1. User buka `/muallafs/{id}/edit`.
2. Submit form di-intercept oleh `api-handler.js`.
3. Script hantar `POST /api/muallafs/{id}` + `_method=PUT`.
4. API controller update rekod + lampiran.

### D. Delete Muallaf

1. User klik Padam di page list/show.
2. Form delete di-intercept oleh `api-handler.js`.
3. Script hantar `DELETE /api/muallafs/{id}`.
4. API controller padam rekod dan return JSON.

## 3) Route Mapping

### Web routes (`routes/web.php`)

- `Route::resource('muallafs', MuallafController::class)`
- Digunakan untuk page rendering (index/create/show/edit).

Nota penting:

- Method `store`, `update`, `destroy` dalam web controller sengaja `abort(405)`.
- Operasi write dipaksa melalui API controller.

### API routes (`routes/api.php`)

- `Route::apiResource('muallafs', Api\MuallafController::class)->names('api.muallafs')`
- Endpoint utama:
	- `GET /api/muallafs`
	- `POST /api/muallafs`
	- `GET /api/muallafs/{id}`
	- `PUT/PATCH /api/muallafs/{id}`
	- `DELETE /api/muallafs/{id}`

## 4) Struktur Folder Penting

```text
app/
	Http/
		Controllers/
			MuallafController.php            # web rendering
			Api/
				MuallafController.php          # API CRUD + validation + transaction
	Models/
		Muallaf.php
		Mastercode.php
		UploadFileMuallaf.php
	Services/
		SynologyFileService.php            # upload lampiran

resources/
	views/
		components/
			app-layout.blade.php             # layout + load api-handler.js
		muallafs/
			index.blade.php
			create.blade.php
			edit.blade.php
			form.blade.php
			show.blade.php
	js/
		app.js
		api-handler.js                     # source JS versi Vite (opsyen)

public/
	js/
		api-handler.js                     # script yang sedang digunakan oleh layout

routes/
	web.php
	api.php
```

## 5) View Muallafs Yang Digunakan

Semua fail dalam `resources/views/muallafs/` berikut digunakan:

- `index.blade.php`
- `create.blade.php`
- `edit.blade.php`
- `show.blade.php`
- `form.blade.php` (partial yang di-include oleh create/edit)

## 6) DB dan UAT Notes

- UAT guna nama table legacy PascalCase (contoh: `MaklumatMuallaf`, `AkaunPenggunaMain`).
- UAT tiada table migration Laravel (`migrations`) secara default.
- Elakkan run `php artisan migrate` terus pada UAT tanpa strategi migration khas.
- Untuk UAT, disyorkan guna:
	- `CACHE_STORE=file`
	- `SESSION_DRIVER=file`

## 7) Setup Ringkas (Local)

```powershell
composer install
npm install
Copy-Item .env.example .env -Force
php artisan key:generate
php artisan config:clear
```

Jalankan server:

```powershell
php artisan serve
```

Jika guna Vite dev mode:

```powershell
npm run dev
```

## 8) Environment Switching (Local vs UAT)

Project ini ada template environment:

- `.env.local.example` untuk local MySQL
- `.env.uat.example` untuk UAT SQL Server

Contoh tukar environment:

```powershell
# Guna local
Copy-Item .env.local.example .env -Force
php artisan config:clear

# Guna UAT
Copy-Item .env.uat.example .env -Force
php artisan config:clear
```

Untuk UAT, pastikan `DB_PASSWORD` diisi dengan credential sebenar.

## 9) Nota Untuk Developer Baru

- Jangan keliru antara web controller dan API controller.
- UI masih Blade, tetapi write operation pergi ke API.
- Jika ubah behavior submit form, semak `public/js/api-handler.js` dahulu.
- Jika ubah validation/business rule write, semak `app/Http/Controllers/Api/MuallafController.php`.

## 10) Cadangan Penambahbaikan (Technical Debt)

- Sekarang ada `api-handler.js` di `resources/js` dan `public/js`.
- Script yang diload oleh layout ialah versi `public/js/api-handler.js`.
- Disyorkan standardize ke satu sumber sahaja (prefer Vite `resources/js/api-handler.js`) untuk elak divergence code.
