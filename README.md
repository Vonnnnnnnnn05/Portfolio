# Von Esson Vergara — Laravel Portfolio

Personal portfolio built with Laravel 12, Blade, CSS, and vanilla JavaScript. It preserves the project galleries, resume download, theme switcher, Groq assistant, and installable offline portfolio. PHP 8.2+ and Composer are required. No Node build, database, or queue worker is needed.

## Run locally

From the project directory:

```powershell
composer install
Copy-Item .env.example .env   # Only on a fresh clone; keep an existing .env
php artisan key:generate     # Only on first setup
php artisan serve
```

Open **http://localhost:8000**. Set `GROQ_API_KEY` in `.env` to enable chat; `GROQ_MODEL` defaults to `openai/gpt-oss-20b`. For this migrated workspace, dependencies, the application key, and the existing local Groq configuration have already been set up.

Sessions, cache/rate limits, and logs use `storage/`. Chat failures appear in `storage/logs/laravel.log`. Missing credentials show a friendly configuration message; provider failures show a generic error without exposing credentials or provider internals. The old `api/config.php` is no longer loaded.

After changing configuration on a cached installation, run `php artisan config:clear` locally or `php artisan config:cache` in production.

## XAMPP

The preferred Apache virtual host has `DocumentRoot "C:/xampp/htdocs/Portfolio/public"`, with `AllowOverride All` and `Require all granted` for that directory. Enable `mod_rewrite`. Set `APP_URL` to the host you use.

The default XAMPP layout also supports **http://localhost/Portfolio/public/**; visiting `/Portfolio/` redirects there. Set `APP_URL=http://localhost/Portfolio/public` for this layout. Root `.htaccess` blocks direct access to application files. Always use `public/` as the document root on production servers.

Keep routes uncached when using XAMPP's subdirectory URL (`php artisan optimize:clear`). The installed framework's cached router does not correctly match that subdirectory's home page. The production cache commands below target a domain whose document root is `public/`.

## Project structure

- `resources/views/portfolio.blade.php`: page content and generated asset/API URLs.
- `public/`: CSS, JavaScript, images, galleries, resume, manifest, and service worker.
- `routes/web.php`: portfolio and legacy `/index.html` redirect.
- `routes/api.php`: `POST /api/chat` and compatible `POST /api/chat.php`.
- `app/Http/Controllers/ChatController.php`: validation, origin checking, Groq requests, and JSON responses.
- `resources/prompts/portfolio.txt`: assistant knowledge and instructions.
- `config/services.php`: Groq environment settings.
- `tests/Feature/`: portfolio and chat regression tests; HTTP provider calls are faked.

Chat accepts JSON `{"message":"What does Von build?"}` and returns `{"reply":"..."}` or `{"error":"..."}`. Messages are limited to 1,000 UTF-8 bytes. Both URLs share a limit of 20 requests per minute per IP. These are stateless API routes, with origin checks and no session authentication.

## Verify

```bash
composer test
php vendor/bin/pint --test
php artisan route:list
```

For offline testing, load the site online once, wait for the service worker to activate, and reload offline. The worker caches the portfolio and visited local assets; chat requires internet access. HTTPS is required for installation/service workers except on localhost. External fonts and icons may be unavailable offline. The worker and manifest support both a domain root and the XAMPP subdirectory.

## Deploy to the existing Azure VM / Nginx

Install PHP 8.2+ with Laravel's required extensions, Composer, Nginx, and PHP-FPM. Clone the repository to `/var/www/app/Portfolio`, then:

```bash
composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader
cp .env.example .env   # First setup only
php artisan key:generate
```

Edit `.env`: set `APP_ENV=production`, `APP_DEBUG=false`, `APP_URL=https://your-domain.example`, and `GROQ_API_KEY`. Preserve this file and its `APP_KEY` across deployments. Ensure the PHP-FPM user and deployment user can write to `storage/` and `bootstrap/cache/`.

Replace the old static-site Nginx configuration with a Laravel document root:

```nginx
server {
    listen 80;
    server_name your-domain.example;
    root /var/www/app/Portfolio/public;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    # Route legacy chat clients through Laravel as well.
    location = /api/chat.php {
        rewrite ^ /index.php last;
    }

    location = /index.php {
        include fastcgi_params;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root/index.php;
        fastcgi_param DOCUMENT_ROOT $realpath_root;
        fastcgi_read_timeout 60s;
    }

    location ~ \.php$ { return 404; }
    location ~ /\.(?!well-known).* { deny all; }
}
```

Match the PHP-FPM socket to the server's PHP version, validate with `sudo nginx -t`, reload Nginx, and configure HTTPS (for example with Certbot).

```bash
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

The existing GitHub deployment workflow now runs tests before pulling code on the VM, installing production dependencies, and rebuilding Laravel caches. Configure the server's `.env`, document root, PHP version, and writable directories before pushing the migration to `main`. No database migration is required for portfolio features. Nothing has been deployed by the local conversion.

Laravel reference: [deployment documentation](https://laravel.com/docs/12.x/deployment).

## Contact

- Email: von.vergara.399@gmail.com
- GitHub: https://github.com/Vonnnnnnnnn05
