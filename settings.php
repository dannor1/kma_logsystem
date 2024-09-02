<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - K.M.A Log System</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/kaiadmin.min.css">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <?php include('backend/inc/sidebar.php'); ?>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="content">
                <div class="container-fluid">
                    <div class="page-header">
                        <h4 class="page-title">Settings</h4>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Account Settings</h5>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="form-group">
                                    <label for="currentPassword">Current Password</label>
                                    <input type="password" class="form-control" id="currentPassword">
                                </div>
                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <input type="password" class="form-control" id="newPassword">
                                </div>
                                <div class="form-group">
                                    <label for="confirmPassword">Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('backend/inc/footer.php'); ?>
        </div>
    </div>
</body>
</html>
