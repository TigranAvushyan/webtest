<?php

    unset($_SESSION['logged_user']);

    require "connection.php";

    $errors = array();

    $login = $_POST['login'];
    $telegram = $_POST['telegram'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `profile` WHERE `login` = '$login';";
    $result = $pdo->query($query,PDO::FETCH_ASSOC);
    
    $profile = $result->fetch();

    if(isset($_POST['on_signup'])){
      if(empty($profile)){
        $query = "INSERT INTO `profile`(`id`, `login`, `telegram`, `password`) VALUES (NULL, :login, :telegram,:password);";
        $result = $pdo->prepare($query);
        $result->execute([':login' => "$login",
                          ':telegram' => "$telegram",
                          ':password' => "$password"]);
        
        $_SESSION['logged_user'] = $login;
        header("Location: profile.php");
      }
      else{
        $errors[] = 'Аккаунт уже существует';
      }


    }



    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style/style.css">
    <title>Document</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign Up</h5>
            <form action='signup.php' method='post' class="form-signin">

            <?
              if(!empty($errors)){
                echo '<div class="alert  alert-danger">'.array_shift($errors).'</div>';
              }
            ?>

              <div class="form-label-group">
                <input name='login' type="text" id="inputLogin" class="form-control" placeholder="Логин" required autofocus>
                <label for="inputLogin">Логин</label>
              </div>

              <div class="form-label-group">
                <input  name='telegram' type="text" id="inputTelegram" class="form-control" placeholder="Логин" required autofocus>
                <label for="inputTelegram">Телеграм</label>
              </div>

              <div class="form-label-group">
                <input name='password' type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
                <label for="inputPassword">Пароль</label>
              </div>

              <button name='on_signup' class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">регистрация</button>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>