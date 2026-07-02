# Portfolio App

A developer portfolio, product showcase, and software marketplace.

## Structure

```
portfolio-app/
├── backend/     Laravel 12 REST API (MySQL, Sanctum SPA auth)
└── frontend/    React 19 + Vite + TypeScript
```

## Stack

- **Frontend**: React 19, Vite, TypeScript, React Router, Tailwind CSS v4, Axios, Framer Motion, React Icons, react-helmet-async
- **Backend**: Laravel 12, MySQL, Sanctum (cookie-based SPA auth), Eloquent ORM

## Local development

### Backend

```
cd backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Requires a running MySQL server (e.g. via XAMPP) with a `portfolio_app` database.

### Frontend

```
cd frontend
npm install
cp .env.example .env
npm run dev
```

Frontend runs on `http://localhost:5173`, backend API on `http://localhost:8000`.
