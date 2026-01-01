# Morbis Technical Test

This repository is a small Laravel application used for a queue display and anonymous ticketing demo.

## Quick Start (English)

These steps will get the project running locally.

Prerequisites

-   PHP 8.1+ (see `composer.json`)
-   Composer
-   Node.js + npm (or pnpm)
-   A database (MySQL, MariaDB, or SQLite)

Local setup

1.  Clone the repository and install PHP dependencies:

```bash
composer install
cp .env.example .env
php artisan key:generate
```

2.  Configure the database in `.env`:

-   For SQLite (quick): create the file `database/database.sqlite` and set `DB_CONNECTION=sqlite` and `DB_DATABASE=${PWD}/database/database.sqlite` (or an absolute path on Windows).
-   For MySQL/MariaDB: set `DB_CONNECTION=mysql`, `DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.

3.  Run migrations and seeders (if any):

```bash
php artisan migrate --seed
```

4.  Install frontend dependencies and start the development environment.

The project uses Composer scripts to start the dev environment. Run:

```bash
composer run dev
```

If you prefer the npm commands directly:

```bash
npm install
npm run dev
```

Note: `composer run dev` is provided as a convenience entry (per project instructions).

5.  Start Laravel Reverb (optional feature):

```bash
php artisan reverb:start
```

This will start the Reverb process if the project includes the Reverb package/commands. Check the command output for the listening URL.

6.  Access the app

Open the URL printed by the development command (or http://127.0.0.1:8000 if using `php artisan serve`) in your browser. The public queue view is available at `/`.

API endpoints

-   GET `/queue/current` — returns JSON with current serving, waiting list, and last number.
-   POST `/queue/take` — create a new anonymous ticket for today (CSRF token required).

Tests

Run the test suite with Pest or PHPUnit:

```bash
./vendor/bin/pest
# or
php artisan test
```

Useful commands summary

```bash
composer install
composer run dev         # start frontend/dev environment (project convention)
php artisan migrate --seed
php artisan reverb:start # start Laravel Reverb service
php artisan storage:link
./vendor/bin/pest
```

Troubleshooting

-   If the app cannot connect to the database, double-check your `.env` values and ensure the DB server is reachable.
-   For a quick local setup without a DB server, use SQLite as described above.
-   If `composer run dev` fails, run `npm install` then `npm run dev` directly.

Want extras?

I can add convenient `composer` scripts or a small `Makefile`/`README` section to automate setup commands—tell me which you'd prefer.
