<?php
$username= $email = $password = $catch_pass= $catch_user= $catch_email = "";
if(isset($_POST['signup'])){
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    if(empty($username) || empty($email) || empty($password)){
        $catch_email = "The input field is required!";
        $catch_user = "The input field is required!";
        $catch_pass = "The input field is required!";

    }else{
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d !@#$%^&*()-_=+]*$/', $password)) {
            $catch_pass = "Enter strong password minimum 8 character";
        } else {
          $hash = password_hash($password,PASSWORD_DEFAULT);
          include("./inc/config.php");
          $check_user = $con->prepare("SELECT * FROM auth WHERE username = ?");
          $check_user->bind_param("s", $username);
          $check_user->execute();
          $get_user = $check_user->get_result();
          if($get_user->num_rows > 0){
            $catch_user = "Username already exists. Please choose a unique username";
            $check_user->close();
          }else{
          $check_email = $con->prepare("SELECT * FROM auth WHERE email = ?");
          $check_email->bind_param("s", $email);
          $check_email->execute();
          $get_email = $check_email->get_result();
          if($get_email->num_rows > 0){
            $catch_email = "Email already exists. Please choose a different email";
            $check_email->close();
          }else{
          $sql = $con->prepare("INSERT INTO auth (username, email, password) VALUES (?,?,?)");
          $sql->bind_param("sss", $username, $email, $hash);
          if($sql->execute()){
            echo "<script>
            alert('Registration is successful!');
            window.location.href = './login';
          </script>";
    
          }else{
            $err_use = "Error during registration: " . $sql->error;
          }
          $sql->close();
          mysqli_close($con);
        }
    }
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="unlocking the doors to your dream space" />
    <title>LaMark || SignUp</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="iziToast.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="secondaryB">
    <div class="container-fluid pt-3 px-2 pb-5">
    <nav class="d-flex align-items-center justify-content-between mb-5 container-fluid shadow border-bottom border-info">
            <h3 class="mediumT2 primaryC fw-bold ms-3">
                <a href="./">
                LA<span class="tartiaryC">MARK</span>
                </a>
            </h3>
            <h5 class="fw-semibold me-md-5">Contact Us</h5>
        </nav>
        <div class="container my-3 shadow rounded px-md-5 px-2 py-4 border border-info" style="max-width: 30rem;">
        <div class="text-center mb-5">
            <h5 class="fs-4 fw-bold text-white">Sign Up</h5>
            <p class="fw-semibold mb-1">Expectional service and Expertise -the go-to real estate agency for finding your perfect home</p>
        </div>
        <form method="post">
        <div class="form-floating mb-3" style="background-color: transparent;">
            <input type="text" name="username" value="<?= $username ?>" class="form-control text-white" id="floatingInput" placeholder="Enter username..." style="background-color: transparent;">
            <label for="floatingInput" style="background-color: transparent;">Username...</label>
            <small class="fw-semibold text-danger"><?= $catch_user ?></small>
        </div>
        <div class="form-floating mb-3" style="background-color: transparent;">
            <input type="email" name="email"  class="form-control text-white" id="floatingInput" placeholder="name@example.com" style="background-color: transparent;">
            <label for="floatingInput" style="background-color: transparent;">Email address....</label>
            <small class="fw-semibold text-danger"><?= $catch_email ?></small>

        </div>
        <div class="form-floating mb-3" style="background-color: transparent;">
            <input type="password"  name="password" class="form-control text-white" id="floatingInput" placeholder="Enter password..." style="background-color: transparent;">
            <label for="floatingInput" style="background-color: transparent;">Password...</label>
            <small class="fw-semibold text-danger"><?= $catch_pass ?></small>

        </div>
        <input type="submit" name="signup" value="SignUp" class="btn primaryB rounded-pill w-100 text-white fw-bold mt-2">
        </form>
        <div class="mt-4">
            <p>Already a member-> 
            <a href="./login">Login</a>
            </p>
        </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</html>