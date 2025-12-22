# Setup DonasiKita di Alwaysdata (Gratis, No CC)

## Step 1: Daftar di Alwaysdata
1. Buka https://www.alwaysdata.com
2. Klik "Sign up" / "Register"
3. Isi email, password, nama (tidak perlu kartu kredit)
4. Verifikasi email
5. Login ke dashboard

## Step 2: Setup Account
1. Di dashboard, buat "Site" baru:
   - Name: `donasikita`
   - Type: PHP
   - Target directory: `/www` (default)
2. Ambil SSH credentials dari dashboard (User & Host)

## Step 3: SSH ke Server
```bash
ssh username@alwaysdata.com
# atau
ssh -p PORT username@HOST
# (lihat credentials di dashboard)
```

## Step 4: Clone & Setup Repo
```bash
cd ~/www
git clone https://github.com/Rakel8/DonasiKita.git
cd DonasiKita
composer install --no-dev --optimize-autoloader
php artisan key:generate
touch database/database.sqlite
php artisan migrate
chmod -R 775 storage bootstrap/cache database
```

## Step 5: Buat `.htaccess` di Root
```bash
cat > .htaccess << 'EOF'
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ public/$1 [L]
</IfModule>
EOF
```

## Step 6: Set Environment Variables
Edit `.env` di server:
```bash
nano .env
```

Ubah/tambah:
```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://donasikita.alwaysdata.net
APP_KEY=base64:xxxxx  # hasil php artisan key:generate --show
DB_CONNECTION=sqlite
DB_DATABASE=/home/username/www/DonasiKita/database/database.sqlite
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database
# Ganti dengan kredensial kamu dari dashboard Midtrans (JANGAN commit ke Git)
MIDTRANS_SERVER_KEY=<your_midtrans_server_key>
MIDTRANS_CLIENT_KEY=<your_midtrans_client_key>
MIDTRANS_IS_PRODUCTION=false
LOG_LEVEL=info
```

## Step 7: Test
1. Di dashboard Alwaysdata, lihat URL site (biasanya https://username.alwaysdata.net atau custom domain)
2. Akses URL tersebut di browser
3. Harus muncul homepage Laravel

## Troubleshooting
- **500 error**: Cek `storage/logs/laravel.log` di server
- **Permission denied**: Jalankan `chmod -R 775 storage bootstrap/cache`
- **Database error**: Pastikan path `DB_DATABASE` di `.env` benar

Done!
