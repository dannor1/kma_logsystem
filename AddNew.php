<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Add Log - K.M.A Log System</title>
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
          urls: ["../assets/css/fonts.min.css"],
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
      .form-section {
        padding: 20px;
        background-color: #f8f9fa;
        margin: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .form-section h3 {
        font-weight: bold;
        margin-bottom: 20px;
      }

      .form-group {
        margin-bottom: 15px;
      }

      .form-group label {
        font-weight: 600;
      }

      .form-control {
        border-radius: 4px;
        border: 1px solid #ced4da;
      }

      .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
      }

      .btn-primary {
        background-color: #007bff;
        border-color: #1a2035;
      }

      .btn-primary:hover {
        background-color: #6861CE;
        border-color: #004085;
      }

      .form-row {
        margin: 0 -15px;
      }

      .form-col {
        padding: 0 15px;
      }

      .btn-submit {
        display: block;
        width: 100%;
        margin-top: 20px;
        background-color: #6861CE;
        color: #fff;
        border: none;
        padding: 10px;
        font-size: 16px;
        border-radius: 4px;
      }

      .btn-submit:hover {
        background-color: #1A2035;
      }

      /* footer {
        margin-top: 20px;
      } */

      .content {
        margin-top: 80px; /* Adjust this value according to the height of your navbar */
      }   
    </style>
  </head>
  <body>
    <div class="wrapper">
      <!-- Sidebar -->
      <?php include("backend/inc/sidebar.php");?>
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
          <?php include("backend/inc/navbar.php")?>
        </div>

        <div class="content">
          <div class="form-section">
            <!-- Form Columns -->
            <div class="container">
              <div class="row">
                <!-- First Column -->
                <div class="col-md-6">
                  <div class="white-box">
                    <h3 class="box-title">Record Details</h3>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                      <div class="mb-3">
                        <label for="year" class="form-label">Year:</label>
                        <input type="number" class="form-control" id="year" placeholder="Enter year">
                      </div>
                      <div class="mb-3">
                        <label for="defaultSelect">Month:</label>
                        <select class="form-select form-control" id="defaultSelect">
                          <option>January</option>
                          <option>February</option>
                          <option>March</option>
                          <option>April</option>
                          <option>May</option>
                          <option>June</option>
                          <option>July</option>
                          <option>August</option>
                          <option>September</option>
                          <option>October</option>
                          <option>November</option>
                          <option>December</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="dateReceived" class="form-label">Date Received:</label>
                        <input type="date" class="form-control" id="dateReceived">
                      </div>
                      <div class="mb-3">
                        <label for="logTime" class="form-label">Log Time:</label>
                        <input type="time" class="form-control" id="logTime">
                      </div>
                      <div class="mb-3">
                        <label for="serialNo" class="form-label">Serial No.:</label>
                        <input type="text" class="form-control" id="serialNo" placeholder="Enter serial number">
                      </div>
                      <div class="mb-3">
                        <label for="defaultSelect">Department</label>
                        <select class="form-select form-control" id="defaultSelect">
                          <option>Budget</option>
                          <option>Metro Chief Executive's Office</option>
                          <option>Metro Coordinating Director</option>
                          <option>Planning</option>
                          <option>Records</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="letterFile">Attach File</label>
                        <input type="file" class="form-control-file" id="letterFile" name="letterFile" accept=".pdf,.doc,.docx,.txt">
                      </div>
                      <!-- Centered Submit Button -->
                      <button type="submit" class="btn-submit">Submit</button>
                    </form>
                  </div>
                </div>

                <!-- Second Column -->
                <div class="col-md-6">
                  <div class="white-box">
                    <h3 class="box-title">Additional Details</h3>
                    <form>
                      <div class="mb-3">
                        <label for="fromWhomReceived" class="form-label">From Whom Received:</label>
                        <input type="text" class="form-control" id="fromWhomReceived" placeholder="Enter from whom received">
                      </div>
                      <div class="mb-3">
                        <label for="dateOfLetter" class="form-label">Date of Letter:</label>
                        <input type="date" class="form-control" id="dateOfLetter">
                      </div>
                      <div class="mb-3">
                        <label for="letterRefNo" class="form-label">Letter Ref. No:</label>
                        <input type="text" class="form-control" id="letterRefNo" placeholder="Enter letter reference number">
                      </div>
                      <div class="mb-3">
                        <label for="receivedBy" class="form-label">Received By:</label>
                        <input type="text" class="form-control" id="receivedBy" placeholder="Enter received by">
                      </div>
                      <div class="mb-3">
                        <label for="typeOfLetter" class="form-label">Type of Letter</label>
                        <select class="form-select form-control" id="typeOfLetter">
                          <option>Official</option>
                          <option>Unofficial</option>
                          <option>Dispatched</option>
                          <option>Income</option>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="subject" class="form-label">Subject:</label>
                        <input type="text" class="form-control" id="subject" placeholder="Enter subject">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
     
        <!-- Footer -->
        <?php include("backend/inc/footer.php")?>
        <!-- End Footer -->


    <!-- Core JS Files -->
    <script src="assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="assets/js/kaiadmin.min.js"></script>
  </body>
</html>
