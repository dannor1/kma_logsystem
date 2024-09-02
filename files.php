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
                          <!-- Sample Data -->
                          <tr data-file-process="incoming">
                            <td>1</td>
                            <td>2024</td>
                            <td>August</td>
                            <td>19/08/2024</td>
                            <td>10:30 AM</td>
                            <td>001</td>
                            <td>John Doe</td>
                            <td>18/08/2024</td>
                            <td>JD/001/2024</td>
                            <td>Admin</td>
                            <td>Official</td>
                            <td>Meeting Schedule</td>
                            <td>Incoming</td>
                            <td>
                            <button type="button" data-bs-toggle="tooltip" class="btn btn-link btn-primary btn-lg" title="View File">
                              <a href="assets/documents/Thinkpad_Yoga_460_Spec.pdf">  <i class="fa fa-eye"></i> </a>
                            </button>
                            </td>
                            <td>
                              <div class="form-button-action">
                                <button type="button" class="btn btn-link btn-primary btn-lg"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-link btn-danger"><i class="fa fa-times"></i></button>
                              </div>
                            </td>
                          </tr>
                          <!-- Repeat for more rows -->

                          <tr data-file-process="outgoing">
                            <td>2</td>
                            <td>2024</td>
                            <td>July</td>
                            <td>27/07/2024</td>
                            <td>4:20 AM</td>
                            <td>002</td>
                            <td>Simon Raad</td>
                            <td>18/07/2024</td>
                            <td>JD/001/2024</td>
                            <td>Paul</td>
                            <td>Official</td>
                            <td>Accounts</td>
                            <td>Outgoing</td>
                            <td>
                            <button type="button" data-bs-toggle="tooltip" class="btn btn-link btn-primary btn-lg" title="View File">
                              <a href="assets/documents/Thinkpad_Yoga_460_Spec.pdf">  <i class="fa fa-eye"></i> </a>
                            </button>
                            </td>
                            <td>
                              <div class="form-button-action">
                                <button type="button" class="btn btn-link btn-primary btn-lg"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-link btn-danger"><i class="fa fa-times"></i></button>
                              </div>
                            </td>
                          </tr>

                          <tr data-file-process="pending">
                            <td>3</td>
                            <td>2024</td>
                            <td>July</td>
                            <td>25/07/2024</td>
                            <td>10:30 AM</td>
                            <td>001</td>
                            <td>Richard</td>
                            <td>29/08/2024</td>
                            <td>JD/001/2024</td>
                            <td>Clerk</td>
                            <td>Official</td>
                            <td>Zonal</td>
                            <td>Pending</td>
                            <td>
                            <button type="button" data-bs-toggle="tooltip" class="btn btn-link btn-primary btn-lg" title="View File">
                                <i class="fa fa-eye"></i>
                            </button>
                            </td>
                            <td>
                              <div class="form-button-action">
                                <button type="button" class="btn btn-link btn-primary btn-lg"><i class="fa fa-edit"></i></button>
                                <button type="button" class="btn btn-link btn-danger"><i class="fa fa-times"></i></button>
                              </div>
                            </td> 
                          </tr></script>

                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php include("backend/inc/footer.php")?>
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
        let table = $("#fileTable").DataTable();

        // Filter based on file process
        $("#fileProcessFilter").on("change", function () {
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
