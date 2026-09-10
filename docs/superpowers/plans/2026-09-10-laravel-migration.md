# Laravel migration

Goal: convert the existing portfolio into a Laravel application while preserving its content, styling, interactions, resume, and offline behavior.

Architecture: Laravel 12 on the installed PHP 8.2, a Blade portfolio view, public static assets, and a stateless JSON chat controller using Laravel's HTTP client. No database or frontend build is required. Keep both chat URLs for older clients; configure Groq through the environment and log failures through Laravel.

- [x] Install the Laravel skeleton and dependencies in the existing workspace.
- [x] Add feature tests for portfolio rendering/assets and chat success, validation, origin checks, missing credentials, provider failures, and throttling. Run before implementing routes.
- [x] Move the portfolio into Blade and assets into public; generate asset/API URLs and update service worker scope and cache behavior.
- [x] Implement chat routing/controller, preserve the assistant prompt and byte limit, migrate local credentials without displaying them, and configure file-backed runtime storage.
- [x] Replace static hosting instructions and deployment workflow with Laravel setup and public document root instructions.
- [x] Run feature tests, formatting, configuration/route/view caching, dependency validation, and HTTP smoke checks. Review the final diff.
