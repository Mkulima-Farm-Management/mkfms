<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
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
  <a class="navbar-brand" href="dashboard_admin.php">
    <img src="mkulima-high-resolution-logo-black-transparent.png" alt="Mkulima Logo" width="150" height="auto">
  </a>
  <h6 style="padding-left: 15px; margin-top: 10px; font-weight: 100;color: green;">MAIN NAVIGATION</h6>
  <pre> </pre>
  <a href="dashboard_admin.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
  <a href="schedule.php"><i class="fas fa-calendar-alt"></i> Schedule</a>
  <a href="crops.html"><i class="fas fa-seedling"></i> Crops</a>
  <a href="tasks.html"><i class="fas fa-tasks"></i> Tasks</a>
  <a href="livestock.html"><i class="fas fa-paw"></i> Livestock</a>
  <a href="grazing.html"><i class="fas fa-cow"></i> Grazing</a>
  <a href="crop-rotation.html"><i class="fas fa-redo"></i> Crop Rotation</a>
  <a href="planting.html"><i class="fas fa-plant"></i> Planting</a>
  <a href="calendar.html"><i class="fas fa-calendar-alt"></i> Calendar</a>
  <a href="weather.html"><i class="fas fa-cloud-sun-rain"></i> Weather</a>
  <a href="contacts.html"><i class="fas fa-address-book"></i> Contacts</a>
  <a href="farm-map.html"><i class="fas fa-map"></i> Farm Map</a>
  <a href="reports.html"><i class="fas fa-file-alt"></i> Reports</a>
  <a href="projects.html"><i class="fas fa-project-diagram"></i> Projects</a>
  <button class="collapsible"><i class="fas fa-users"></i> Workers</button>
  <div class="content-collapsible">
    <a href="view-workers.html">View Workers</a>
    <a href="add-worker.html">Add Worker</a>
  </div>
  <button class="collapsible"><i class="fas fa-book"></i> Records</button>
  <div class="content-collapsible">
    <a href="view-records.html">View Records</a>
    <a href="add-record.html">Add Record</a>
  </div>
  <button class="collapsible"><i class="fas fa-cogs"></i> Admin</button>
  <div class="content-collapsible">
    <a href="manage-users.html">Manage Users</a>
    <a href="edit-profile.html">Edit Profile</a>
    <a href="view-status.html">View Status</a>
    <a href="change-password.html">Change Password</a>
  </div>
  <button class="collapsible"><i class="fas fa-cogs"></i> Settings</button>
  <div class="content-collapsible">
    <a href="notification-settings.html">Notification Settings</a>
    <a href="privacy-settings.html">Privacy Settings</a>
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
    <div class="menu-item" id="profile">
      <i class="fas fa-user-circle"></i>
      <div class="dropdown" id="profile-dropdown">
        <a href="edit-profile.html">Edit Profile</a>
        <a href="view-status.html">View Status</a>
        <a href="sign-out.html">Sign Out</a>
      </div>
    </div>
    <div class="menu-item" id="settings">
      <i class="fas fa-cog"></i>
      <div class="dropdown" id="settings-dropdown">
        <a href="change-password.html">Change Password</a>
        <a href="notification-settings.html">Notification Settings</a>
        <a href="privacy-settings.html">Privacy Settings</a>
      </div>
    </div>
  </div>
  <div class="dash">
    <i class="fas fa-home"></i> Dashboard>>Admin Dashboard
  </div>
  <!-- Main content goes here -->
  <div class="container">
    <!-- Admin-specific Components -->
    <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-6 w-full max-w-6xl">
      <!-- Component 1: User Management -->
      <div class="flex items-center p-4 bg-white rounded">
        <div class="flex flex-shrink-0 items-center justify-center bg-blue-200 h-16 w-16 rounded">
          <svg class="w-6 h-6 fill-current text-blue-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M4 4a4 4 0 110 8 4 4 0 010-8zM4 6a2 2 0 100 4 2 2 0 000-4zM14 8a4 4 0 110 8 4 4 0 010-8zM14 10a2 2 0 100 4 2 2 0 000-4zM2 18a1 1 0 011-1h14a1 1 0 011 1v1H2v-1z"/>
          </svg>
        </div>
        <div class="flex-grow flex flex-col ml-4">
          <span class="text-xl font-bold">Manage Users</span>
          <div class="flex items-center justify-between">
            <span class="text-gray-500">Add, Edit, and Remove Users</span>
          </div>
        </div>
      </div>
      <!-- Component 2: Farm Records -->
      <div class="flex items-center p-4 bg-white rounded">
        <div class="flex flex-shrink-0 items-center justify-center bg-green-200 h-16 w-16 rounded">
          <svg class="w-6 h-6 fill-current text-green-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M7.5 2a.5.5 0 01.5.5v13a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5V2.5a.5.5 0 01.5-.5h1zm5 0a.5.5 0 01.5.5v13a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5V2.5a.5.5 0 01.5-.5h1z"/>
          </svg>
        </div>
        <div class="flex-grow flex flex-col ml-4">
          <span class="text-xl font-bold">Farm Records</span>
          <div class="flex items-center justify-between">
            <span class="text-gray-500">View and Manage Farm Records</span>
          </div>
        </div>
      </div>
      <!-- Component 3: Reports -->
      <div class="flex items-center p-4 bg-white rounded">
        <div class="flex flex-shrink-0 items-center justify-center bg-red-200 h-16 w-16 rounded">
          <svg class="w-6 h-6 fill-current text-red-700" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
            <path d="M3.5 2a.5.5 0 01.5.5v15a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5V2.5a.5.5 0 01.5-.5h1zM17 2a.5.5 0 01.5.5v15a.5.5 0 01-.5.5h-1a.5.5 0 01-.5-.5V2.5a.5.5 0 01.5-.5h1z"/>
          </svg>
        </div>
        <div class="flex-grow flex flex-col ml-4">
          <span class="text-xl font-bold">Reports</span>
          <div class="flex items-center justify-between">
            <span class="text-gray-500">Generate and View Reports</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript for Collapsible Sidebar Items -->
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
</script>
<!-- Optional JavaScript for Map Integration -->
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
<script>
  // Initialize Leaflet map
  var map = L.map('map').setView([51.505, -0.09], 13);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
  // Ensure profile and settings dropdowns are functioning
document.getElementById('profile').addEventListener('click', function() {
  document.getElementById('profile-dropdown').classList.toggle('show');
});

document.getElementById('settings').addEventListener('click', function() {
  document.getElementById('settings-dropdown').classList.toggle('show');
});

// Ensure menu icon toggles the sidebar
document.querySelector('.menu1 svg').addEventListener('click', function() {
  document.querySelector('.sidebar').classList.toggle('active');
});

</script>
</body>
</html>

