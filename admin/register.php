<?php 
require "fungsi.php";

if (isset($_POST['register'])) {
    # code...
    if (register($_POST) > 0) {
        # code...
        echo "
            <script>
                alert('username berhasil terdaftar');
                document.location.href = 'login.php';
            </script>
        ";
    } else {
        # code...
        mysqli_error($conn);
    }
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
    <link rel="stylesheet" href="css-login/styleRegister.css" />
  </head>
  <body>
    <section class="hero is-fullheight">
      <div class="hero-body">
        <div class="container has-text-centered">
          <div class="column is-4 is-offset-4">
            <div class="box">
              <p class="subtitle is-4">Please create an account</p>
              <br />
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
                  <p class="control has-icons-left">
                    <input class="input is-medium" type="password" name="password2" placeholder="Confirm Password" />
                    <span class="icon is-small is-left">
                      <i class="fas fa-lock"></i>
                    </span>
                  </p>
                </div>

                <button class="button is-block is-info is-large is-fullwidth" type="submit" name="register">Register</button><br />
                <p class="subtitle is-5">create your account</p>
                
              </form>
            </div>
            <p class="has-text-grey">
              <a href="login.php">Login</a> &nbsp;·&nbsp; <a href="#">Forgot Password</a> &nbsp;·&nbsp;
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
