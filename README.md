Birdie - Social Media Application 🌲

📄 Project Description and Purpose

Birdie is a robust, minimalist social media platform built for the Integrated Laboratory Midterm Exam. Designed as an educative micro-blogging network, its purpose is to provide a clean, distraction-free space for users to share quick insights, research notes, and daily learnings. The application strictly adheres to academic standards for secure implementation and modern UI/UX principles.

✨ Features Implemented

I. User Authentication & Profile

Secure Auth: Full registration, login, and logout system using Laravel Breeze. Protected routes ensure only authenticated users can tweet and like.

Profile Management: Users can update their Name, Email, Password, and Profile Photo (Avatar).

Bio Integration: Custom "About Me" bio displayed on profiles and settings.

Profile Views: Public profile pages showing user activity statistics (Total Posts, Total Likes Received), Bio, and Join Date.

II. Content Management (Entries)

Create: Real-time character counter (Max 280 chars).

Feed Sorting: Global feed displaying content, author, and timestamp. Feed is ordered by Newest first.

Update: Users can edit their own posts. Shows a visual (Edited) indicator if modified.

Delete: Users can delete their own posts, with a confirmation prompt required before deletion.

Ownership: Clear "You" badge displayed on owned posts.

III. Engagement System

Like/Unlike: Instant toggle using AJAX (optimized from the original form submission). One user can only like a post once.

Visual Indicator: Heart icon changes color to show if the current user has liked a post.

Community Sidebar: Dynamic list of the latest registered members showing activity stats and bio snippets.

IV. Technical & Design

Theme: Custom "Editorial Forest" design (Green/Sand palette) with Merriweather (Serif) and Inter (Sans-serif) fonts enforced globally.

Code Quality: Proper use of dedicated Controllers, Eloquent Models with defined relationships, and implemented Form Validation.

Database: Proper migrations for users, tweets, and likes tables with correct foreign keys and constraints.

🛠️ Installation Instructions

Prerequisites

WAMPP/XAMPP (or equivalent PHP/MySQL server)

PHP 8.2 or higher

Composer

Node.js & NPM

1. Setup & Dependencies

# 1. Clone the repository
git clone [https://github.com/marcos-njp/laravel-twitter.git](https://github.com/marcos-njp/laravel-twitter.git)
cd laravel-twitter

# 2. Install PHP and Frontend Dependencies
composer install
npm install


2. Configure Environment

Create your environment file and set up the database connection.

# 3. Create environment file and generate key
cp .env.example .env
php artisan key:generate


Configure .env Database Section:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=birdie_db  # Create this database in phpMyAdmin
DB_USERNAME=root
DB_PASSWORD=


3. Database & Storage Setup

Run migrations and create the necessary symbolic link for file storage.

# 4. Run Migrations (Creates Users, Tweets, Likes tables)
php artisan migrate

# 5. CRITICAL: Link public storage for profile photos and uploaded files
php artisan storage:link 


4. Run Application

Open two terminal windows:

# Terminal 1 (Backend Server)
php artisan serve

# Terminal 2 (Frontend Assets Compiler)
npm run dev


Access the application at: http://localhost:8000

📸 Screenshots of the Application

The application features a clean, responsive layout across all views.

Landing Page: 

User Feed:

Account Settings:

User Profile:

👨‍💻 Credits

Developed by: Niño Marcos
LinkedIn: linkedin.com/in/niño-marcos
GitHub: github.com/marcos-njp/laravel-twitter

Built for the Integrated Programming Laboratory Midterm Exam.