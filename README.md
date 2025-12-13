# TRU Study Group Board 📚

A PHP-based web application designed to help university students organize, find, and join study groups based on specific courses. The application utilizes a custom MVC pattern for logic handling and jQuery for asynchronous interactions.

## 🚀 Features

* **User Authentication:** Secure Sign Up, Sign In, and Sign Out functionality with PHP Session management.
* **Study Group Management:**
    * **Create:** Users can post new study sessions (Course ID, Date, Time, Location).
    * **Join:** Users can join existing groups created by others.
    * **Manage:** Group owners can Edit or Delete their listings.
* **Real-Time Search:** AJAX-powered search bar allowing users to filter groups by Course ID instantly.
* **Profile System:** Users can update their usernames or delete their accounts (which automatically removes their owned groups).
* **Responsive UI:** Built with Bootstrap 5, featuring modal windows for cleaner navigation.

## 🛠️ Tech Stack

* **Backend:** PHP (Native), MySQL (via MySQLi)
* **Frontend:** HTML5, CSS3, Bootstrap 5
* **Scripting:** JavaScript, jQuery (AJAX)
* **Architecture:** MVC (Model-View-Controller)

## 📂 Project Structure

```text
├── controller.php      # Central controller handling logic and routing
├── db_handler.php      # Database connection and CRUD functions
├── startpage.php       # Landing page (Sign In / Sign Up modals)
├── mainpage.php        # Dashboard for viewing and managing groups
├── profile.php         # User profile settings
