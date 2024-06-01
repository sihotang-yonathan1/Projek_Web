<?php
session_start();

require_once("./utils/network/http_client.php");
require_once("./config.php");

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $result = HttpClient::post(
        "$PROJECT_URL/backend/api/v1/login.php",
        [
            'email' => $_POST['email'], 
            'password' => $_POST['password']
        ]
    );
    var_dump($result);
    ['id' => $user_id, 'user_type' => $user_type] = json_decode($result, true);
    
    // Set session
    $_SESSION['user_id'] = $user_id;
    $_SESSION['user_type'] = $user_type;  

    $_MAP_DASHBOARD = [
        "pelanggan" => "beranda_dashboard.php",
        "pelayan" => "pelayan_dashboard.php",
        "manajer" => "manajer_dashboard.php"
    ];

    if (array_key_exists($user_type, $_MAP_DASHBOARD)){
        header("Location: $_MAP_DASHBOARD[$user_type]");
    }
    else {
        header("Location: index.php");
    }
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
        echo "<script>alert('Password Master Salah!');</script>";
        unset($_SESSION['error']); // Hapus nilai session error
    }
    ?>
</head>

<body>
    <div class="section">
        <div class="container">
            <h6><span>Log In </span><span>Sign Up</span></h6>
            <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
            <label for="reg-log"></label>
            <div class="card-3d-wrap">
                <div class="card-3d-wrapper">
                    <!-- Login Form -->
                    <div class="card-front">
                        <div class="center-wrap">
                            <div class="section-text-center">
                                <h4>Log In</h4>
                                <img class="pp" src="image/pp.png" alt="bg" width="100px">
                                <form method="post">
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-style" placeholder="Your Email" id="email" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-style" placeholder="Your Password" id="password" autocomplete="off" required>
                                    </div>
                                    <button type="submit" class="btn">LOGIN</button>
                                    <p><a href="forget_pass.php" class="link">Forgot your password?</a></p>

                                    <?php if ($error): ?>
                                        <div class="alert alert-danger"><?php echo $error; ?></div>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sign Up Form -->
                    <div class="card-back">
                        <div class="center-wrap">
                            <div class="section-text-center">
                                <form action="koneksi.php" method="post">
                                    <h4>Sign Up</h4>
                                    <?php if (isset($errors)) {
                                        foreach ($errors as $error) {
                                            echo '<span class="error-msg">' . $error . '</span>';
                                        }
                                    } ?>
                                    <div class="form-group">
                                        <input type="text" name="logname" class="form-style" placeholder="Your Full Name" id="logname" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="logemail" class="form-style" placeholder="Your Email" id="logemail2" autocomplete="off" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="logpass" class="form-style" placeholder="Your Password" id="logpass2" autocomplete="off" required>
                                    </div>
                                    <div class="form-group" id="user_field">
                                        <select id="user" name="loguser" class="form-style" placeholder="Your User" onchange="showVerification()" required>
                                            <option value="pelanggan">Pelanggan</option>
                                            <option value="pelayan">Pelayan</option>
                                            <option value="manajer">Manajer</option>
                                        </select>
                                    </div>
                                    <div class="form-group" id="verification_field" style="display: none;">
                                        <input type="password" name="verification_password" class="form-style" placeholder="Master Password" id="logpass3" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" name="security" class="form-style" placeholder="Pekerjaan impian Anda saat masih kecil?" id="logpass3" autocomplete="off" required>
                                    </div>
                                    <button type="submit" class="btn" id="btn-sign">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <script src="script.js"></script>
</body>

</html>
