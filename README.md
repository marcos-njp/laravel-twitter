# 🌲 Birdie — Social Media Application

A minimalist micro-blogging platform built for the **Integrated Programming Laboratory Midterm Exam**.  
Birdie allows users to post short insights, research notes, and daily updates with a clean and simple interface.

---

## 📌 Table of Contents
- [Features](#-features)
- [Tech Stack](#-tech-stack)
- [Installation](#-installation)
- [Environment Configuration](#-environment-configuration)
- [Database Setup](#-database-setup)
- [Running the Application](#-running-the-application)
- [Screenshots](#-screenshots)
- [Developer](#-developer)

---

## ✨ Features

### **1. User Authentication & Profile**
- Authentication system via **Laravel Breeze**
- Register, Login, Logout
- Protected routes for posting and liking
- Editable profile: Name, Email, Password, Profile Photo
- “About Me” Bio field
- Public Profile Page with:
  - Total Posts
  - Total Likes Received
  - Bio
  - Join Date

---

### **2. Content Management (Posts)**
- Create posts up to **280 characters**
- Real-time character counter
- Global feed sorted by **Newest First**
- Edit own posts (shows **Edited** indicator)
- Delete own posts with confirmation
- “**You**” badge on owned posts

---

### **3. Engagement System**
- Like / Unlike using **AJAX**
- Heart icon updates instantly
- One-like-per-user rule enforced
- Sidebar with:
  - Latest registered users
  - Activity stats
  - Bio snippets

---

### **4. Technical & Design**
- Custom **Editorial Forest** theme (Green/Sand palette)
- Fonts: **Merriweather** + **Inter**
- Organized Controllers and Eloquent relationships
- Form validation implemented
- Migrations for Users, Tweets, Likes
- Profile photo storage using `php artisan storage:link`

---

## 🛠 Tech Stack
- **Laravel 11**
- **Laravel Breeze**
- **MySQL**
- **TailwindCSS / Vite**
- **JavaScript / AJAX**
- **PHP 8.2+**

---

## 📥 Installation

### **1. Clone Repository**
```bash
git clone https://github.com/marcos-njp/laravel-twitter.git
cd laravel-twitter

2. Install Dependencies
composer install
npm install

⚙️ Environment Configuration
Create .env and generate key:

cp .env.example .env
php artisan key:generate

Update the .env database section:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=birdie_db
DB_USERNAME=root
DB_PASSWORD=
