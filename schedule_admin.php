<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin') {
    header("Location: login.php");
    exit();
}
include 'header.php';
?>

<!-- Main Content -->
<div class="content">
  <h1>Admin Schedule</h1>
  <p>Manage and view schedules for all users.</p>
  <!-- Admin-specific schedule management content here -->
</div>

<?php include 'footer.php'; ?>