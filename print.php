<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Print Log - K.M.A Log System</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="assets/img/logo_kma.png" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: { families: ["Public Sans:300,400,500,600,700"] },
            custom: {
                families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"],
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
</head>
<body>
<div class="wrapper">
    <!-- Sidebar -->
    <?php include("assets/inc/sidebar.php");?>
    <!-- End Sidebar -->

    <div class="main-panel">
        <div class="main-header">
            <?php include("assets/inc/navbar.php");?>
        </div>

        <div class="container">
            <div class="page-inner">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h4 class="card-title">Print Log</h4>
                                </div>
                            </div>
                            <div class="card-body">
                                <!-- Search Section -->
                                <div class="form-group">
                                    <label for="logSearch">Search Log</label>
                                    <input type="text" id="logSearch" class="form-control" placeholder="Search by ID, Year, etc.">
                                </div>

                                <!-- Table for log details -->
                                <div class="table-responsive">
                                    <table id="logTable" class="display table table-striped table-hover">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Year</th>
                                            <th>Month</th>
                                            <th>Date Received</th>
                                            <th>Log Time</th>
                                            <th>Serial No</th>
                                            <th>From Whom Received</th>
                                            <th>Date of Letter</th>
                                            <th>Letter Ref No</th>
                                            <th>Received By</th>
                                            <th>Type of Letter</th>
                                            <th>Subject</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <!-- PHP code to fetch and display the log details -->
                                        <?php
                                        session_start();
                                        include 'config.php';

                                        if (!isset($_SESSION['user_id'])) {
                                            header("Location: login.php");
                                            exit();
                                        }

                                        if (!isset($_GET['id'])) {
                                            header("Location: files.php");
                                            exit();
                                        }

                                        $file_id = $_GET['id'];

                                        $stmt = $conn->prepare("SELECT f.*, d.name as department_name, e.name as received_by_name FROM files f LEFT JOIN departments d ON f.department_id = d.id LEFT JOIN employees e ON f.received_by = e.id WHERE f.id = ?");
                                        $stmt->bind_param("i", $file_id);
                                        $stmt->execute();
                                        $file = $stmt->get_result()->fetch_assoc();
                                        $stmt->close();

                                        if (!$file) {
                                            header("Location: files.php");
                                            exit();
                                        }

                                        $conn->close();
                                        ?>

                                        <tr data-attached-file='<?php echo $file['attached_file']; ?>'>
                                            <td><?php echo $file['id']; ?></td>
                                            <td><?php echo $file['year']; ?></td>
                                            <td><?php echo $file['month']; ?></td>
                                            <td><?php echo $file['date_received']; ?></td>
                                            <td><?php echo $file['log_time']; ?></td>
                                            <td><?php echo $file['serial_no']; ?></td>
                                            <td><?php echo $file['from_whom_received']; ?></td>
                                            <td><?php echo $file['date_of_letter']; ?></td>
                                            <td><?php echo $file['letter_ref_no']; ?></td>
                                            <td><?php echo $file['received_by_name']; ?></td>
                                            <td><?php echo $file['type_of_letter']; ?></td>
                                            <td><?php echo $file['subject']; ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Print Button -->
                                <div class="form-group text-center">
                                    <button id="printButton" class="btn btn-primary">Print</button>
                                </div>

                                <!-- Attached File Display -->
                                <div id="attachedFileDisplay" class="form-group text-center" style="display: none;">
                                    <h5>Attached File:</h5>
                                    <a id="attachedFileLink" href="#" target="_blank">View Attached File</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include("assets/inc/footer.php");?>
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
    $(document).ready(function () {
        // Initialize DataTable
        let table = $("#logTable").DataTable();

        // Search functionality
        $("#logSearch").on("keyup", function () {
            table.search($(this).val()).draw();
        });

        // Handle print button click
        $("#printButton").on("click", function () {
            let selectedRow = table.row({ selected: true }).data();
            if (selectedRow) {
                // Show print confirmation
                alert("Preparing to print the log...");

                // Here you would integrate the actual PDF generation and printing
                // This is just a placeholder for front-end logic

                // Display attached file if available
                let attachedFile = selectedRow[12]; // Assuming attached file is in the 13th column
                if (attachedFile) {
                    $("#attachedFileDisplay").show();
                    $("#attachedFileLink").attr("href", attachedFile);
                }
            } else {
                alert("Please select a log to print.");
            }
        });

        // Handle row selection for printing
        $('#logTable tbody').on('click', 'tr', function () {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });
    });
</script>
</body>
</html>
