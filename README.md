# CompliTrack

> Versi Bahasa Indonesia ada di atas, English version di bawah.

---

## Ringkasan Proyek (Project Overview)
CompliTrack adalah aplikasi web internal untuk mengelola kebijakan/SOP perusahaan, mendistribusikannya ke divisi terkait, dan memantau kepatuhan lewat checklist, bukti (evidence), serta audit review yang terstruktur. Cocok sebagai portfolio, bahan review recruiter, dan referensi developer lain yang ingin memahami repo ini.

- Jenis: Fullstack Web Application
- Backend: Laravel
- Frontend: React
- Styling: Tailwind CSS
- Database: PostgreSQL
- Domain: Policy, SOP, dan Compliance Management

## Tech Stack
- Laravel 12 (Fortify untuk auth)
- React + Vite (Inertia sebagai bridge)
- Tailwind CSS
- TypeScript
- PostgreSQL

## Fitur Utama (Features)
- Authentication & Role (Admin, Staff, Auditor)
- Policy & SOP Management dengan versioning
- Assignment SOP ke divisi
- Compliance checklist per SOP
- Upload evidence/bukti kepatuhan
- Audit review & approval
- Audit trail (log aktivitas)

## User Roles
- Admin: kelola kebijakan/SOP, versioning, assignment ke divisi, monitor kepatuhan, approve/reject.
- Staff: lihat SOP yang ditugaskan, isi checklist, unggah evidence.
- Auditor: review kepatuhan, beri catatan/temuan, rekomendasi perbaikan.

## Database Overview (High Level)
High-level konsep tabel (tanpa ERD):
- `users`: akun user + role (Admin/Staff/Auditor), keamanan (mis. 2FA via Fortify bila diaktifkan).
- `policies`: entitas kebijakan/SOP (meta info, status aktif/non-aktif).
- `policy_versions`: versioning untuk SOP/kebijakan (riwayat perubahan, siapa yang publish).
- `divisions`: unit/divisi organisasi.
- `assignments`: mapping kebijakan/SOP ke divisi atau user.
- `checklists`: daftar item kepatuhan per kebijakan/SOP.
- `evidences`: bukti kepatuhan (file/tautan/metadata).
- `audits`: review kepatuhan per periode, hasil, catatan.
- `audit_trails`: log aktivitas (siapa melakukan apa & kapan).

Catatan: Nama tabel di atas adalah gambaran umum; implementasi akhir bisa berbeda mengikuti kebutuhan.

## Installation & Setup (Local)

### Prasyarat
- PHP 8.2+
- Composer
- Node.js 18+
- PostgreSQL 14+ (atau versi kompatibel)

### Langkah Setup
1) Clone repo dan masuk folder proyek.

```bash
git clone <repo-url>
cd CompliTrack
```

2) Siapkan environment file dan app key.

```bash
copy .env.example .env
php artisan key:generate
```

3) Konfigurasi database PostgreSQL di `.env`.

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=complitrack
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

4) Install dependencies.

```bash
composer install
npm install
```

5) Jalankan migrasi (dan seeder bila diperlukan).

```bash
php artisan migrate
php artisan db:seed
```

6) Jalankan aplikasi (frontend + backend).

```bash
npm run dev
php artisan serve
```

Akses aplikasi di `http://localhost:8000`.

## Screenshots
- Placeholder: Dashboard utama
- Placeholder: Detail kebijakan/SOP + versioning
- Placeholder: Checklist & upload evidence
- Placeholder: Halaman audit review

## Future Improvements
- Single Sign-On (SSO) dengan Azure AD/Google Workspace
- Advanced reporting & export (PDF/CSV)
- Reminder & notifikasi (email/in-app)
- Lifecycle policy (draft → review → publish → retire)
- Granular permission per modul/aksi
- Full-text search & filter yang lebih kaya
- API endpoints untuk integrasi internal

## Author
Maintainer: CompliTrack Team — isi sesuai tim/penulis proyek ini.

---

# CompliTrack (English Version)

