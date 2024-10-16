<?php
session_start();
include('db_connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and bind
    $stmt = $conn->prepare("
        SELECT u.id, u.password, r.role_name 
        FROM users u
        JOIN user_roles ur ON u.id = ur.user_id
        JOIN roles r ON ur.role_id = r.id
        WHERE u.username = ?
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hashed_password, $role_name);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Password is correct, set session variables
            $_SESSION['userid'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role_name;

            // Redirect to the appropriate dashboard
            if ($role_name == "worker") {
                header("Location: dashboard_worker.php");
            } elseif ($role_name == "manager") {
                header("Location: dashboard_manager.php");
            } elseif ($role_name == "admin") {
                header("Location: dashboard_admin.php");
            } else {
                echo "Role not recognized.";
            }
            exit();
        } else {
            // Invalid password
            echo "Invalid username or password.";
        }
    } else {
        // No user found
        echo "Invalid username or password.";
    }

    $stmt->close();
}

$conn->close();
?>
