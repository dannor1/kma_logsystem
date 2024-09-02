<!-- Navbar Header -->
<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
    <div class="container-fluid">
        <div class="d-flex align-items-center w-100 justify-content-between">

            <!-- Centered Title and Subtitle with logos -->
            <div class="d-flex align-items-center justify-content-center w-100" style="margin-right: -500px;">
                <img src="assets/img/logo_kma.png" alt="Logo 1" class="navbar-logo">
                <div class="navbar-title-container mx-2">
                    <h1 class="navbar-title">Kumasi Metropolitan Assembly</h1>
                    <h4 class="navbar-subtitle">LOG SYSTEM</h4>
                </div>
                <img src="assets/img/coat_of.png" alt="Logo 2" class="navbar-logo">
            </div>

            <!-- User Profile -->
            <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
            <li class="nav-item topbar-user dropdown hidden-caret">
                  <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
                    <div class="avatar-sm">
                      <img src="assets/img/profile.png" alt="..." class="avatar-img rounded-circle" />
                    </div>
                   
                    
                    <span class="profile-username">
                      <span class="op-7" >Hi,</span>
                      <span class="fw-bold">Admin</span>
                    </span>
                  </a>
                  <ul class="dropdown-menu dropdown-user animated fadeIn">
                    <div class="dropdown-user-scroll scrollbar-outer">
                      <li>
                        <div class="user-box">
                          <div class="avatar-lg">
                            <img src="assets/img/profile.png" alt="image profile" class="avatar-img rounded" />
                          </div>
                          <div class="u-text">
                            <h4>Admin</h4>
                            <p class="text-muted">example@kma.gov.gh</p>
                            <a href="profile.php" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#"></i>Logout</a>
                      </li>
                    </div>
                  </ul>
                </li>
              </ul>
            </div>
</nav>
<!-- End Navbar -->

<style>
    .navbar {
        position: fixed; /* Keeps the navbar fixed at the top */
        top: 0; /* Aligns the navbar at the very top of the viewport */
        left: 0;
        width: 100%; /* Ensures the navbar spans the full width */
        z-index: 1000; /* Ensures the navbar is above other content */
        background-color: #1A2035; /* Background color for the navbar */
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Optional: adds a shadow for better visibility */
    }

    /* Adjust content to account for the fixed navbar */
    body {
        margin: 0;
        padding-top: 70px; /* Adjust this value based on the height of your navbar */
    }

    .navbar-logo {
        height: 60px; /* Adjust logo height */
        width: auto;
        margin: 0; /* Remove any margin */
    }

    .navbar-title-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        margin: 0; /* Remove any margin */
    }

    .navbar-title {
        color: #fff;
        font-size: 36px; /* Adjust title font size */
        font-weight: bold;
        margin: 0; /* No extra margin */
    }

    .navbar-subtitle {
        color: #fff;
        font-size: 25px; /* Adjust subtitle font size */
        margin: 0; /* No extra margin */
        font-weight: bold ;
    }
    .topbar-user{
                        background-color: #fff;
                        border: 2px solid #000;
                        border-radius: 20px;
                        padding: 20px;
                      }
</style>
