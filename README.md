# Birdie — Social Media Application

A minimalist micro-blogging platform built for the Integrated Programming Laboratory Midterm Exam. Birdie allows users to post short insights, research notes, and daily updates with a clean and simple interface.

-----

## Table of Contents

  - [Features](#features)
  - [Tech Stack](#tech-stack)
  - [Installation](#installation)
  - [Environment Configuration](#environment-configuration)
  - [Database Setup](#database-setup)
  - [Running the Application](#running-the-application)
  - [Screenshots](#screenshots)
  - [Developer](#developer)

-----

## Features

### 1\. User Authentication and Profile Management

The application utilizes Laravel Breeze for robust authentication and implements protected routing to secure all core functionalities.

  - **Authentication Flow:** Supports user registration (Name, Email, Password), secure login, and session-based logout.
  - **Access Control:** Middleware ensures only authenticated users can access posting, liking, and profile modification endpoints.
  - **Public Profile:** Dedicated profile page displays user activity, including total posts, total likes received, and user metadata (Join Date).
  - **User Customization:** Functionality for editing user details (Name, Email, Password) is available.

### 2\. Content Management System

The core application allows for the full lifecycle management of micro-posts.

  - **Post Creation:** Users can submit short posts up to **280 characters** in length. A real-time character counter provides immediate feedback to the user.
  - **Feed Structure:** The global timeline is presented on the homepage, sorted chronologically by **Newest First**.
  - **Post Modification:** Users are authorized to **Edit** and **Delete** only their own posts. Deletion is protected by a confirmation prompt.
  - **Metadata:** Modified posts display an **(Edited)** indicator, and a **"You"** badge clearly identifies the current user's own posts on the feed.

### 3\. Engagement System

The system supports key social interaction mechanics.

  - **Like/Unlike Toggle:** The like functionality is implemented using **AJAX**, allowing users to like or unlike a post instantly without requiring a full page refresh.
  - **Constraint:** A database-level constraint ensures that one user can only like a single post once.

### 4\. Technical and Design Overview

The application adheres to high standards of code quality and UX/UI design.

  - **Theme:** Utilizes a custom **Editorial Forest** theme (Green/Sand palette) applied via TailwindCSS for a professional and unique aesthetic.
  - **Code Quality:** Employs dedicated Controllers for separating concerns and uses Eloquent relationships to define the connection between Users, Posts, and Likes.
  - **Front-end:** Implemented with Laravel Blade and TailwindCSS/Vite for a fully responsive interface.

-----

## Tech Stack

  - Laravel 11
  - Laravel Breeze (Authentication Scaffolding)
  - MySQL (Database)
  - TailwindCSS / Vite (Styling and Asset Bundling)
  - JavaScript / AJAX (Engagement Logic)
  - PHP 8.2+

-----

## Installation

### 1\. Clone Repository

```
git clone [YOUR_REPOSITORY_URL]
cd [PROJECT_FOLDER_NAME]
```

### 2\. Install Dependencies

Install all required PHP packages using Composer and frontend dependencies using npm:

```
composer install
npm install
```

## Environment Configuration

Create the application environment file and generate a unique security key:

```
cp .env.example .env
php artisan key:generate
```

## Database Setup

1.  Ensure your MySQL server is running (via WAMPP, XAMPP, or equivalent).
2.  Open phpMyAdmin or your preferred database tool and create a new database named **`birdie_db`**.
3.  Update the `.env` file to point to the new database:

<!-- end list -->

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=birdie_db
DB_USERNAME=root
DB_PASSWORD=
```

4.  Run the migrations to set up the Users, Posts, and Likes tables:

<!-- end list -->

```
php artisan migrate
```

## Running the Application

During local development, two processes must be running simultaneously.

1.  **Run Backend Server (PHP):**

<!-- end list -->

```
php artisan serve
```

(The application will be accessible, usually at `http://127.0.0.1:8000`)

2.  **Run Frontend Server (Vite):**

<!-- end list -->

```
npm run dev
```

(Keep this terminal window open to ensure styles and JavaScript are loaded correctly.)

-----

## Screenshots

<img width="1918" height="946" alt="image" src="https://github.com/user-attachments/assets/598b74a0-c3e2-4e25-8813-ffe68f7a3fe0" />
<img width="1904" height="946" alt="image" src="https://github.com/user-attachments/assets/2182f1c5-2d91-4ee6-9106-b4bf65841b57" />
<img width="1899" height="943" alt="image" src="https://github.com/user-attachments/assets/07b158c7-be72-479c-8790-b730fad22199" />
<img width="1919" height="943" alt="image" src="https://github.com/user-attachments/assets/bd2770fd-b695-4432-9383-1add35ac9d30" />
<img width="1902" height="950" alt="image" src="https://github.com/user-attachments/assets/a6f7db93-0672-444e-85c9-d507b026887e" />
<img width="1899" height="943" alt="image" src="https://github.com/user-attachments/assets/e7e87e19-1006-488a-9418-c78cb6e12902" />
<img width="1902" height="949" alt="image" src="https://github.com/user-attachments/assets/3e3eaf70-e5ec-4469-9430-4a51a6dcb24c" />






-----

## Developer

**Credits and Acknowledgements:**

This project utilized **Gemini 3 Pro** as a development assistant for generating and optimizing core Laravel components, ensuring compliance with feature requirements, and assisting with debugging complex framework-level issues.
