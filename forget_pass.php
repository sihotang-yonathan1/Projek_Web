<?php
session_start();

$servername = "localhost";
$username = "root"; // Ganti dengan username Anda
$password = ""; // Ganti dengan password Anda
$dbname = "user_db"; // Ganti dengan nama database Anda

require_once("./utils/network/http_client.php");
require_once("./config.php");

$error = "";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        // Login logic
        $result = HttpClient::post(
            "$PROJECT_URL/backend/api/v1/login.php",
            [
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ]
        );
        $data = json_decode($result, true);
        if ($data) {
            ['id' => $user_id, 'user_type' => $user_type] = $data;

            // Set session
            $_SESSION['id'] = $user_id;
            $_SESSION['user_type'] = $user_type;

            $_MAP_DASHBOARD = [
                "pelanggan" => "beranda_dashboard.php",
                "pelayan" => "pelayan_dashboard.php",
                "manajer" => "manajer_dashboard.php"
            ];

            if (array_key_exists($user_type, $_MAP_DASHBOARD)) {
                header("Location: {$_MAP_DASHBOARD[$user_type]}");
            } else {
                header("Location: index.php");
            }
            exit();
        } else {
            $error = "Invalid login credentials.";
        }
    } elseif (isset($_POST['logemail']) && isset($_POST['security']) && isset($_POST['password'])) {
        // Password recovery logic
        $email = $_POST['logemail'];
        $security_answer = $_POST['security'];
        $new_password = $_POST['password'];

        // Retrieve user_id based on email and security question answer
        $user_id = verifySecurityAnswer($email, $security_answer);
        if ($user_id) {
            // Update password in the database
            $sql = "UPDATE user_form SET password='$new_password' WHERE id='$user_id'";

            if ($conn->query($sql) === TRUE) {
                header("Location: index.php");
                exit();
            } else {
                $error = "Error updating password: " . $conn->error;
            }
        } else {
            $_SESSION['error'] = true; // Set session error
            header("Location: forget_pass.php");
            exit();
        }
    }
}

function verifySecurityAnswer($email, $answer) {
    global $conn;

    // Query to get the user_id based on the email and security answer
    $sql = "SELECT id FROM user_form WHERE email = ? AND security = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $email, $answer);
        $stmt->execute();
        $stmt->bind_result($user_id);
        if ($stmt->fetch()) {
            $stmt->close();
            return $user_id;
        }
        $stmt->close();
    }
    return false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Restauran Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="image/img.jpg">
    <?php
    // Tampilkan alert jika terjadi error
    if (isset($_SESSION['error']) && $_SESSION['error']) {
        echo "<script>alert('Email atau jawaban keamanan salah!');</script>";
        unset($_SESSION['error']); // Hapus nilai session error
    }
    ?>
</head>

<body>
    <div class="card-front">
        <div class="center-wrap">
            <div class="section-text-center">
                <h4>Forget Password</h4>
                <a href="index.php"><button class="tombol">Login</button></a>
                <?php if ($error): ?>
                    <span class="error-msg"><?php echo $error; ?></span>
                <?php endif; ?>
                <img class="pp" src="image/pp.png" alt="bg" width="100px">
                <form method="post">
                    <div class="form-group">
                        <input type="email" name="logemail" class="form-style" placeholder="Your Email" id="logemail2" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="security" class="form-style" placeholder="Pekerjaan impian Anda saat masih kecil?" id="security" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-style" placeholder="New Password" id="password" autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>
