<?php
$username = $email = $password = $catch_pass = $catch_user = $catch_email = $catch = "";
if (isset($_POST['signup'])) {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    if (empty($username)) {
        $catch_user = "Username is required!";
    }
    if (empty($email)) {
        $catch_email = "Email is required!";
    }
    if (empty($password)) {
        $catch_pass = "Password is required!";
    }
    if (empty($username) || empty($email) || empty($password)) {
        $catch = "The input field is required!";
    } else {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d !@#$%^&*()-_=+]*$/', $password)) {
            $catch_pass = "Enter strong password minimum 8 character";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            include("./config.php");
            $check_user = $con->prepare("SELECT * FROM auth WHERE username = ?");
            $check_user->bind_param("s", $username);
            $check_user->execute();
            $get_user = $check_user->get_result();
            if ($get_user->num_rows > 0) {
                $catch_user = "Username already exists. Please choose a unique username";
                $check_user->close();
            } else {
                $check_email = $con->prepare("SELECT * FROM auth WHERE email = ?");
                $check_email->bind_param("s", $email);
                $check_email->execute();
                $get_email = $check_email->get_result();
                if ($get_email->num_rows > 0) {
                    $catch_email = "Email already exists. Please choose a different email";
                    $check_email->close();
                } else {
                    $sql = $con->prepare("INSERT INTO auth (username, email, password) VALUES (?,?,?)");
                    $sql->bind_param("sss", $username, $email, $hash);
                    if ($sql->execute()) {
                        echo "<script>
            alert('Registration is successfull!');
            window.location.href = './login.php';
          </script>";
                    } else {
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
    <title>Blog || Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="iziToast.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="index.css" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <div class="container-fluid p-0">
        <?php require "./navbar.php"; ?>
        <div class="container my-3 shadow rounded px-md-5 px-2 py-4 border border-black" style="max-width: 30rem;">
            <div class="text-center mb-5">
                <h5 class="fs-4 fw-bold text-white">Register</h5>
            </div>
            <form method="post">
                <div class="form-floating mb-3" style="background-color: transparent;">
                    <input type="text" name="username" value="<?= $username ?>" class="form-control" id="floatingInput" placeholder="Enter username...">
                    <label for="floatingInput" style="background-color: transparent;">Username...</label>
                    <small class="fw-semibold text-danger"><?= $catch_user ?></small>
                </div>
                <div class="form-floating mb-3" style="background-color: transparent;">
                    <input type="email" name="email" class="form-control " id="floatingInput" placeholder="name@example.com">
                    <label for="floatingInput" style="background-color: transparent;">Email address....</label>
                    <small class="fw-semibold text-danger"><?= $catch_email ?></small>
                </div>
                <div class="form-floating mb-3" style="background-color: transparent;">
                    <input type="password" name="password" class="form-control" id="floatingInput" placeholder="Enter password...">
                    <label for="floatingInput" style="background-color: transparent;">Password...</label>
                    <small class="fw-semibold text-danger"><?= $catch_pass ?></small>
                </div>
                <input type="submit" name="signup" value="Register" class="btn bg-black rounded-pill w-100 text-white fw-bold mt-2">
            </form>
            <div class="mt-4">
                <p>Already a member->
                    <a href="./login.php">Login</a>
                </p>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</html>