## Project Overview
CompliTrack is an internal web platform to manage company policies/SOPs, distribute them to relevant divisions, and track compliance via structured checklists, evidence uploads, and audit reviews. Built to be clear and practical for portfolios, recruiters, and developers reading this repo.

- Type: Fullstack Web Application
- Backend: Laravel
- Frontend: React
- Styling: Tailwind CSS
- Database: PostgreSQL
- Domain: Policy, SOP, and Compliance Management

## Tech Stack
- Laravel 12 (Fortify for auth)
- React + Vite (Inertia as the bridge)
- Tailwind CSS
- TypeScript
- PostgreSQL

## Features
- Authentication & Roles (Admin, Staff, Auditor)
- Policy & SOP Management with versioning
- SOP assignment to divisions
- Compliance checklist per SOP
- Evidence upload for compliance
- Audit review & approval
- Audit trail (activity logging)

## User Roles
- Admin: manage policies/SOP, versioning, assign to divisions, monitor compliance, approve/reject.
- Staff: view assigned SOPs, complete checklists, upload evidence.
- Auditor: review compliance, add notes/findings, suggest improvements.

## Database Overview (High Level)
High-level table concepts (no ERD):
- `users`: user accounts + role (Admin/Staff/Auditor), security (e.g., 2FA via Fortify if enabled).
- `policies`: policy/SOP entity (metadata, active/inactive status).
- `policy_versions`: versioning for policies/SOPs (change history, publisher).
- `divisions`: organizational units.
- `assignments`: mapping policies/SOP to divisions or users.
- `checklists`: compliance items per policy/SOP.
- `evidences`: compliance evidence (files/links/metadata).
- `audits`: compliance reviews per period, results, notes.
- `audit_trails`: activity logs (who did what & when).

Note: Names above are conceptual; actual implementation may vary.

## Installation & Setup (Local)

### Prerequisites
- PHP 8.2+
- Composer
- Node.js 18+
- PostgreSQL 14+ (or compatible)

### Setup Steps
1) Clone the repo and enter the project folder.

```bash
git clone <repo-url>
cd CompliTrack
```

2) Prepare the environment file and app key.

```bash
copy .env.example .env
php artisan key:generate
```

3) Configure PostgreSQL in `.env`.

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=complitrack
DB_USERNAME=postgres
DB_PASSWORD=your_password
```

4) Install dependencies.

```bash
composer install
npm install
```

5) Run migrations (and seed if needed).

```bash
php artisan migrate
php artisan db:seed
```

6) Run the app (frontend + backend).

```bash
npm run dev
php artisan serve
```

Open `http://localhost:8000` in your browser.

## Screenshots
- Placeholder: Main dashboard
- Placeholder: Policy/SOP details + versioning
- Placeholder: Checklist & evidence upload
- Placeholder: Audit review page

## Future Improvements
- Single Sign-On (SSO) with Azure AD/Google Workspace
- Advanced reporting & export (PDF/CSV)
- Reminders & notifications (email/in-app)
- Policy lifecycle (draft → review → publish → retire)
- Granular permissions per module/action
- Rich full-text search & filters
- API endpoints for internal integrations

## Author
Maintainer: CompliTrack Team — fill with your team/maintainer info.

# Laravel + React Starter Kit

## Introduction

Our React starter kit provides a robust, modern starting point for building Laravel applications with a React frontend using [Inertia](https://inertiajs.com).

Inertia allows you to build modern, single-page React applications using classic server-side routing and controllers. This lets you enjoy the frontend power of React combined with the incredible backend productivity of Laravel and lightning-fast Vite compilation.

This React starter kit utilizes React 19, TypeScript, Tailwind, and the [shadcn/ui](https://ui.shadcn.com) and [radix-ui](https://www.radix-ui.com) component libraries.

## Official Documentation

Documentation for all Laravel starter kits can be found on the [Laravel website](https://laravel.com/docs/starter-kits).

## Contributing

Thank you for considering contributing to our starter kit! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## License

The Laravel + React starter kit is open-sourced software licensed under the MIT license.
