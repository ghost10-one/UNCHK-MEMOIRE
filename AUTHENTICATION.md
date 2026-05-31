# Authentication System Documentation

## Overview
Complete JWT-based authentication system for the Medical Delegates Platform with role-based access control (RBAC), account lockout, password reset, and audit logging.

## Key Features

### 1. User Registration (BF1.1)
- Register with email, password, name, phone, and role selection
- Supported roles: `delegate`, `manager`, `pro_santé`
- Password hashing with bcrypt (12 rounds)
- Audit logging on registration

**Endpoint:** `POST /api/auth/register`

```json
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "SecurePassword123!",
  "password_confirmation": "SecurePassword123!",
  "phone": "+33612345678",
  "role": "delegate"
}
```

### 2. Login (BF1.2)
- JWT-based authentication with Sanctum
- Token expires in 60 minutes
- Account lockout after 5 failed attempts (15-minute cooldown)
- Returns bearer token for API requests

**Endpoint:** `POST /api/auth/login`

```json
{
  "email": "john@example.com",
  "password": "SecurePassword123!"
}
```

**Response:**
```json
{
  "message": "Login successful",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "john@example.com",
    "role": "delegate"
  },
  "token": "1|abcdefghijklmnopqrstuvwxyz",
  "token_type": "Bearer",
  "expires_in": 3600
}
```

### 3. Role-Based Access Control (BF1.3)
Three distinct roles with isolated access:

- **Délégué Médical (Delegate)**: Can create and manage visits
- **Manager**: Full administrative access, user management
- **Professionnel de Santé (Pro Santé)**: Can view and create visits

Use middleware to protect routes:
```php
Route::get('/path', Controller::class)->middleware('auth:sanctum', 'role:manager');
```

### 4. Logout (BF1.4)
- Invalidates all tokens for the user
- Automatic token expiration (60 minutes)
- Audit logging on logout

**Endpoint:** `POST /api/auth/logout`

### 5. Password Reset (BF1.5)
Two-step process:

**Step 1: Request reset token**
```
POST /api/auth/password-reset-request
{
  "email": "john@example.com"
}
```

**Step 2: Reset with token**
```
POST /api/auth/password-reset
{
  "token": "reset_token_here",
  "password": "NewPassword123!",
  "password_confirmation": "NewPassword123!"
}
```

### 6. Account Lockout (BF1.6)
- Automatic lockout after 5 failed login attempts
- 15-minute lockout period
- Returns 423 status code when locked
- Failed attempts reset on successful login

**Response when locked:**
```json
{
  "message": "Account is temporarily locked. Please try again later.",
  "locked_until": "2024-05-31T14:30:00Z"
}
```

## Security Features

### Token Management
- **Expiration:** 60 minutes (configurable in code)
- **Refresh:** `POST /api/auth/refresh` (revokes old token, issues new one)
- **Revocation:** Automatic on logout, all tokens deleted

### Audit Logging
All security events are logged in `audit_logs` table:
- User registrations
- Login attempts (success and failure)
- Account lockouts
- Password resets
- Token refreshes
- Logout events

**Cleanup:** Audit logs older than 90 days are automatically deleted via:
```bash
php artisan audit:cleanup --days=90
```

### Data Protection
- Passwords hashed with bcrypt (12 rounds)
- Sensitive data excluded from API responses
- IP address and user agent logged for all events
- Password reset tokens expire in 60 minutes
- Reset tokens marked as used after password change

## API Endpoints

### Authentication Routes

| Method | Endpoint | Auth | Description |
|--------|----------|------|-------------|
| POST | `/api/auth/register` | No | Register new user |
| POST | `/api/auth/login` | No | Login user |
| POST | `/api/auth/logout` | Yes | Logout user |
| POST | `/api/auth/refresh` | Yes | Refresh token |
| GET | `/api/auth/me` | Yes | Get current user |
| POST | `/api/auth/password-reset-request` | No | Request password reset |
| POST | `/api/auth/password-reset` | No | Reset password with token |
| POST | `/api/auth/password-reset-validate` | No | Validate reset token |

## Database Schema

