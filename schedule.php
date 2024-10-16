<?php
session_start();
if (!isset($_SESSION['role']) || ($_SESSION['role'] != 'manager' && $_SESSION['role'] != 'admin' && $_SESSION['role'] != 'worker')) {
    header("Location: login.php");
    exit();
}
$dashboard_link = ($_SESSION['role'] == 'admin') ? 'dashboard_admin.php' : (($_SESSION['role'] == 'manager') ? 'dashboard_manager.php' : 'dashboard_worker.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Schedule</title>
  <!-- External libraries -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Add OpenLayers library -->
  <script src="https://cdn.jsdelivr.net/npm/ol@6.10.0/dist/ol.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/ol@6.10.0/dist/ol.css" type="text/css">
  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
  <!-- Leaflet Control Geocoder CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  <link rel="stylesheet" href="dashboard.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<!-- Sidebar -->
<div class="sidebar">
  <!-- Brand/logo -->
  <a class="navbar-brand" href="<?php echo $dashboard_link; ?>">
      <img src="mkulima-high-resolution-logo-black-transparent.png" alt="Mkulima Logo" width="150" height="auto">
  </a>
  <h6 style="padding-left: 15px; margin-top: 10px; font-weight: 100;color: green;">MAIN NAVIGATION</h6>
  <pre> </pre>
  <a href="<?php echo $dashboard_link; ?>"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
  <a href="schedule.php"><i class="fas fa-calendar-alt"></i> Schedule</a>
  <a href="crops.html"><i class="fas fa-seedling"></i> Crops</a>
  <a href="tasks.html"><i class="fas fa-tasks"></i> Tasks</a>
  <a href="livestock.html"><i class="fas fa-paw"></i> Livestock</a>
  <a href="grazing.html"><i class="fas fa-map-marker-alt"></i> Grazing</a>
  <a href="crop_rotation.html"><i class="fas fa-sync-alt"></i> Crop Rotation</a>
  <a href="planting.html"><i class="fas fa-leaf"></i> Planting</a>
  <a href="calendar.html"><i class="fas fa-calendar-alt"></i> Calendar</a>
  <a href="#"><i class="fas fa-project-diagram"></i> Projects</a>
  <a href="#"><i class="fas fa-file-alt"></i> Reports</a>
  <a href="contacts.html"><i class="fas fa-address-book"></i> Contacts</a>
  <a href="#"><i class="fas fa-map"></i> Farm Map</a>
  <a href="weather.html"><i class="fas fa-cloud-sun-rain"></i> Weather</a>
  <button class="collapsible"><i class="fas fa-users"></i> User Management</button>
  <div class="content-collapsible">
      <a href="add_user.html">Add User</a>
      <a href="view_users.html">View Users</a>
  </div>
  <button class="collapsible"><i class="fas fa-clipboard-list"></i> Records</button>
  <div class="content-collapsible">
      <a href="#">Add Record</a>
      <a href="#">View Records</a>
  </div>
</div>

<!-- Content -->
<div class="content">
  <div class="topbar">
    <div class="menu1">
      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="30" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
        <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
      </svg>
    </div>
    <div class="search-bar">
      <input type="search" placeholder="Search...">
    </div>
    <div class="top-bar">
      <div class="notification-bell">
        <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
          <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2m.995-14.901a1 1 0 1 0-1.99 0A5 5 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901"/>
        </svg></span>
        <span class="badge">3</span>
      </div>
    </div>
    <div class="content">
      <!-- Your page content goes here -->
    </div>
    <!-- Profile button with space for profile picture -->
    <div class="menu-item" id="profile">
      <i class="fas fa-user-circle"></i> <!-- Font Awesome icon for user profile -->
      <div class="dropdown" id="profile-dropdown">
        <a href="#">Edit Profile</a>
        <a href="#">View Status</a>
        <a href="#">Sign Out</a>
      </div>
    </div>
    <div class="menu-item" id="settings">
      <i class="fas fa-cog"></i> <!-- Font Awesome icon for settings -->
      <div class="dropdown" id="settings-dropdown">
        <a href="#">Change Password</a>
        <a href="#">Notification Settings</a>
        <a href="#">Privacy Settings</a>
      </div>
    </div>
  </div>
  <div class="dash">
    <i class="fas fa-home"></i> Schedule
  </div>
  <!-- Main content goes here -->
  <div class="container">
    <!-- Schedule content -->
    <div class="schedule">
      <h2>Schedule</h2>
      <p>Here you can manage and view the schedule.</p>
      <!-- Add your schedule management content here -->
    </div>
  </div>
</div>

<!-- Footer -->
<footer>
  <p>&copy; <?php echo date("Y"); ?> Your Farm Management System. All rights reserved.</p>
</footer>

<!-- JavaScript to handle collapsible items -->
<script>
  document.querySelectorAll(".collapsible").forEach(button => {
    button.addEventListener("click", () => {
      button.classList.toggle("active");
      let content = button.nextElementSibling;
      if (content.style.display === "block") {
        content.style.display = "none";
      } else {
        content.style.display = "block";
      }
    });
  });

  // JavaScript to handle profile and settings dropdowns
  document.getElementById('profile').addEventListener('click', function() {
    document.getElementById('profile-dropdown').classList.toggle('show');
  });

  document.getElementById('settings').addEventListener('click', function() {
    document.getElementById('settings-dropdown').classList.toggle('show');
  });
</script>
</body>
</html>
