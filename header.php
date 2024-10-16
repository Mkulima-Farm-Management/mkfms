
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo ucfirst($_SESSION['role']); ?> Schedule</title>
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
<!-- Header -->
<div class="header">
  <div class="topbar">
    <span>Welcome, <?php echo $_SESSION['username']; ?> | Role: <?php echo ucfirst($_SESSION['role']); ?></span>
    <div class="top-bar">
      <a href="profile.php"><i class="fas fa-user-circle"></i></a>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
    </div>
  </div>
  <div class="navbar">
    <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
    <a href="schedule.php"><i class="fas fa-calendar-alt"></i> Schedule</a>
    <!-- Add other links as needed -->
  </div>
</div>
