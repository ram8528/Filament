# 🚀 Matrix ERP — Laravel & Filament

A modern, web-based Mini ERP application built with **Laravel and Filament 5**, designed to simplify employee management, departmental organization, and content administration through a clean, interactive admin dashboard.

The project is a hands-on learning initiative focused on building practical ERP features while following Laravel conventions and Filament best practices.

## ✨ Features

### 📊 Admin Dashboard
- Employee statistics and workforce overview.
- Estimated monthly payroll for active employees.
- Department-wise employee distribution chart.
- Post publishing statistics and status chart.
- Centralized dashboard for business insights.

### 👥 Employee Management
- Create, view, update, and delete employee records.
- Employee information including name, email, phone, salary, and joining date.
- Unique employee codes.
- Department and designation assignments.
- Employee status management: Active, On Leave, and Inactive.
- Searchable and sortable employee tables.
- Salary formatting and employee status badges.

### 🏢 Department Management
- Create and manage departments.
- Activate or deactivate departments.
- Assign multiple employees to departments.
- View employee counts by department.
- Search, sort, and filter department records.

### 💼 Designation Management
- Manage employee designations.
- Associate designations with departments.
- Filter designations according to department.
- Track designation status and employee counts.

### 📝 Content Management
- Create and manage posts.
- Manage post categories and content status.
- Searchable tables and filters.
- Bulk publishing and draft actions.
- Post statistics and publishing charts.

### ⚙️ Application Features
- Filament-powered administrative interface.
- Eloquent relationships between models.
- Form validation and database migrations.
- Confirmation dialogs for destructive actions.
- Soft-delete support for employee records.
- Activity logging for selected employee changes.

> **Note:** Features such as role-based authorization, employee restoration, comprehensive automated tests, attendance management, and leave workflows may require further implementation and verification.

## 🛠️ Tech Stack

| Technology | Purpose |
|---|---|
| PHP 8.4+ | Backend development |
| Laravel | Application framework |
| Filament 5 | Admin panel and UI |
| MySQL | Relational database |
| Eloquent ORM | Database operations and relationships |
| Composer | PHP dependency management |
| Pest | Planned/ongoing automated testing |

## 📁 Project Structure

```text
app/
├── Filament/
│   ├── Resources/
│   │   ├── Employees/
│   │   ├── Departments/
│   │   ├── Designations/
│   │   ├── Posts/
│   │   └── Categories/
│   └── Widgets/
├── Models/
│   ├── Employee.php
│   ├── Department.php
│   ├── Designation.php
│   └── Post.php
├── Providers/
└── ...

database/
├── migrations/
├── factories/
└── seeders/

resources/
routes/
tests/
```

*The structure above illustrates the intended organization; actual files may differ depending on the current implementation.*

## 🚀 Getting Started

### Prerequisites

Ensure you have the following installed:

- PHP version compatible with your installed Laravel and Filament versions.
- Composer
- MySQL or another supported database
- Node.js and npm
- Git

### 1. Clone the Repository

```bash
git clone https://github.com/ram8528/Filament.git

cd Filament
```

### 2. Install Dependencies

Install PHP dependencies:

```bash
composer install
```

Install frontend dependencies:

```bash
npm install
```

### 3. Configure Environment

Create your environment file:

```bash
cp .env.example .env
```

On Windows Command Prompt, you can use:

```cmd
copy .env.example .env
```

Generate the application key:

```bash
php artisan key:generate
```

### 4. Configure the Database

Create a database in MySQL, for example:

```sql
CREATE DATABASE filament;
```

Update the database configuration in `.env`:

```env
APP_NAME="Mini ERP"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=filament
DB_USERNAME=root
DB_PASSWORD=
```

Update the database username and password to match your local environment.

### 5. Run Migrations

```bash
php artisan migrate
```

If the project has seeders configured, run them as needed:

```bash
php artisan db:seed
```

### 6. Build Frontend Assets

```bash
npm run build
```

### 7. Start the Application

```bash
php artisan serve
```

Open the application at:

http://127.0.0.1:8000

Access the Filament admin panel at the configured panel path, for example:

http://127.0.0.1:8000/admin

**Authentication:** Create an administrator account using the user-creation process configured in your project. Do not assume a default admin account exists.

## 🧠 Learning Objectives

This project provides practical experience with:

- Laravel models, migrations, and Eloquent relationships.
- Filament Resources, Forms, Tables, and Actions.
- Reusable dashboard widgets and chart visualizations.
- Dynamic dropdowns and dependent form fields.
- Database validation and CRUD workflows.
- Soft deletes and activity logging.
- Building maintainable administrative applications.

## 🗺️ Roadmap

Planned improvements include:

- [ ] Role-based access control for administrators and HR managers.
- [ ] Restore and permanently delete soft-deleted employees.
- [ ] Pest feature tests for CRUD and authorization.
- [ ] Employee attendance and check-in/check-out.
- [ ] Leave requests with approval workflows.
- [ ] Employee document management.
- [ ] Notifications and background jobs.
- [ ] Advanced reporting and export functionality.
- [ ] CI/CD pipeline and deployment automation.

## 🔐 Security

- Keep `.env` and credentials out of version control.
- Use proper authorization policies for sensitive operations.
- Validate all user input on the server.
- Restrict access to salary information and audit logs.
- Use production-safe environment settings before deployment.

## 🤝 Contributing

Contributions, suggestions, and improvements are welcome.

1. Fork the repository.
2. Create a feature branch.
3. Implement and test your changes.
4. Commit your changes with a descriptive message.
5. Open a pull request.

## 📄 License

This project is a learning and development project. Add a `LICENSE` file to the repository to explicitly define the terms under which others may use, modify, and distribute the code.

---

**Built with Laravel, Filament, and a continuous-learning mindset.** 💻