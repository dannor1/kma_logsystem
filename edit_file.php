<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_GET['file_id'])) {
    $_SESSION['file_edit_error'] = "No file selected for editing.";
    header("Location: files.php");
    exit();
}

$file_id = $_GET['file_id'];

// Fetch the file details
$stmt = $conn->prepare("SELECT * FROM files WHERE id = ?");
$stmt->bind_param("i", $file_id);
$stmt->execute();
$file = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$file) {
    $_SESSION['file_edit_error'] = "File not found.";
    header("Location: files.php");
    exit();
}

// Fetch departments
$stmt = $conn->prepare("SELECT id, name FROM departments");
$stmt->execute();
$departments = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form submission
    $year = !empty($_POST['year']) ? $_POST['year'] : null;
    $month = !empty($_POST['month']) ? $_POST['month'] : null;
    $date_received = !empty($_POST['date_received']) ? $_POST['date_received'] : null;
    $log_time = !empty($_POST['log_time']) ? $_POST['log_time'] : null;
    $serial_no = !empty($_POST['serial_no']) ? $_POST['serial_no'] : null;
    $from_whom_received = !empty($_POST['from_whom_received']) ? $_POST['from_whom_received'] : null;
    $date_of_letter = !empty($_POST['date_of_letter']) ? $_POST['date_of_letter'] : null;
    $letter_ref_no = !empty($_POST['letter_ref_no']) ? $_POST['letter_ref_no'] : null;
    $type_of_letter = !empty($_POST['type_of_letter']) ? $_POST['type_of_letter'] : null;
    $subject = !empty($_POST['subject']) ? $_POST['subject'] : null;
    $file_process = !empty($_POST['file_process']) ? $_POST['file_process'] : null;
    $department_id = !empty($_POST['department_id']) ? $_POST['department_id'] : null;

    // Handle file upload
    $attached_file = $file['attached_file'];
    if (isset($_FILES['attached_file']) && $_FILES['attached_file']['error'] == 0) {
        $target_dir = "uploads/";
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $target_file = $target_dir . basename($_FILES["attached_file"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check file size
        if ($_FILES["attached_file"]["size"] > 5000000) {
            $_SESSION['file_error'] = "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        $allowed_extensions = array("jpg", "jpeg", "png", "gif", "pdf", "doc", "docx");
        if (!in_array($imageFileType, $allowed_extensions)) {
            $_SESSION['file_error'] = "Sorry, only JPG, JPEG, PNG, GIF, PDF, DOC & DOCX files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $_SESSION['file_error'] = "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["attached_file"]["tmp_name"], $target_file)) {
                $attached_file = $target_file;
            } else {
                $_SESSION['file_error'] = "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Check if all required fields are filled
    $required_fields = [$year, $month, $date_received, $log_time, $serial_no, $from_whom_received, $date_of_letter, $letter_ref_no, $type_of_letter, $subject, $file_process, $department_id];
    $all_fields_filled = !in_array(null, $required_fields, true);

    if ($all_fields_filled) {
        $stmt = $conn->prepare("UPDATE files SET year = ?, month = ?, date_received = ?, log_time = ?, serial_no = ?, from_whom_received = ?, date_of_letter = ?, letter_ref_no = ?, received_by = ?, type_of_letter = ?, subject = ?, file_process = ?, attached_file = ?, department_id = ? WHERE id = ?");
        $stmt->bind_param("issssssssssssii", $year, $month, $date_received, $log_time, $serial_no, $from_whom_received, $date_of_letter, $letter_ref_no, $user_id, $type_of_letter, $subject, $file_process, $attached_file, $department_id, $file_id);

        if ($stmt->execute()) {
            $_SESSION['file_edit_success'] = "File updated successfully";
            header("Location: files.php");
            exit();
        } else {
            $_SESSION['file_edit_error'] = "Error updating file: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['file_edit_error'] = "Please fill all required fields.";
    }
}

$conn->close();
?>

<!-- HTML form for editing a log entry -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Edit Log - K.M.A Log System</title>
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
            urls: ["../assets/css/fonts.min.css"],
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

    <style>
    /* Add your custom styles here */
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
                    <div class="logo-header" data-background-color="dark">
                        <a href="index.php" class="logo">
                            <img src="assets/img/logo_kma.png" alt="navbar brand" class="navbar-brand" height="20" />
                        </a>
                    </div>
                </div>
                <?php include("assets/inc/navbar.php")?>
            </div>

            <div class="content">
                <div class="form-section">
                    <!-- Form Columns -->
                    <div class="container">
                        <form action="<?php echo $_SERVER['PHP_SELF'] . '?file_id=' . $file_id; ?>" method="post"
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <h3>Edit File</h3>
                                    <?php
                                    if (isset($_SESSION['file_edit_error'])) {
                                        echo '<div class="alert alert-danger">' . $_SESSION['file_edit_error'] . '</div>';
                                        unset($_SESSION['file_edit_error']);
                                    }
                                    if (isset($_SESSION['file_error'])) {
                                        echo '<div class="alert alert-danger">' . $_SESSION['file_error'] . '</div>';
                                        unset($_SESSION['file_error']);
                                    }
                                    ?>
                                    <div class="mb-3">
                                        <label for="year" class="form-label">Year:</label>
                                        <input type="number" class="form-control" id="year" name="year"
                                            value="<?php echo $file['year']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="month" class="form-label">Month:</label>
                                        <select class="form-select form-control" id="month" name="month" required>
                                            <option value="">Select Month</option>
                                            <option value="January"
                                                <?php if($file['month'] == 'January') echo 'selected'; ?>>January
                                            </option>
                                            <!-- Add other months similarly -->
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date_received" class="form-label">Date Received:</label>
                                        <input type="date" class="form-control" id="date_received" name="date_received"
                                            value="<?php echo $file['date_received']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="log_time" class="form-label">Log Time:</label>
                                        <input type="time" class="form-control" id="log_time" name="log_time"
                                            value="<?php echo $file['log_time']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="serial_no" class="form-label">Serial Number:</label>
                                        <input type="text" class="form-control" id="serial_no" name="serial_no"
                                            value="<?php echo $file['serial_no']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="from_whom_received" class="form-label">From Whom Received:</label>
                                        <input type="text" class="form-control" id="from_whom_received"
                                            name="from_whom_received" value="<?php echo $file['from_whom_received']; ?>"
                                            required>
                                    </div>
                                    <!-- Add other form fields similarly -->
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="letter_ref_no" class="form-label">Letter Ref No:</label>
                                        <input type="text" class="form-control" id="letter_ref_no" name="letter_ref_no"
                                            value="<?php echo $file['letter_ref_no']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="type_of_letter" class="form-label">Type of Letter:</label>
                                        <input type="text" class="form-control" id="type_of_letter"
                                            name="type_of_letter" value="<?php echo $file['type_of_letter']; ?>"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="subject" class="form-label">Subject:</label>
                                        <input type="text" class="form-control" id="subject" name="subject"
                                            value="<?php echo $file['subject']; ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="file_process" class="form-label">File Process:</label>
                                        <textarea class="form-control" id="file_process" name="file_process"
                                            required><?php echo $file['file_process']; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="attached_file" class="form-label">Attached File:</label>
                                        <input type="file" class="form-control" id="attached_file" name="attached_file">
                                        <?php if ($file['attached_file']): ?>
                                        <p>Current file: <a href="<?php echo $file['attached_file']; ?>"
                                                target="_blank">View File</a></p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="mb-3">
                                        <label for="department_id" class="form-label">Department:</label>
                                        <select class="form-control" id="department_id" name="department_id" required>
                                            <option value="">Select Department</option>
                                            <?php foreach ($departments as $dept): ?>
                                            <option value="<?php echo $dept['id']; ?>"
                                                <?php if($file['department_id'] == $dept['id']) echo 'selected'; ?>>
                                                <?php echo $dept['name']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update File</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php include("assets/inc/footer.php"); ?>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="assets/js/core/jquery.3.2.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <!-- Additional JS -->
</body>

</html>