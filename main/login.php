<?php
session_start();


// Database connection
$host = "localhost";
$user = "root";
$pass = "";
$db   = "hrsys_db";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = "Email and password are required.";
    } else {

        // ADMIN ONLY LOGIN (assumes you have a 'role' column set to 'admin')
        // If you don't have role column yet, remove "AND role = 'admin'"
        $stmt = $conn->prepare("SELECT id, email, password FROM users WHERE email = ?");
        
        if (!$stmt) {
            die("SQL Error: " . $conn->error);
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows === 1) {
            $userData = $result->fetch_assoc();

            // Debug helper (remove after testing)
            // var_dump($userData); exit;

            if (password_verify($password, $userData['password'])) {
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['email']   = $userData['email'];

                header("Location: /main/dashboard.php");
                exit;
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "Account not found.";
        }

        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LGU San Nicolas - Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: url("/assets/images/bgsannic.jpg") no-repeat center center fixed;
            background-size: cover;
        }
        .overlay {
            background: rgba(173, 216, 230, 0.85);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            width: 380px;
            background: rgba(255,255,255,0.95);
            padding: 30px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
        }
        .login-box img {
            width: 90px;
            margin-bottom: 10px;
        }
        .login-box h2 {
            margin: 10px 0 5px;
            color: #0b4f6c;
        }
        .login-box p {
            color: #555;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .form-group {
            text-align: left;
            margin-bottom: 15px;
        }
        .form-group label {
            font-size: 14px;
            color: #0b4f6c;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
        }
        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background: #0b4f6c;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }
        .btn:hover {
            background: #083a50;
        }
        .error {
            color: red;
            font-size: 14px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<div class="overlay">
    <div class="login-box">
        <img src="/assets/images/sannic.png" alt="LGU Logo">
        <h2>LGU SAN NICOLAS</h2>
        <p>Human Resource Office</p>

        <?php if (!empty($error)): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="admin@email.com" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" placeholder="******" required>
            </div>

            <button type="submit" class="btn">Sign in</button>
        </form>
    </div>
</div>
</body>
</html>
