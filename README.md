# Job Board Application

A streamlined job board platform built with **Laravel 12**, **Livewire 3**, and **Breeze**. This application provides a seamless experience for both recruiters to manage listings and job seekers to find their next opportunity.

---

## Working


https://github.com/user-attachments/assets/59cd3251-18c2-4539-8ab5-2c3126fd22b2

<img width="1838" height="935" alt="Screenshot 2026-03-05 185636" src="https://github.com/user-attachments/assets/b3d8b3c1-6a0d-44a0-8b9c-14b1bf478988" />


## 🚀 Features

### For Recruiters
* **Job Management:** Create, Read, Update, and Delete (CRUD) your own job postings.
* **Applicant Tracking:** View list of applicants (name and email) for each job.
* **Privacy:** Secure access ensuring recruiters only manage their own listings.

### For Job Seekers
* **Job Discovery:** Browse all listings with built-in pagination.
* **Search & Filter:** Find roles by title or location. Filter by work type: **Remote, Hybrid, or WFO**.
* **Simple Applications:** Apply to jobs by uploading a **.pdf resume**.
* **Application History:** Dedicated section to track all jobs you have applied for.

---

## 🛠️ Technical Stack
* **Framework:** Laravel 12
* **Frontend:** Livewire 3 (Full-stack interactivity)
* **Authentication:** Laravel Breeze (Tailwind CSS)
* **Database:** MySQL

---

## 💻 Installation

Follow these steps to get the project running locally:

### 1. Clone the repository

git clone [https://github.com/your-username/job-board.git](https://github.com/your-username/job-board.git)

cd job-board

### 2. Install dependencies

composer install

npm install && npm run build

### 3. Environment Setup
Copy .env.example to .env.

Set your database name to job_board (or your preferred name).

Update database credentials (DB_USERNAME, DB_PASSWORD).

### 4. Database Migration

php artisan migrate

### 5. Storage Link
Required for resume uploads.

php artisan storage:link


### 6. Run the application

php artisan serve
