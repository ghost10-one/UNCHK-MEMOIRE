# Authentication Quick Start Guide

## 🚀 Getting Started in 5 Minutes

### Step 1: Run Migrations
```bash
cd platforme/src
php artisan migrate
```

### Step 2: Seed Data
```bash
php artisan db:seed --class=RolesAndPermissionsSeeder
```

### Step 3: Test Login
Use these credentials with **POST** `/api/auth/login`:

```json
{
  "email": "admin@medical.com",
  "password": "admin123"
}
```

### Step 4: Store Token
Response will include a token. Use it in the Authorization header:
```
Authorization: Bearer <your_token_here>
```

### Step 5: Access Protected Routes
```
GET /api/auth/me
```

---

## 📚 Test Credentials

| Email | Password | Role |
|-------|----------|------|
| admin@medical.com | admin123 | Manager |
| delegate@medical.com | password123 | Delegate |
| manager@medical.com | password123 | Manager |
| pro@medical.com | password123 | Pro Santé |

---

## 🔗 Essential Endpoints

### Register
```
POST /api/auth/register
Content-Type: application/json

{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "SecurePass123!",
  "password_confirmation": "SecurePass123!",
  "phone": "+33612345678",
  "role": "delegate"
}
```

### Login
```
POST /api/auth/login
Content-Type: application/json

{
  "email": "user@example.com",
  "password": "SecurePass123!"
}
```

Response:
```json
{
  "message": "Login successful",
  "user": { ... },
  "token": "1|xyz...",
  "token_type": "Bearer",
  "expires_in": 3600
}
```

### Get Current User
```
GET /api/auth/me
Authorization: Bearer <token>
```

### Logout
```
POST /api/auth/logout
Authorization: Bearer <token>
```

### Refresh Token
```
POST /api/auth/refresh
Authorization: Bearer <token>
```

### Request Password Reset
```
POST /api/auth/password-reset-request
Content-Type: application/json

{
  "email": "user@example.com"
}
```

### Reset Password
```
POST /api/auth/password-reset
Content-Type: application/json

{
  "token": "<reset_token>",
  "password": "NewPassword123!",
  "password_confirmation": "NewPassword123!"
}
```

---

## 🔐 Key Security Features

✅ **JWT Tokens** - 60-minute expiration
✅ **Account Lockout** - 5 failed attempts = 15-min lockout
✅ **Password Hashing** - Bcrypt with 12 rounds
✅ **RBAC** - 3 roles with granular permissions
✅ **Audit Logging** - All events logged with IP & user-agent
✅ **Token Refresh** - Renew expired tokens safely

---

## 🐛 Troubleshooting

### "Account is temporarily locked"
- Account locked after 5 failed login attempts
- Automatically unlocks after 15 minutes
- Check `locked_until` field in users table

### "Invalid credentials"
- Email/password mismatch
- User account may be inactive (check `is_active` field)

### "Token expired"
- Call `POST /api/auth/refresh` to get new token
- All tokens expire after 60 minutes

### Migrations fail
- Make sure you're in the `src` directory
- Run `php artisan config:clear` first
- Check database connection in `.env`

---

## 📊 Database Changes

### Users Table
```
- role (delegate, manager, pro_santé)
- failed_login_attempts (int)
- locked_until (timestamp)
- phone (string)
- is_active (boolean)
```

### New Tables
- `audit_logs` - All authentication events
- `password_reset_tokens_extended` - Password reset tokens
- `roles`, `permissions`, `model_has_roles`, `model_has_permissions` - RBAC tables

---

## 🛠️ Configuration

Key settings in `app/Models/User.php`:
```php
const MAX_FAILED_LOGIN_ATTEMPTS = 5;        // Failed attempts before lockout
const LOCKOUT_DURATION_MINUTES = 15;        // Lockout duration
```

Token expiration in `app/Services/AuthenticationService.php`:
```php
now()->addMinutes(60)  // 60-minute token expiration
```

---

## 📋 Checklist

- [ ] Migrations run successfully
- [ ] Database seeded with test users
- [ ] Can login with test credentials
- [ ] Token received and stored
- [ ] GET /api/auth/me works with token
- [ ] Account lockout works (test with wrong password 5x)
- [ ] Token refresh works
- [ ] Logout invalidates token

---

## 🎯 Next Steps

1. **Email Setup** - Configure password reset emails
2. **Frontend Integration** - Connect Vue.js/Blade forms
3. **Rate Limiting** - Add throttling to auth endpoints
4. **Testing** - Write unit/feature tests
5. **Deployment** - Set HTTPS/TLS, update CORS

---

## 📖 Documentation

Full details:
- `AUTHENTICATION.md` - Complete API documentation
- `IMPLEMENTATION_SUMMARY.md` - Technical implementation details
- `AUTH_FILES_MANIFEST.md` - File-by-file breakdown

---

**Ready to test? Start with Step 1 above!** 🚀