### Users Table
```sql
- id: bigint
- name: string
- email: string (unique)
- password: string (hashed)
- phone: string (nullable)
- role: string (delegate, manager, pro_santé)
- email_verified_at: timestamp (nullable)
- failed_login_attempts: integer (default: 0)
- locked_until: timestamp (nullable)
- is_active: boolean (default: true)
- timestamps
```

### Audit Logs Table
```sql
- id: bigint
- user_id: bigint (nullable)
- action: string (login_success, failed_login, logout, etc.)
- description: string (nullable)
- ip_address: string (nullable)
- user_agent: text (nullable)
- metadata: json (nullable)
- timestamps
```

### Password Reset Tokens Table
```sql
- id: bigint
- user_id: bigint
- token: string (unique)
- expires_at: timestamp
- used: boolean (default: false)
- timestamps
```

## Running Migrations

```bash
# From inside the Docker container or with PHP installed
php artisan migrate

# Seed default roles and test users
php artisan db:seed --class=RolesAndPermissionsSeeder
```

## Test Users

After seeding, the following test accounts are available:

| Email | Password | Role |
|-------|----------|------|
| admin@medical.com | admin123 | manager |
| delegate@medical.com | password123 | delegate |
| manager@medical.com | password123 | manager |
| pro@medical.com | password123 | pro_santé |

## Configuration

Key constants in `app/Models/User.php`:

```php
const MAX_FAILED_LOGIN_ATTEMPTS = 5;
const LOCKOUT_DURATION_MINUTES = 15;
const ROLE_DELEGATE = 'delegate';
const ROLE_MANAGER = 'manager';
const ROLE_PRO_SANTÉ = 'pro_santé';
```

Token expiration: `now()->addMinutes(60)` in AuthenticationService

## Usage Examples

### Login and Store Token
```javascript
const response = await fetch('/api/auth/login', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({
    email: 'user@example.com',
    password: 'password'
  })
});

const data = await response.json();
localStorage.setItem('auth_token', data.token);
```

### Using Token in Requests
```javascript
const response = await fetch('/api/protected-route', {
  method: 'GET',
  headers: {
    'Authorization': `Bearer ${localStorage.getItem('auth_token')}`
  }
});
```

### Refresh Token
```javascript
const response = await fetch('/api/auth/refresh', {
  method: 'POST',
  headers: {
    'Authorization': `Bearer ${oldToken}`
  }
});

const data = await response.json();
localStorage.setItem('auth_token', data.token);
```

## Error Codes

| Code | Status | Description |
|------|--------|-------------|
| 200 | OK | Request successful |
| 201 | Created | User registered successfully |
| 400 | Bad Request | Invalid request data |
| 401 | Unauthorized | Authentication required or failed |
| 403 | Forbidden | Insufficient permissions |
| 422 | Unprocessable Entity | Validation error |
| 423 | Locked | Account locked due to failed attempts |
| 500 | Server Error | Internal error |

## Security Considerations

✅ **Implemented:**
- Password hashing with bcrypt
- JWT authentication with Sanctum
- Account lockout mechanism
- Password reset token validation
- Comprehensive audit logging
- RBAC with role-based middleware
- Secure password reset process
- CSRF protection (Laravel default)
- SQL injection prevention (Eloquent ORM)
- XSS protection (framework default)

⚠️ **Recommended Additional Measures:**
- Enable HTTPS/TLS 1.3 in production
- Configure CORS for frontend domain
- Implement rate limiting on auth endpoints
- Add email verification before account activation
- Enable 2FA for sensitive roles (future enhancement)
- Implement IP whitelisting for managers

## Troubleshooting

### Account Locked
Check `locked_until` timestamp in users table. Account will automatically unlock after 15 minutes.

### Token Expired
All tokens expire after 60 minutes. Call `POST /api/auth/refresh` to get a new token.

### Password Reset Not Working
Verify the reset token exists in `password_reset_tokens_extended` table and hasn't expired.

### Audit Logs Growing Too Large
Run cleanup command: `php artisan audit:cleanup`

## Support

For issues or questions, refer to the requirements document (Cahier_des_Charges_Plateforme_Delegues_Medicaux.pdf) or contact the development team.
