# Core PHP Password Manager

Production-oriented password manager built with core PHP + PDO + Bootstrap.

## Setup
1. `cp .env.example .env` and set DB credentials + `APP_KEY` (base64-encoded 32-byte key).
2. `composer install`
3. Run SQL in `database/migrations/001_schema.sql`.
4. Start server: `php -S localhost:8000 -t public`

## Security Controls
- `password_hash/password_verify` for user credentials.
- Prepared statements for all DB operations.
- AES-256-GCM field-level encryption for sensitive fields.
- CSRF token service.
- Basic rate limiter for login abuse.
- Security headers + strict session flags.
- Audit logging for sensitive actions.

## API Endpoints
- `POST /api/register`
- `POST /api/login`
- `POST /api/logout`
- `POST /api/passwords`

## Notes
This scaffold is intentionally modular (MVC-like) so additional CRUD controllers, UI screens, token auth middleware, TOTP, import/export, sharing, backup/restore, and test suites can be added in the same structure.
