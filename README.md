# NYDT Website (Laravel 10)

## Prerequisites
- PHP 8.1+ with openssl, curl, fileinfo, sqlite, mbstring extensions
- Composer

## Setup
1. Install deps: `composer install`
2. Copy env: `cp .env.example .env` (then set DB, mail, app key)
3. Generate key: `php artisan key:generate`
4. Migrate DB: `php artisan migrate`
5. Seed base data:
   - Admin user: `php artisan db:seed --class=UserSeeder`
   - Roles: `php artisan db:seed --class=UserLevelSeeder`
   - Portal demo: `php artisan db:seed --class=PortalDemoSeeder` (optional)
6. Backfill sensitive data (run in each environment after enabling casts):
   - Encrypt client PII: `php artisan clients:encrypt-pii`
   - Move legacy profile photos to protected storage: `php artisan photos:migrate-public-to-protected`

## Running
`php artisan serve --host=127.0.0.1 --port=8000`

For domain-based routes, add to hosts:
```
127.0.0.1 crm.nydt.law
127.0.0.1 portal.nydt.law
```

## Auth Credentials (seeded)
- CRM admin: `zrabotest1@gmail.com` / `12345678`
- Portal demo: `portal.demo@example.com` / `C`

## Testing
`php artisan test`

## Security Notes
- Client PII fields are encrypted; ensure `clients:encrypt-pii` is run on legacy data.
- Profile photos are stored in protected storage; use signed routes for display/download.
- Direct card entry is disabled by default (`ALLOW_DIRECT_CARD_ENTRY=false`). For PCI safety, integrate a hosted/tokenized payment flow (e.g., Authorize.Net Accept Hosted) instead of enabling direct card processing.
