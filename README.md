# DonasiKita – Platform Donasi Sosial

Laravel + Blade app untuk kampanye dan donasi online dengan integrasi Midtrans dan dukungan PWA.

## Fitur Utama
- Kampanye publik: daftar kampanye, detail kampanye, progress bar, gambar.
- Donasi: multi-step form, pilihan nominal, catatan, pembayaran via Midtrans Snap (sandbox).
- Realtime polling: total donasi & daftar donatur per kampanye.
- Admin panel: kelola kampanye, donasi, donatur (akses terbatas admin).
- PWA: installable, offline fallback (`offline.html`), manifest + service worker + maskable icons.
- Responsif: navbar dengan hamburger menu di mobile, carousel kampanye.

## Teknologi
- Backend: Laravel (PHP), Midtrans PHP SDK, MySQL/MariaDB.
- Frontend: Blade templates, vanilla JS, custom CSS (tanpa Bootstrap/Tailwind).
- PWA: `manifest.json`, `sw.js`, offline cache, icons.
- Tooling: Composer, Artisan, NPM/Vite build (opsional untuk asset).

## Prasyarat
- PHP 8.2+
- Composer
- MySQL/MariaDB
- Node.js (jika ingin rebuild asset)

## Cara Menjalankan (Lokal)
1) Clone repo
```bash
git clone <url-repo>
cd DonasiKita
composer install
```
2) Salin `.env` contoh lalu isi kredensial
```bash
cp .env.example .env
```
Isi `DB_*` dan kunci Midtrans sandbox Anda sendiri. Jangan commit `.env`.

Contoh `.env` minimal (isi dengan nilai Anda):
```env
APP_NAME=DonasiKita
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=donasikita
DB_USERNAME=root
DB_PASSWORD=

MIDTRANS_SERVER_KEY=
MIDTRANS_CLIENT_KEY=
MIDTRANS_IS_PRODUCTION=false
```

3) Generate key & migrasi + seeder
```bash
php artisan key:generate
php artisan migrate --seed
```

4) Jalankan server
```bash
php artisan serve
```

## Route Utama
- `/` landing + kampanye terbaru
- `/kampanye` daftar kampanye
- `/campaign/{id}` detail kampanye
- `/campaign/{id}/donate` form donasi
- `/admin/*` area admin (login dibutuhkan)
- API realtime: `/api/campaigns-realtime`, `/api/campaigns/{id}/realtime`, `/api/payments/check-status`, `/api/payments/verify`, `/api/payments/refresh-status`

## Akun Admin
Seeder membuat user admin default (cek `database/seeders/DatabaseSeeder.php`). Jika lupa password, reset via artisan tinker atau ganti langsung di database (hash bcrypt).

## PWA
- Manifest: `public/manifest.json`
- Service Worker: `public/sw.js`
- Offline fallback: `public/offline.html`
- Icons: `public/images/icon-192x192.png`, `icon-512x512.png` (maskable)

## Build Asset (opsional)
Jika perlu rebuild asset frontend:
```bash
npm install
npm run build   # atau npm run dev
```

## Keamanan & Hal yang Jangan Dicommit
- Jangan commit `.env`, kredensial DB, atau kunci Midtrans.
- Abaikan `vendor/`, `node_modules/`, `storage/`, `bootstrap/cache/`.

## Lisensi
MIT License – Bebas gunakan dan modifikasi.
