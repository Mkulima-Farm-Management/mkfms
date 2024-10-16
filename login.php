<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body {
            background-color: whitesmoke;
            font-family: 'Poppins', sans-serif;
        }
        * {
            font-size: 14px;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            line-height: 1.5;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: red;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: 300;
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            border-radius: 4px;
            border: 1px solid #ccc;
            color: green;
        }
        small {
            color: red;
            font-size: 11px;
            font-style: italic;
        }
        .error {
            color: red;
            font-size: 14px;
            font-style: italic;
            text-align: center;
        }
        button {
            background-color: #4caf50;
            margin-top: 10px;
            color: #fff;
            width: 100%;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .remember-me {
            display: flex;
            align-items: center;
        }
        .remember-me input {
            margin-right: 5px;
        }
        a {
            text-decoration: none;
            color: green;
        }
    </style>
</head>
<body>
    <div class="container">
        <center>
            <img src="mkulima-high-resolution-logo-black-transparent.png" alt="Mkulima Logo" width="130" height="auto" style="margin-top: 10px;">
        </center>
        <h1>Login</h1>
        <?php
        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            include('db_connection.php');
            
            $username = $_POST['username'];
            $password = $_POST['password'];
            $remember = isset($_POST['remember']);

            // Check if connection was successful
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            
            // Prepare and execute query
            $stmt = $conn->prepare("
                SELECT u.id, u.password, r.role_name 
                FROM users u 
                JOIN user_roles ur ON u.id = ur.user_id 
                JOIN roles r ON ur.role_id = r.id 
                WHERE u.username = ?
            ");
            if (!$stmt) {
                die("Preparation failed: " . $conn->error);
            }
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();
            
            $error_message = "Invalid username/password."; // General error message

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $hashed_password, $role);
                $stmt->fetch();
                
                if (password_verify($password, $hashed_password)) {
                    // Password is correct, set session variables
                    $_SESSION['userid'] = $id;
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = $role;

                    // Set cookies if "Remember Me" is checked
                    if ($remember) {
                        setcookie("username", $username, time() + (86400 * 30), "/"); // 30 days
                        setcookie("password", $password, time() + (86400 * 30), "/"); // 30 days
                    } else {
                        if (isset($_COOKIE['username'])) {
                            setcookie("username", "", time() - 3600, "/");
                        }
                        if (isset($_COOKIE['password'])) {
                            setcookie("password", "", time() - 3600, "/");
                        }
                    }

                    // Redirect to the appropriate dashboard
                    if ($role == "worker") {
                        header("Location: dashboard_worker.php");
                        exit();
                    } elseif ($role == "manager") {
                        header("Location: dashboard_manager.php");
                        exit();
                    } elseif ($role == "admin") {
                        header("Location: dashboard_admin.php");
                        exit();
                    }
                } 
            }

            $stmt->close();
            $conn->close();
        } else {
            // Check for cookies and pre-fill the form if available
            $saved_username = isset($_COOKIE['username']) ? $_COOKIE['username'] : '';
            $saved_password = isset($_COOKIE['password']) ? $_COOKIE['password'] : '';
        }
        ?>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <div class="form-group">
                <label for="username">Username:<span style="color: red;">*</span></label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($saved_username); ?>" required><br><br>
            </div>
            <div class="form-group">
                <label for="password">Password:<span style="color: red;">*</span></label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($saved_password); ?>" required><br><br>
            </div>
            <div class="remember-me">
                <input type="checkbox" id="remember" name="remember" <?php if ($saved_username) echo 'checked'; ?>>
                <label for="remember">Remember Me</label>
            </div>
            <?php
            if (isset($error_message)) {
                echo '<div class="error">' . $error_message . '</div>';
            }
            ?>
            <button type="submit">Login</button>
            <center>
                <p style="margin-top:20px;">
                    <a href="registration.php">Don't have an account? Register here.</a>
                </p>
            </center>
        </form>
    </div>
</body>
</html>
