# Project Overview: CA Dash

This document provides a comprehensive overview of the **CA Dash** project, including its structure, routes, controllers, models, migrations, and view files.

---

## 📂 Folder Structure (High-Level)

```text
ca_dash/
├── app/                        # Core application logic
│   ├── Http/Controllers/       # Request handlers (Admin, Client, Staff, Auth)
│   └── Models/                 # Eloquent models
├── config/                     # Configuration files
├── database/                   # Database related files
│   ├── migrations/             # Database schema definitions
│   └── seeders/                # Database seed data
├── public/                     # Publicly accessible assets
├── resources/                  # Frontend resources
│   └── views/                  # Blade templates
│       ├── layouts/            # Master layout files
│       ├── admin/              # Admin module views
│       ├── client/             # Client module views
│       └── staff/              # Staff module views
├── routes/                     # Route definitions (web, admin, client, staff, auth)
└── storage/                    # Storage for uploads and logs
```

---

## 🏛️ Master Layouts (Path-wise)

These files serve as the base templates for different sections of the application.

- **Admin Master:** `resources/views/layouts/admin/master.blade.php`
- **Client Master:** `resources/views/layouts/client/master.blade.php`
- **Staff Master:** `resources/views/layouts/staff/master.blade.php`
- **Standard App Layout:** `resources/views/layouts/app.blade.php`
- **Guest Layout:** `resources/views/layouts/guest.blade.php`
- **Navigation:** `resources/views/layouts/navigation.blade.php`

---

## 🛣️ Routes & Controllers

The application uses modular routing split into multiple files.

### 🛡️ Admin Module
Defined in `routes/admin.php`, handled by `App\Http\Controllers\admin\*`

| Route Path | Controller method | Description |
| :--- | :--- | :--- |
| `/admin/dashboard` | `AdminController@dashboard` | Admin Dashboard |
| `/admin/profile` | `ProfileController@edit` | Edit Admin Profile |
| `/admin/service/*` | `ServiceController` | Manage Services (CRUD + Trash) |
| `/admin/business/*` | `BusinessController` | Manage Businesses (CRUD + Trash) |
| `/admin/client/*` | `ClientController` | Manage Clients from Admin side |

### 👤 Client Module
Defined in `routes/client.php`, handled by `App\Http\Controllers\client\*`

| Route Path | Controller method | Description |
| :--- | :--- | :--- |
| `/client/dashboard` | `ClientController@dashboard` | Client Dashboard |
| `/client/profile` | `ProfileController@edit` | Edit Client Profile |
| `/client/document/*` | `DocumentController` | Manage Personal Documents |
| `/client/category/*` | `DocumentCategoryController` | Manage Document Categories |
| `/client/services` | `ServiceController@index/@update` | Select/Update Services |
| `/client/business` | `BusinessController@index/@update` | Manage Business Info |

### 👥 Staff Module
Defined in `routes/staff.php`, handled by `App\Http\Controllers\staff\*`

| Route Path | Controller method | Description |
| :--- | :--- | :--- |
| `/staff/dashboard` | `StaffController@dashboard` | Staff Dashboard |
| `/staff/profile` | `ProfileController@edit` | Edit Staff Profile |

### 🔑 Authentication
Defined in `routes/auth.php`, handled by `App\Http\Controllers\Auth\*`

| Route Path | Controller | Description |
| :--- | :--- | :--- |
| `/login` | `AuthenticatedSessionController` | User Login |
| `/register` | `RegisteredUserController` | User Registration |
| `/forgot-password` | `PasswordResetLinkController` | Password Recovery |
| `/logout` | `AuthenticatedSessionController` | User Logout |

---

## 📊 Models & Database

### Models (`app/Models/`)
- `User.php`: Core user authentication and profile data.
- `Client.php`: Extended information for client users.
- `Business.php`: Business details associated with clients.
- `Service.php`: Services offered or selected.
- `Document.php`: Uploaded documents details.
- `DocumentCategory.php`: Categorization for documents.

### Migrations (`database/migrations/`)
- `create_users_table`: System users (Admin, Staff, Client).
- `create_clients_table`: Client-specific metadata.
- `create_businesses_table`: Business records.
- `create_services_table`: Available services.
- `create_documents_table`: File upload tracking.
- `create_document_categories_table`: Categories for organization.
- `create_client_service_table`: Pivot table for client-service association.

---

## 🎨 View Files (Blade Templates)

### Admin Views (`resources/views/admin/`)
- `dashboard.blade.php`: Main admin landing page.
- `profile.blade.php`: Admin profile management.
- `service/`: Index, Create, Edit templates for services.
- `business/`: Index, Create, Edit templates for businesses.
- `client/`: Index, Create, View, Edit templates for managing clients.

### Client Views (`resources/views/client/`)
- `dashboard.blade.php`: Main client landing page.
- `profile.blade.php`: Client profile management.
- `document/`: Index, Create, Edit, View templates for files.
- `document_category/`: Category management templates.
- `service/`: Service selection UI.
- `business/`: Business info management UI.

### Staff Views (`resources/views/staff/`)
- `dashboard.blade.php`: Main staff landing page.
- `profile.blade.php`: Staff profile management.

---

## 🛠️ Tech Stack
- **Framework:** Laravel 11.x
- **Frontend:** Blade, Tailwind CSS, Vite
- **Database:** MySQL
- **Auth:** Laravel Breeze (customized)
