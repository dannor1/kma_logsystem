<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Add Employee - K.M.A Log System</title>
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
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/plugins.min.css" />
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css" />
</head>

<body>
    <div class="wrapper d-flex flex-column min-vh-100">
        <?php include("assets/inc/sidebar.php");?>

        <!-- Navbar -->
        <?php include("assets/inc/navbar.php"); ?>
        <!-- End Navbar -->

        <div class="container flex-grow-1 d-flex align-items-center justify-content-center">
            <div class="page-inner w-100">
                <h2 class="page-title mt-4 text-center">Add New Employee</h2>
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <!-- Card Header -->
                            <div class="card-header" style="background-color: #6861CE; color: #fff;">
                                Employee's Registration
                            </div>
                            <div class="card-body">
                                <form action="process_add_employee.php" method="POST">
                                    <div class="form-group">
                                        <label for="staff_id">Staff ID</label>
                                        <input type="text" class="form-control" id="staff_id" name="staff_id"
                                            placeholder="Enter staff ID" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            placeholder="Enter employee's full name" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="department">Department</label>
                                        <select class="form-control" id="department" name="department" required>
                                            <option value="">Select Department</option>
                                            <option value="Budget">Budget</option>
                                            <option value="Metro Chief Executive's Office">Metro Chief Executive's
                                                Office</option>
                                            <option value="Metro Coordinating Director">Metro Coordinating Director
                                            </option>
                                            <option value="Planning">Planning</option>
                                            <option value="Records">Records</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            placeholder="Enter phone number" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="Enter email address" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="position">Position</label>
                                        <input type="text" class="form-control" id="position" name="position"
                                            placeholder="Enter position" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="date_of_birth">Date of Birth</label>
                                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="hire_date">Hire Date</label>
                                        <input type="date" class="form-control" id="hire_date" name="hire_date"
                                            required />
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password"
                                            required />
                                    </div>
                                    <button type="submit" class="btn btn-add-employee"
                                        style="background-color: #6861CE; border-color: #6861CE; color: #fff;">
                                        Add Employee
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
            </div>
        </div>
    </div>

    <!-- Core JS Files -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>

    <!-- Additional JS Files -->
    <script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
    <script src="assets/js/plugin/sweetalert/sweetalert.min.js"></script>
    <script src="assets/js/kaiadmin.min.js"></script>

    <style>
    .wrapper {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .container {
        flex-grow: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .page-inner {
        width: 100%;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    </style>
</body>

</html>