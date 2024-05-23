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
    <!-- TODO: delete 2 lines below without changing the layout -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.bundle.min.js"></script>

    <title>Restaurant Login</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width" />
    <!-- <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.0/css/bootstrap.min.css'> -->
    <link rel="stylesheet" href="style.css" />
    <link rel='stylesheet' href='https://unicons.iconscout.com/release/v2.1.9/css/unicons.css'>
    <link rel="icon" href="/rpl-project/image/img.jpg">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> -->

</head>

<body>
    <div class="section">
        <div class="container">
            <div class="row full-height justify-content-center">
                <div class="col-12 text-center align-self-center py-5">
                    <div class="section pb-5 pt-5 pt-sm-2 text-center">
                        <h6 class="mb-0 pb-3"><span>Log In </span><span>Sign Up</span></h6>
                        <input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
                        <label for="reg-log"></label>
                        <div class="card-3d-wrap mx-auto">
                            <div class="card-3d-wrapper">
                                <div class="card-front">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <h4 class="mb-4 pb-3">Log In</h4>
                                            <img class="pp" src="image/pp.png" alt="bg" width="100px">
                                            
                                            <form method="POST" action="<?php $_SERVER['PHP_SELF']?>">
                                                <div class="form-group">
                                                    <input type="email" name="email" class="form-style"
                                                        placeholder="Your Email" id="email" autocomplete="off">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="password" class="form-style"
                                                        placeholder="Your Password" id="password" autocomplete="off">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <button type="submit" class="btn mt-4">LOGIN</button>
                                                <p class="mb-0 mt-4 text-center"><a href="#0" class="link">Forgot your
                                                        password?</a></p>

                                                <?php if ($error): ?>
                                                <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                                                <?php endif; ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-back">
                                    <div class="center-wrap">
                                        <div class="section text-center">
                                            <form action="projek_web/backend/api/v1/user.php" method="post">
                                                <h4 class="mb-4 pb-3">Sign Up</h4>
                                                <?php
                                            if (isset($errors)) {
                                                foreach ($errors as $error) {
                                                    echo '<span class="error-msg">' . $error . '</span>';
                                                }
                                            }
                                            ?>
                                                <div class="form-group">
                                                    <input type="text" name="logname" class="form-style"
                                                        placeholder="Your Full Name" id="logname" autocomplete="off">
                                                    <i class="input-icon uil uil-user"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="email" name="logemail" class="form-style"
                                                        placeholder="Your Email" id="logemail" autocomplete="off">
                                                    <i class="input-icon uil uil-at"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <input type="password" name="logpass" class="form-style"
                                                        placeholder="Your Password" id="logpass" autocomplete="off">
                                                    <i class="input-icon uil uil-lock-alt"></i>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <select id="user" name="loguser" required class="form-style">
                                                        <option value="pelanggan">Pelanggan</option>
                                                        <option value="pelayan">Pelayan</option>
                                                        <option value="manajer">Manajer</option>
                                                    </select>
                                                    <!-- TODO: set the svg in seperate file instead directly in svg tag -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24">
                                                        <path fill="#494646"
                                                            d="M14.81 12.28a3.73 3.73 0 0 0 1-2.5a3.78 3.78 0 0 0-7.56 0a3.73 3.73 0 0 0 1 2.5A5.94 5.94 0 0 0 6 16.89a1 1 0 0 0 2 .22a4 4 0 0 1 7.94 0A1 1 0 0 0 17 18h.11a1 1 0 0 0 .88-1.1a5.94 5.94 0 0 0-3.18-4.62ZM12 11.56a1.78 1.78 0 1 1 1.78-1.78A1.78 1.78 0 0 1 12 11.56ZM19 2H5a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h14a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3Zm1 17a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1Z" />
                                                    </svg>
                                                </div>
                                                <button type="submit" class="btn mt-4">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>