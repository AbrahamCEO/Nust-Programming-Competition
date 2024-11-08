---

# NUST PRG Competition 2024

## Overview
The NUST PRG Competition Project is a web-based application designed to serves as a central hub for competitors, volunteers, sponsors, and organizers alike, enabling efficient coordination of events, registrations, announcements, and more. Built with PHP, JavaScript, HTML, CSS, and MySQL (using XAMPP). The project combines an efficient backend with a user-friendly interface to ensure a smooth and responsive experience.

## Deployed Site
This project is currently deployed here: [Deployed Site](http://nusthackathon.lovestoblog.com/home.php?i=1)
or locally via XAMPP. For live access, please follow the setup instructions below.

---

## Table of Contents
1. [Getting Started](#getting-started)
2. [Features](#features)
3. [Screenshots](#screenshots)
4. [Technologies Used](#technologies-used)
5. [Contributing](#contributing)
6. [License](#license)

---

## Getting Started

### Prerequisites
- **XAMPP**: Includes PHP, MySQL, and Apache Server. [Download XAMPP](https://www.apachefriends.org/index.html)
- **Web Browser**: To run and test the application.
- Optional: **phpMyAdmin** for easy database management.

### Installation

1. **Clone the Repository**
   ```bash
   git clone <repository-url>
   cd <repository-folder>
   ```

2. **Set Up XAMPP**
   - Start Apache and MySQL servers in XAMPP.
   - Open phpMyAdmin and create a new database (e.g., `nust_prg_competition`).

3. **Import Database**
   - Import the `.sql` file included in this repository to set up the database structure and tables.
   - Go to phpMyAdmin, select your database, and use the Import tab to upload the `.sql` file.

4. **Update Configuration**
   - Configure the database connection settings in the PHP files (e.g., `config.php`) to match your local setup.

5. **Run the Application**
   - Place the project folder in XAMPP’s `htdocs` directory.
   - Open a web browser and go to: `http://localhost/<repository-folder-name>`

---

## Features

- **Home Page**: Overview of Competition etc.
- **User Authentication**: Registration and login with secure sessions.
- **Task and Challenge Tracking**: View, add, update, and delete tasks/challenges with status options.
- **Resource Repository**: Access to resources relevant to the competition.
- **Notification System**: Real-time notifications for new updates or deadlines.
- **Admin Panel** (optional): Admin users can manage content, users, and resources.

---

## Usage

- **Register/Login**: Securely register or log in to access personalized features.
- **Task Management**: Create, edit, and update tasks with dynamic status tracking.
- **Resource Browsing**: Access available materials directly from the repository.
- **Notifications**: Stay updated with real-time notifications on important announcements.

---

## Screenshots

### Home Page
![image](https://github.com/user-attachments/assets/02ecd505-27e1-4d48-a29e-2abe3ddfd666)

### Admin Page
![image](https://github.com/user-attachments/assets/d997e1b5-7c0f-429f-9293-4bad0fa9e773)

---

## Technologies Used

- **Frontend**:
  - HTML, CSS: For layout and styling.
  - JavaScript (with optional jQuery): For interactivity and dynamic page content.

- **Backend**:
  - PHP: For server-side scripting and handling data interactions.
  - MySQL: For database management (with XAMPP as the local server).

- **Additional Tools**:
  - phpMyAdmin: For managing the database in XAMPP.
    
---

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

---
