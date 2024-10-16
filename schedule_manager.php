<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'manager') {
    header("Location: login.php");
    exit();
}
include 'header.php';
?>

<!-- Main Content -->
<div class="content">
  <h1>Manager Schedule</h1>
  <p>Manage and view schedules for your team.</p>
  <!-- Manager-specific schedule management content here -->
</div>

<?php include 'footer.php'; ?>
