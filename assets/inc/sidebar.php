<?php


// Rest of your PHP code

ob_end_flush(); // End output buffering and send output
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>K.M.A Log System</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="assets/img/logo_kma.png" type="image/x-icon" />

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

    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/css/plugins.min.css" />
    <link rel="stylesheet" href="../assets/css/kaiadmin.min.css" />

</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="index.php" class="logo">
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
            </div>
            <!-- End Logo Header -->
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item <?php if($current_page == 'index.php'){ echo 'active'; } ?>">
                            <a href="index.php">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <li class="nav-item <?php if($current_page == 'profile.php'){ echo 'active'; } ?>">
                            <a href="profile.php">
                                <i class="fas fa-user"></i>
                                <p>Profile</p>
                            </a>
                        </li>

                        <li class="nav-item <?php if($current_page == 'AddNew.php'){ echo 'active'; } ?>">
                            <a href="AddNew.php">
                                <i class="fas fa-plus-square"></i>
                                <p>New Log</p>
                            </a>
                        </li>

                        <li class="nav-item <?php if($current_page == 'files.php'){ echo 'active'; } ?>">
                            <a href="files.php">
                                <i class="fas fa-file-alt"></i>
                                <p>View Log</p>
                            </a>
                        </li>

                        <!-- <li class="nav-item <?php if($current_page == 'print.php'){ echo 'active'; } ?>">
                            <a href="print.php">
                                <i class="fas fa-print"></i>
                                <p>Print Log</p>
                            </a>
                        </li> -->
                        <!-- <?php if ($_SESSION['is_admin']): ?>
                        <li class="nav-item">
                            <a href="add_employee.php">
                                <i class="fas fa-user-plus"></i>
                                <p>Add Employee</p>
                            </a>
                        </li>
                        <?php endif; ?> -->

                    </ul>

                </div>
            </div>
        </div>
        <!-- End Sidebar -->
</body>
<style>
.nav-item {
    transition: transform 0.2s ease-in-out;
}

.nav-item:hover {
    transform: translateX(5px);
    /* Moves the item slightly to the right */
}

.nav-item.active {
    background-color: #1a2035;
    /* Adjust this color as per your theme */
    font-weight: bold;
}

.nav-item.active a {
    color: #ffffff;
    /* Ensures active page text is visible */
}
</style>