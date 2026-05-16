# Plateforme de Gestion des Délégués Médicaux

Cette plateforme est développée avec Laravel 11 (ou version supérieure selon l'environnement) et une stack moderne dockerisée.

## Stack Technique

- **Laravel** (MVC)
- **Laravel Breeze** (Authentification Blade + Alpine.js)
- **Laravel Sanctum** (Sécurité API)
- **PostgreSQL 16** (Base de données principale)
- **Redis** (Cache, Session, Queues)
- **Docker Compose**
- **Tailwind CSS**
- **Alpine.js**
- **Vite**

## Services Docker

- `app`: PHP 8.3 FPM & Node.js
- `nginx`: Serveur web
- `postgres`: Base de données PostgreSQL 16
- `redis`: Serveur Redis 7
- `mailpit`: Serveur de capture d'emails (Mailpit)
- `pgadmin`: Interface d'administration PostgreSQL

## Installation

1. **Cloner le repository** :
   ```bash
   git clone <repository_url>
   cd platforme
   ```

2. **Démarrer les containers** :
   ```bash
   docker compose up -d --build
   ```

3. **Installer les dépendances PHP** :
   ```bash
   docker compose exec app composer install
   ```

4. **Installer les dépendances JS & Build** :
   ```bash
   docker compose exec app npm install
   docker compose exec app npm run build
   ```

5. **Configurer l'environnement** :
   Le fichier `.env` est configuré pour pointer vers les services Docker. Si nécessaire :
   ```bash
   docker compose exec app php artisan key:generate
   ```

6. **Migrations et Seeders** :
   ```bash
   docker compose exec app php artisan migrate --seed
   ```

## Accès

- **Application** : [http://localhost:8000](http://localhost:8000)
- **PgAdmin** : [http://localhost:5050](http://localhost:5050) (admin@admin.com / admin123)
- **Mailpit** : [http://localhost:8025](http://localhost:8025)

## Utilisateurs par défaut (Seeder)

- **Admin** : admin@medical.com / password
- **Manager** : manager@medical.com / password
- **Delegue** : delegue@medical.com / password

## Architecture

- `app/Services` : Logique métier complexe.
- `app/Actions` : Actions atomiques réutilisables.
- `app/Policies` : Autorisations granulaires.
- `app/Repositories` : Abstraction de la couche données.

## Sécurité, Rôles & Permissions

Le système utilise `spatie/laravel-permission` pour une gestion granulaire des accès.

### Rôles disponibles
- `admin` : Administrateur système.
- `manager` : Gestionnaire d'équipe et de données médicales.
- `delegue` : Délégué médical sur le terrain.
- `praticien` : Médecin ou professionnel de santé.

### Matrice des Permissions
| Permission | Admin | Manager | Delegue | Praticien |
| :--- | :---: | :---: | :---: | :---: |
| `manage users / roles` | ✅ | ❌ | ❌ | ❌ |
| `manage doctors / establishments` | ✅ | ✅ | ❌ | ❌ |
| `plan / edit visits` | ✅ | ✅ | ✅ | ❌ |
| `write reports` | ✅ | ❌ | ✅ | ❌ |
| `validate reports` | ✅ | ✅ | ❌ | ❌ |
| `view reports` | ✅ | ✅ | ✅ | ✅ |
| `manage campaigns` | ✅ | ✅ | ❌ | ❌ |
| `view analytics` | ✅ | ✅ | ❌ | ❌ |

### Utilisation dans le Code

#### Middlewares (Routes)
```php
// Par rôle
Route::get('/admin', [AdminController::class, 'index'])->middleware('role:admin');

// Par permission (Recommandé)
Route::post('/visits', [VisitController::class, 'store'])->middleware('can:plan visits');
```

#### Blade (Vues)
```blade
@can('validate reports')
    <button>Valider le rapport</button>
@endcan
```

#### Contrôleurs / Policies
```php
if ($user->can('manage doctors')) {
    // Logique autorisée
}
```
