<?php
session_start();
$username= $email = $password = $catch_pass= $catch_user = "";
if(isset($_POST['login'])){
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    if(empty($username)){
        $catch_user = "Username is required!";
    }
    if(empty($password)){
        $catch_pass = "Password is required!";
    }
    if(empty($username) || empty($password)){
        $catch = "The input field is required!";
    }
    if(!empty($username) && !empty($password)){
        include("./config.php");
        $check_user = $con->prepare("SELECT * FROM auth WHERE username =?");
        $check_user->bind_param("s", $username);
        $check_user->execute();
        $results = $check_user->get_result();
        if(!$results->num_rows > 0){
            $catch_user = "Username does not exist";
        }else{
            $user = $results->fetch_assoc();
            $user_password = $user['password'];
            if(password_verify($password, $user_password)){
                echo "<script>
                     alert('logged In is successfully!');
                     window.location.href = './admin.php';
                   </script>";
                   $_SESSION['username'] = $username;
             $update_at = $con->prepare("UPDATE auth SET update_at = CURRENT_TIMESTAMP WHERE username =? ");
             $update_at->bind_param("s", $username);
             $update_at->execute();
             $update_at->close();
            }else{
                $catch_pass = "Incorrect password";
            }
            $check_user->close();
            mysqli_close($con);
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
    <title>Blog || Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body class="secondaryB">
    <div class="container-fluid p-0">
    <?php require "./navbar.php"; ?>
        <div class="container my-3 shadow rounded px-md-5 px-2 py-4 border border-black" style="max-width: 30rem;">
        <div class="text-center mb-5">
            <h5 class="fs-4 fw-bold text-white">Login</h5>
           
        </div>
        <form method="post">
        <div class="form-floating mb-3" style="background-color: transparent;">
            <input type="text" name="username" class="form-control text-black" id="floatingInput" placeholder="Enter username...">
            <label for="floatingInput" style="background-color: transparent;">Username...</label>
            <small class="fw-semibold text-danger"><?= $catch_user ?></small>

        </div>
        <div class="form-floating mb-3" style="background-color: transparent;">
            <input type="password" name="password" class="form-control text-black" id="floatingInput" placeholder="Enter password...">
            <label for="floatingInput" style="background-color: transparent;">Password...</label>
            <small class="fw-semibold text-danger"><?= $catch_pass ?></small>

        </div>
        <input type="submit" name="login" value="Login" class="btn bg-black rounded-pill w-100 text-white fw-bold mt-2">
        </form>
        <div class="mt-4">
            <p>Don't have accout yet-> 
            <a href="./register.php">Register</a>
            </p>
        </div>
        </div>
    </div>
</body>

</html>
