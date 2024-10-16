<?php
include('db_connection.php');

function assign_role($user_id, $role_name, $conn) {
    $role_query = "SELECT id FROM roles WHERE role_name = ?";
    $stmt = $conn->prepare($role_query);
    $stmt->bind_param("s", $role_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $role_id = $result->fetch_assoc()['id'];

        $assign_query = "INSERT INTO user_roles (user_id, role_id) VALUES (?, ?)";
        $assign_stmt = $conn->prepare($assign_query);
        $assign_stmt->bind_param("ii", $user_id, $role_id);

        if ($assign_stmt->execute()) {
            $assign_stmt->close();
            return true;
        } else {
            echo "Error assigning role: " . $conn->error;
            return false;
        }
    } else {
        echo "Role not found: " . $role_name;
        return false;
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $farm_name = $_POST['farm_name'];
    $farm_location = $_POST['farm_location'];

    if ($password !== $confirm_password) {
        die("Passwords do not match!");
    }

    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    $conn->begin_transaction(); // Start transaction

    try {
        // Insert user into users table
        $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $hashed_password, $email);

        if ($stmt->execute()) {
            $user_id = $stmt->insert_id; // Get the inserted user's ID
            
            // Insert farm details into farms table
            $farm_sql = "INSERT INTO farms (user_id, farm_name, farm_location) VALUES (?, ?, ?)";
            $farm_stmt = $conn->prepare($farm_sql);
            $farm_stmt->bind_param("iss", $user_id, $farm_name, $farm_location);

            if ($farm_stmt->execute()) {
                // Assign role to user
                if (assign_role($user_id, $role, $conn)) {
                    $conn->commit(); // Commit transaction
                    header("Location: login.html"); // Redirect to login page
                    exit(); // Ensure no further code is executed
                } else {
                    throw new Exception("Failed to assign role");
                }
            } else {
                throw new Exception("Farm insertion failed: " . $conn->error);
            }

            $farm_stmt->close();
        } else {
            throw new Exception("User insertion failed: " . $conn->error);
        }

        $stmt->close();
    } catch (Exception $e) {
        $conn->rollback(); // Roll back transaction
        echo "Error: " . $e->getMessage();
    }

    $conn->close();
}
?>
