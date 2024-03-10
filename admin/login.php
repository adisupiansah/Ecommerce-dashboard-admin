<?php
// jalankan session
session_start();
require 'fungsi.php';

// cek cookie
// if (isset($_COOKIE['login'])) {
//     if($_COOKIE['login'] == 'true') {
//         $_SESSION['login'] = true;
//     }
// }
if (isset($_COOKIE['id']) && isset($_COOKIE['key']) ) {
    $id = $_COOKIE['id'];
    $key = $_COOKIE['key'];

    // ambil username berdasarkan id
    $result = mysqli_query($conn, "SELECT username FROM user WHERE id = $id");
    $row = mysqli_fetch_assoc($result);

    // cek cookie dan username
    if ($key === hash('sha256', $row['username'])) {
        $_SESSION['login'] = true;
        
    }
}

if (isset($_SESSION["login"])) {
    header("Location: dashboard.php");
    exit;
}



if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn, "SELECT * FROM user WHERE
                 username = '$username'");


    // cek username
    if (mysqli_num_rows($result) === 1) {

        // cek password
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row["password"])) {

            // set Sesiion-nya
            $_SESSION["login"] = true;
            $_SESSION["username"] = $row["username"];

            // cek remember me
            if (isset($_POST['remember'])) {
                // buat cookie

                setcookie('id', $row['id'], time() + 60);
                setcookie('key', hash('sha256', $row['username']), time() + 60 );


                // setcookie('login', 'true', time() + 60 );
            }

            header("Location: dashboard.php");
            exit;
        }
    }

    $error = true;
}

?>





<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Aldi Duzha" />
  <meta name="description" content="Free Bulma Login Template, part of Awesome Bulma Templates" />
  <meta name="keywords" content="bulma, login, page, website, template, free, awesome" />
  <link rel="canonical" href="https://aldi.github.io/bulma-login-template/" />
  <title>Bulma Login - Free Bulma Template</title>
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma-social@1/bin/bulma-social.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.13.0/css/all.min.css" />
  <link rel="stylesheet" href="css-login/styles.css" />
</head>

<body>
  <section class="hero is-fullheight">
    <div class="hero-body">
      <div class="container has-text-centered">
        <div class="column is-4 is-offset-4">
          <div class="box">
            <p class="subtitle is-4">Please login to proceed.</p>
            <br />
            <?php if(isset($error)) : ?>
              <article class="message is-danger">
                <div class="message-header">
                  <p>Error !</p>
                </div>
                <div class="message-body">
                    <p>Username / password salah, mohon login kembali</p>
                </div>
              </article>
            <?php endif; ?>
            <form action="" method="post">
              <div class="field">
                <p class="control has-icons-left has-icons-right">
                  <input class="input is-medium" type="text" name="username" placeholder="Username" />
                  <span class="icon is-medium is-left">
                    <i class="fas fa-user"></i>
                  </span>
                  <span class="icon is-medium is-right">
                    <i class="fas fa-check"></i>
                  </span>
                </p>
              </div>
              <div class="field">
                <p class="control has-icons-left">
                  <input class="input is-medium" type="password" name="password" placeholder="Password" />
                  <span class="icon is-small is-left">
                    <i class="fas fa-lock"></i>
                  </span>
                </p>
              </div>
              <div class="field">
                <label class="checkbox">
                  <input type="checkbox" name="remember" />
                  Remember me
                </label>
              </div>
              <button class="button is-block is-info is-large is-fullwidth" type="submit" name="login">Login</button><br />
              <p class="subtitle is-5">Login using Social Media</p>

            </form>
          </div>
          <p class="has-text-grey">
            <a href="register.php">Sign Up</a> &nbsp;·&nbsp; <a href="#">Forgot Password</a> &nbsp;·&nbsp;
            <a href="#">Need Help?</a>
          </p>
          
        </div>
      </div>
    </div>
    <div class="hero-foot">
      <div class="container has-text-centered">
        <p class="footer-text">
          <a href="https://www.aldiduzha.com?utm_source=Github" style="color: white;">Designed with <i class="fa fa-heart fa-fw" style="font-size: 10px; color: red;"></i> by Teh botol</a>
        </p>
      </div>
    </div>
  </section>
</body>

</html>