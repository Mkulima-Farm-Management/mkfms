<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] != 'worker') {
    header("Location: login.php");
    exit();
}
include 'header.php';
?>

<!-- Main Content -->
<div class="content">
  <h1>Worker Schedule</h1>
  <p>View your schedule and upcoming tasks.</p>
  <!-- Worker-specific schedule content here -->
</div>

<?php include 'footer.php'; ?>
