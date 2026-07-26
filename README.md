# TRU Study Group Board 📚

A PHP-based web application designed to help university students organize, find, and join study groups based on specific courses. Built as part of **COMP3540 — Web Technologies** at Thompson Rivers University, the application uses a custom MVC pattern and jQuery for asynchronous interactions.

## 🚀 Features

- **User Authentication:** Secure Sign Up, Sign In, and Sign Out with PHP Session management
- **Study Group Management:**
  - **Create:** Post new study sessions (Course ID, Date, Time, Location)
  - **Join:** Join existing groups created by other users
  - **Manage:** Group owners can Edit or Delete their listings
- **Real-Time Search:** AJAX-powered search bar to filter groups by Course ID instantly
- **Profile System:** Update username or delete account (auto-removes owned groups)
- **Responsive UI:** Bootstrap 5 with modal windows for cleaner navigation

## 🛠️ Tech Stack

| Layer | Technology |
|---|---|
| Backend | PHP (Native), MySQL (MySQLi) |
| Frontend | HTML5, CSS3, Bootstrap 5 |
| Scripting | JavaScript, jQuery (AJAX) |
| Architecture | MVC (Model-View-Controller) |

## 📂 Project Structure

```text
├── project/
│   ├── controller.php      # Central controller — routing and logic
│   ├── db_handler.php      # Database connection and CRUD functions
│   ├── startpage.php       # Landing page (Sign In / Sign Up modals)
│   ├── mainpage.php        # Dashboard for viewing and managing groups
│   └── profile.php         # User profile settings
└── README.md
```

## ⚙️ Getting Started

### Prerequisites
- PHP 8.x
- MySQL 8.x
- A local server environment: [XAMPP](https://www.apachefriends.org/) or [WAMP](https://www.wampserver.com/)

### Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/BK0SS/StudyGroup-finder-comp3540.git
   ```
2. Move the `project/` folder into your server's web root (e.g., `htdocs/` for XAMPP).
3. Create a MySQL database and import the schema:
   ```sql
   CREATE DATABASE studygroup_db;
   ```
4. Update `db_handler.php` with your database credentials.
5. Start Apache and MySQL via XAMPP/WAMP and navigate to `http://localhost/project/startpage.php`.

## 🎫 Academic Context

Developed for **COMP3540 — Web Technologies** at Thompson Rivers University. Demonstrates MVC architecture, AJAX interactions, session management, and relational database design in a full-stack PHP environment.

## 👤 Author

**Bogdan Kosulin**
- GitHub: [@BK0SS](https://github.com/BK0SS)
- LinkedIn: [bogdan-kosulin](https://www.linkedin.com/in/bogdan-kosulin/)
