<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT e.*, d.name as department_name FROM employees e LEFT JOIN departments d ON e.department_id = d.id WHERE e.id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - K.M.A Log System</title>
    <link rel="icon" href="assets/img/logo_kma.png" type="image/x-icon">

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["assets/css/fonts.min.css"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
    </script>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css">

    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f4f4f4;
    }

    .profile-container {
        max-width: 1200px;
        margin: 50px auto;
        background: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .profile-header {
        background: #6861CE;
        color: #fff;
        padding: 30px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .profile-header img {
        border-radius: 50%;
        height: 120px;
        width: 120px;
        object-fit: cover;
        border: 4px solid #fff;
    }

    .profile-header .profile-name {
        font-size: 24px;
        font-weight: 600;
    }

    .profile-header .profile-role {
        font-size: 16px;
        color: #ddd;
    }

    .profile-content {
        padding: 30px;
    }

    .profile-tabs {
        border-bottom: 2px solid #ddd;
        margin-bottom: 20px;
    }

    .profile-tabs a {
        padding: 10px 20px;
        display: inline-block;
        color: #555;
        font-weight: 500;
        border-bottom: 2px solid transparent;
        text-decoration: none;
    }

    .profile-tabs a.active {
        color: #4e54c8;
        border-bottom-color: #4e54c8;
    }

    .profile-info {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 20px;
    }

    .profile-info .info-group {
        margin-bottom: 20px;
    }

    .profile-info .info-group label {
        font-weight: 500;
        color: #777;
    }

    .profile-info .info-group p,
    .profile-info .info-group input {
        font-size: 16px;
        color: #333;
        margin: 5px 0 0;
        border: none;
        background: transparent;
        outline: none;
    }

    .profile-info .info-group input {
        width: 100%;
        padding: 5px;
        background: #f4f4f4;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    .profile-buttons {
        text-align: right;
    }

    .profile-buttons .btn {
        padding: 10px 30px;
        font-size: 16px;
        border-radius: 30px;
    }

    .btn-primary {
        background: #4e54c8;
        border: none;
    }

    .btn-primary:hover {
        background: #3c43b3;
    }

    .btn-secondary {
        background: #ddd;
        border: none;
        color: #333;
    }

    .btn-secondary:hover {
        background: #ccc;
    }

    .pencil-icon {
        font-size: 24px;
        color: #fff;
        cursor: pointer;
        display: block;
        margin-top: 10px;
    }
    </style>
</head>

<body>
    <div class="wrapper">
        <?php include("assets/inc/sidebar.php");?>
        <div class="main-panel">
            <?php include("assets/inc/navbar.php");?>

            <div class="profile-container">
                <div class="profile-header">
                    <div>
                        <img id="profileImage" src="assets/img/profile.png" alt="Profile Image">
                        <input type="file" id="fileInput" style="display: none;" accept="image/*">
                        <i id="editImageBtn" class="fas fa-pencil-alt pencil-icon"
                            onclick="document.getElementById('fileInput').click();"></i>
                        <div class="profile-info">
                            <div class="profile-name"><?php echo $user['name']; ?></div>
                            <div class="profile-role"><?php echo $user['is_admin'] ? 'Administrator' : 'Employee'; ?>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button id="editProfileBtn" class="btn btn-primary">Edit Profile</button>
                    </div>
                </div>

                <div class="profile-content">
                    <div class="profile-tabs">
                        <a href="#" class="active">Profile Information</a>
                    </div>

                    <div class="profile-info">
                        <div class="info-group">
                            <label for="fullName">Full Name</label>
                            <p id="fullNameText"><?php echo $user['name']; ?></p>
                            <input id="fullNameInput" type="text" value="<?php echo $user['name']; ?>"
                                style="display: none;">
                        </div>
                        <div class="info-group">
                            <label for="email">Email Address</label>
                            <p id="emailText"><?php echo $user['email']; ?></p>
                            <input id="emailInput" type="email" value="<?php echo $user['email']; ?>"
                                style="display: none;">
                        </div>
                        <div class="info-group">
                            <label for="phone">Phone Number</label>
                            <p id="phoneText"><?php echo $user['phone']; ?></p>
                            <input id="phoneInput" type="text" value="<?php echo $user['phone']; ?>"
                                style="display: none;">
                        </div>
                        <div class="info-group">
                            <label for="address">Address</label>
                            <p id="addressText">123 Main Street, City</p>
                            <input id="addressInput" type="text" value="123 Main Street, City" style="display: none;">
                        </div>

                        <!-- Added employee registration details -->
                        <div class="info-group">
                            <label for="department">Department</label>
                            <p id="departmentText"><?php echo $user['department_name']; ?></p>
                            <input id="departmentInput" type="text" value="<?php echo $user['department_name']; ?>"
                                style="display: none;">
                        </div>
                        <div class="info-group">
                            <label for="position">Position</label>
                            <p id="positionText"><?php echo $user['position']; ?></p>
                            <input id="positionInput" type="text" value="<?php echo $user['position']; ?>"
                                style="display: none;">
                        </div>
                        <div class="info-group">
                            <label for="dateOfBirth">Date of Birth</label>
                            <p id="dobText"><?php echo $user['date_of_birth']; ?></p>
                            <input id="dobInput" type="date" value="<?php echo $user['date_of_birth']; ?>"
                                style="display: none;">
                        </div>
                        <div class="info-group">
                            <label for="hireDate">Hire Date</label>
                            <p id="hireDateText"><?php echo $user['hire_date']; ?></p>
                            <input id="hireDateInput" type="date" value="<?php echo $user['hire_date']; ?>"
                                style="display: none;">
                        </div>
                    </div>

                    <div class="profile-buttons">
                        <button id="saveBtn" class="btn btn-primary" style="display: none;">Save Changes</button>
                        <button id="cancelBtn" class="btn btn-secondary" style="display: none;">Cancel</button>
                    </div>
                </div>

            </div>
            <?php include("assets/inc/footer.php");?>
        </div>

    </div>


    <!-- Core JS Files -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/kaiadmin.min.js"></script>

    <script>
    document.getElementById('editProfileBtn').addEventListener('click', function() {
        document.getElementById('fullNameText').style.display = 'none';
        document.getElementById('emailText').style.display = 'none';
        document.getElementById('phoneText').style.display = 'none';
        document.getElementById('addressText').style.display = 'none';

        document.getElementById('fullNameInput').style.display = 'block';
        document.getElementById('emailInput').style.display = 'block';
        document.getElementById('phoneInput').style.display = 'block';
        document.getElementById('addressInput').style.display = 'block';

        document.getElementById('editProfileBtn').style.display = 'none';
        document.getElementById('saveBtn').style.display = 'inline-block';
        document.getElementById('cancelBtn').style.display = 'inline-block';

        // Additional fields for employee registration
        document.getElementById('departmentText').style.display = 'none';
        document.getElementById('positionText').style.display = 'none';
        document.getElementById('dobText').style.display = 'none';
        document.getElementById('hireDateText').style.display = 'none';

        document.getElementById('departmentInput').style.display = 'block';
        document.getElementById('positionInput').style.display = 'block';
        document.getElementById('dobInput').style.display = 'block';
        document.getElementById('hireDateInput').style.display = 'block';
    });

    document.getElementById('cancelBtn').addEventListener('click', function() {
        document.getElementById('fullNameText').style.display = 'block';
        document.getElementById('emailText').style.display = 'block';
        document.getElementById('phoneText').style.display = 'block';
        document.getElementById('addressText').style.display = 'block';

        document.getElementById('fullNameInput').style.display = 'none';
        document.getElementById('emailInput').style.display = 'none';
        document.getElementById('phoneInput').style.display = 'none';
        document.getElementById('addressInput').style.display = 'none';

        document.getElementById('editProfileBtn').style.display = 'inline-block';
        document.getElementById('saveBtn').style.display = 'none';
        document.getElementById('cancelBtn').style.display = 'none';

        // Additional fields for employee registration
        document.getElementById('departmentText').style.display = 'block';
        document.getElementById('positionText').style.display = 'block';
        document.getElementById('dobText').style.display = 'block';
        document.getElementById('hireDateText').style.display = 'block';

        document.getElementById('departmentInput').style.display = 'none';
        document.getElementById('positionInput').style.display = 'none';
        document.getElementById('dobInput').style.display = 'none';
        document.getElementById('hireDateInput').style.display = 'none';
    });

    document.getElementById('fileInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileImage').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
    </script>
</body>

</html>