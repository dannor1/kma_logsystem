<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch dashboard data
$stmt = $conn->prepare("SELECT 
    SUM(CASE WHEN file_process = 'incoming' THEN 1 ELSE 0 END) as incoming_files,
    SUM(CASE WHEN file_process = 'outgoing' THEN 1 ELSE 0 END) as outgoing_files,
    SUM(CASE WHEN file_process = 'pending' THEN 1 ELSE 0 END) as pending_files
    FROM files");
$stmt->execute();
$result = $stmt->get_result();
$dashboard_data = $result->fetch_assoc();

// Fetch recent activities
$stmt = $conn->prepare("SELECT f.subject, f.file_process, f.date_received, e.name as employee_name 
    FROM files f 
    JOIN employees e ON f.received_by = e.id 
    ORDER BY f.date_received DESC LIMIT 5");
$stmt->execute();
$recent_activities = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
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
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["assets/css/fonts.min.css"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
    <style>
        .dashboard-widgets {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }

        .widget {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
            position: relative;
            aria-label: "Widget";
        }

        .widget:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .widget-icon {
            font-size: 36px;
            color: #6861CE;
            aria-label: "Widget Icon";
        }

        .widget-info h3 {
            font-size: 24px;
            margin: 0;
            color: #333333;
        }

        .widget-info p {
            margin: 5px 0 0;
            color: #777777;
            font-size: 14px;
        }

        .recent-activities {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            position: relative;
            aria-label: "Recent Activities";
        }

        .recent-activities h4 {
            margin-bottom: 10px;
            font-size: 18px;
            color: #333333;
        }

        .recent-activities ul {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 300px;
            overflow-y: auto;
        }

        .recent-activities ul li {
            background-color: #f9fafb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555555;
            display: flex;
            align-items: center;
        }

        .recent-activities ul li::before {
            content: "•";
            color: #6861CE;
            font-size: 18px;
            margin-right: 10px;
        }

        .recent-activities ul li .timestamp {
            margin-left: auto;
            font-size: 12px;
            color: #999999;
        }

        .pie-chart {
            height: 300px;
        }

        /* Media Query for Responsive Design */
        @media (max-width: 800px) {
            .dashboard-widgets {
                grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            }
        }

        /* Add subtle animations */
        .fade-in {
            opacity: 0;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include("assets/inc/sidebar.php");?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.php" class="logo">
                            <img src="assets/img/logo_kma.png" alt="navbar brand" class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar" aria-label="Toggle Sidebar">
                                <i class="gg-menu-right" aria-hidden="true"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler" aria-label="Toggle Sidenav">
                                <i class="gg-menu-left" aria-hidden="true"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more" aria-label="More Options">
                            <i class="gg-more-vertical-alt" aria-hidden="true"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <?php include("assets/inc/navbar.php")?>
            </div>

            <div class="container">
                <div class="page-inner fade-in">
                    <div class="dashboard-widgets">
                        <div class="widget">
                            <div class="widget-icon" aria-label="Total Incoming Files Icon">
                                <i class="fas fa-arrow-down"></i>
                            </div>
                            <div class="widget-info">
                                <h3><?php echo $dashboard_data['incoming_files']; ?></h3>
                                <p>Total Incoming Files</p>
                            </div>
                        </div>

                        <div class="widget">
                            <div class="widget-icon" aria-label="Total Outgoing Files Icon">
                                <i class="fas fa-arrow-up"></i>
                            </div>
                            <div class="widget-info">
                                <h3><?php echo $dashboard_data['outgoing_files']; ?></h3>
                                <p>Total Outgoing Files</p>
                            </div>
                        </div>

                        <div class="widget">
                            <div class="widget-icon" aria-label="Pending Files Icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="widget-info">
                                <h3><?php echo $dashboard_data['pending_files']; ?></h3>
                                <p>Pending Files</p>
                            </div>
                        </div>

                        <div class="widget recent-activities">
                            <h4>Recent Activities</h4>
                            <ul>
                                <?php foreach ($recent_activities as $activity): ?>
                                    <li><?php echo htmlspecialchars($activity['subject']); ?> - <?php echo ucfirst($activity['file_process']); ?> 
                                        <span class="timestamp"><?php echo date('h:i A', strtotime($activity['date_received'])); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            <a href="files.php" class="btn btn-primary">View All</a>
                        </div>
                    </div> <!-- End of dashboard-widgets -->
                </div> <!-- End of page-inner -->
            </div> <!-- End of container -->
        </div> <!-- End of main-panel -->
    </div> <!-- End of wrapper -->

    <!-- Footer -->
    <?php include("assets/inc/footer.php")?>

    <!-- Core JS Files -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>

   <!-- Bootstrap Notify -->
   <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

  <!-- jQuery Vector Maps -->
  <script src="assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
  <script src="assets/js/plugin/jsvectormap/world.js"></script>

  <!-- Google Maps Plugin -->
  <script src="assets/js/plugin/gmaps/gmaps.js"></script>

  <!-- Sweet Alert -->
  <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

  <!-- Kaiadmin JS -->
  <script src="assets/js/kaiadmin.min.js"></script>
  </body>
  </html>


<!-- Sweet Alert -->
<script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>

<!-- Main JS -->
<script src="assets/js/kaiadmin.min.js"></script>

<script>
    // Add fade-in effect on page load
    document.addEventListener("DOMContentLoaded", function () {
        document.querySelectorAll('.fade-in').forEach(function (element) {
            element.classList.add('fade-in');
        });
    });
</script>

