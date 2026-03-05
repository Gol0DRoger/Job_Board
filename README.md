Job Board Application
A streamlined job board platform built with Laravel 12, Livewire 3, and Breeze. This application provides a seamless experience for both recruiters to manage listings and job seekers to find their next opportunity.

🚀 Features
For Recruiters
Job Management: Create, Read, Update, and Delete (CRUD) your own job postings.

Applicant Tracking: View list of applicants (name and email) for each job.

Privacy: Secure access ensuring recruiters only manage their own listings.

For Job Seekers
Job Discovery: Browse all listings with built-in pagination.

Search & Filter: Find roles by title or location. Filter by work type: Remote, Hybrid, or WFO.

Simple Applications: Apply to jobs by uploading a .pdf resume.

Application History: Dedicated section to track all jobs you have applied for.

🛠️ Technical Stack
Framework: Laravel 12

Frontend: Livewire 3 (Full-stack interactivity)

Authentication: Laravel Breeze (Tailwind CSS)

Database: MySQL

💻 Installation
Follow these steps to get the project running locally:

Clone the repository

Bash

git clone https://github.com/your-username/job-board.git
cd job-board
Install dependencies

Bash

composer install
npm install && npm run build
Environment Setup

Copy .env.example to .env.

Set your database name to job_board (or your preferred name).

Update database credentials (DB_USERNAME, DB_PASSWORD).

Database Migration

Bash

php artisan migrate
Storage Link (Required for resume uploads)

Bash

php artisan storage:link
Run the application

Bash

php artisan serve
