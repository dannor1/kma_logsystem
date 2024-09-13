<?php
// Start the session at the very beginning of the script
session_start();

// Include any necessary files
include 'config.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Rest of your PHP code here
$user_id = $_SESSION['user_id'];

// ... (rest of your PHP logic)

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Viiew Log - K.M.A Log System</title>
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
            families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
                "simple-line-icons"
            ],
            urls: ["assets/css/fonts.min.css"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
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
                    <!-- End Logo Header -->
                </div>
                <?php include("assets/inc/navbar.php")?>
            </div>

            <div class="container">
                <div class="page-inner">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h4 class="card-title">Files</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <!-- Filter Section -->
                                    <div class="form-group">
                                        <label for="fileProcessFilter">Filter by File Process</label>
                                        <select id="fileProcessFilter" class="form-select">
                                            <option value="all">All</option>
                                            <option value="incoming">Incoming</option>
                                            <option value="outgoing">Outgoing</option>
                                            <option value="pending">Pending</option>
                                        </select>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="fileTable" class="display table table-striped table-hover">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Year</th>
                                                    <th>Month</th>
                                                    <th>Date Received</th>
                                                    <th>Department</th>
                                                    <th>Log Time</th>
                                                    <th>Serial No</th>
                                                    <th>From Whom Received</th>
                                                    <th>Date of Letter</th>
                                                    <th>Letter Ref No</th>
                                                    <th>Received By</th>
                                                    <th>Type of Letter</th>
                                                    <th>Subject</th>
                                                    <th>File Process</th>
                                                    <th>Attached File</th>
                                                    <th style="width: 10%">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                           
                                             
                                                $search = isset($_GET['search']) ? $_GET['search'] : '';

                                                if (!empty($search)) {
                                                    $stmt = $conn->prepare("SELECT f.*, d.name as department_name, e.name as received_by_name 
                                                                                        FROM files f 
                                                                                        LEFT JOIN departments d ON f.department_id = d.id 
                                                                                        LEFT JOIN employees e ON f.received_by = e.id 
                                                                                        WHERE f.subject LIKE ? OR f.from_whom_received LIKE ? OR f.letter_ref_no LIKE ?");
                                                    $search_param = "%$search%";
                                                    $stmt->bind_param("sss", $search_param, $search_param, $search_param);
                                                } else {
                                                    $stmt = $conn->prepare("SELECT f.*, d.name as department_name, e.name as received_by_name 
                                                                                        FROM files f 
                                                                                        LEFT JOIN departments d ON f.department_id = d.id 
                                                                                        LEFT JOIN employees e ON f.received_by = e.id");
                                                }

                                                $stmt->execute();
                                                $files = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                                                $stmt->close();

                                                foreach ($files as $file): ?>
                                                <tr data-file-process="<?= $file['file_process'] ?>">
                                                    <td><?= $file['id'] ?></td>
                                                    <td><?= $file['year'] ?></td>
                                                    <td><?= $file['month'] ?></td>
                                                    <td><?= $file['date_received'] ?></td>
                                                    <td><?= $file['department_name'] ?></td>
                                                    <td><?= $file['log_time'] ?></td>
                                                    <td><?= $file['serial_no'] ?></td>
                                                    <td><?= $file['from_whom_received'] ?></td>
                                                    <td><?= $file['date_of_letter'] ?></td>
                                                    <td><?= $file['letter_ref_no'] ?></td>
                                                    <td><?= $file['received_by_name'] ?></td>
                                                    <td><?= $file['type_of_letter'] ?></td>
                                                    <td><?= $file['subject'] ?></td>
                                                    <td><?= $file['file_process'] ?></td>
                                                    <td>
                                                        <?php if ($file['attached_file']): ?>
                                                        <a href="<?php echo $file['attached_file']; ?>" target="_blank"
                                                            class="btn btn-sm btn-primary">View</a>
                                                        <?php else: ?>
                                                        No file
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <a href="viewfile.php?id=<?php echo $file['id']; ?>"
                                                            class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>
                                                        <?php if ($_SESSION['is_admin']): ?>
                                                        <a href="edit_file.php?file_id=<?php echo $file['id']; ?>"
                                                            class="btn btn-sm btn-warning"><i
                                                                class="fa fa-edit"></i></a>
                                                        <a href="delete_file.php?id=<?php echo $file['id']; ?>"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this file?');"><i
                                                                class="fa fa-trash"></i></a>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include("assets/inc/footer.php")?>
            </div>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <!-- Datatables -->
    <script src="assets/js/plugin/datatables/datatables.min.js"></script>
    <!-- Kaiadmin JS -->
    <script src="assets/js/kaiadmin.min.js"></script>

    <script>
    $(document).ready(function() {
        // Initialize DataTable
        let table = $("#fileTable").DataTable();

        // Filter based on file process
        $("#fileProcessFilter").on("change", function() {
            let selectedValue = $(this).val();
            if (selectedValue === "all") {
                table.columns(12).search("").draw();
            } else {
                table.columns(12).search(selectedValue, true, false).draw();
            }
        });
    });
    </script>
</body>

</html>