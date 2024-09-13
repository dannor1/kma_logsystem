# K.M.A Log System

![KMA Logo](assets/img/logo_kma.png)

The **Kumasi Metropolitan Assembly (K.M.A) Log System** is a secure and efficient web application designed to manage user logins and employee records. It is built using PHP, MySQL, and Bootstrap, providing a robust backend with a user-friendly frontend.

## Features

- **User Authentication**: Secure login with password verification.
- **Employee Management**: Add and manage employee records.
- **User Profile**: View and update user profile with a profile picture.
- **Responsive Design**: Fully responsive layout with Bootstrap.
- **Session Management**: Secure session handling for user data.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Folder Structure](#folder-structure)
- [Contributing](#contributing)
- [License](#license)

## Installation

1. **Clone the repository:**

    ```bash
    git clone https://github.com/your-username/kma-log-system.git
    ```

2. **Navigate to the project directory:**

    ```bash
    cd kma-log-system
    ```

3. **Set up your local server:**

    - Ensure you have [XAMPP](https://www.apachefriends.org/index.html) installed or any server stack with PHP and MySQL.
    - Place the project folder in the `htdocs` directory of your XAMPP installation.

4. **Import the database:**

    - Open [phpMyAdmin](http://localhost/phpmyadmin) in your browser.
    - Create a new database named `kma_log_system`.
    - Import the `kma_log_system.sql` file located in the `database` directory.

5. **Configure the database connection:**

    - Open `config.php` and update the database credentials to match your local setup.

    ```php
    <?php
    $conn = new mysqli('localhost', 'root', '', 'kma_log_system');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    ?>
    ```

6. **Run the application:**

    - Open your web browser and navigate to `http://localhost/kma-log-system`.

## Usage

- **Login:** Use the login form to sign in with your credentials.
- **Add Employee:** Navigate to the 'Add Employee' page to add new employee records.
- **View Profile:** Access the profile page to view and update your user information.

## Folder Structure

```plaintext
kma-log-system/
│
├── assets/                # CSS, JS, and image files
│   ├── css/
│   ├── img/
│   ├── js/
│
├── backend/               # Backend PHP files and logic
│   ├── inc/
│   ├── add_employee.php
│   ├── profile.php
│   ├── logout.php
│
├── database/              # Database SQL files
│   ├── kma_log_system.sql
│
├── config.php             # Database connection file
├── index.php              # Dashboard
├── login.php              # Login page
├── README.md              # Project documentation
└── .gitignore             # Git ignore file

Contributions are welcome! If you would like to contribute to this project, please follow these steps:

Fork the repository.
Create a new branch for your feature or bugfix.
Commit your changes.
Push to your fork.
Create a pull request.

Developed with ❤️ by the K.M.A IT Department.
