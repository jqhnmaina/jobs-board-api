# Job Portal API (Laravel Sanctum)

This is a Laravel-based RESTful API that supports:

- Separate authentication for **Users** and **Companies**
- **Job Postings** by Companies
- **Job Applications** by Users
- File upload (CV and Cover Letter)
- Authorization via Policies
- Filtering, Pagination, and Ownership Rules

---

## 🚀 Setup Instructions

### 1. Clone the Repository

```bash
git clone git@github.com:jqhnmaina/jobs-board-api.git
cd jobs-board-api
```

### 2. Install Dependencies

`composer install`

### 3. Set Up Environment

```
cp .env.example .env
php artisan key:generate
```

### 4. Run Migrations & Seeders

`php artisan migrate --seed`

**NB** users password is `password`

### 5. Serve the API

php artisan serve

## Authentication
We use Laravel Sanctum for API token authentication. Response to login and register endpoint contains a Bearer token to be used in Authorization header
`Authorization: Bearer <token>`

I have added a [postman v2.1 collection](job board api.postman_collection.json) to the root of the project that has example and endpoints documentation


## Technologies
- Laravel 12+

- Sanctum for API auth

- MySQL

- Laravel Policies for Authorization

- Laravel Resources for clean JSON APIs


