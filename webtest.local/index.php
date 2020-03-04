<?php      

  unset($_SESSION['logged_user']);

  require "pages/connection.php";

  
  $errors = array();

  $login = $_POST['login'];
  $password = $_POST['password'];

  $query = "SELECT `login`,`password` FROM `profile` WHERE `login` = '$login';";
  $result = $pdo->query($query,PDO::FETCH_ASSOC);
  
  $profile = $result->fetch();


  if( isset($_POST['do_login'])){

    if($login == ''){
      $errors[] = "Введите логин";
    }
    elseif($password == ''){
      $errors[] = "Введите пароль";
    }
    else{
      if ($_POST['login'] == $profile['login']) {
        if($_POST['password'] == $profile['password']){
          $_SESSION['logged_user'] = $profile['login'];
          header("Location: /pages/profile.php");
        }
        else{
          $errors[] = "Неправильный пароль";
        }
      }
      else{
        $errors[] = "Неправильный логин";
      }
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
    <link rel="stylesheet" href="style/style.css">
    <title>Document</title>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Sign In</h5>

            
            <?
              if(!empty($errors)){
                echo '<div class="alert  alert-danger">'.array_shift($errors).'</div>';
              }
            ?>
            

            <form action="index.php" method="post" class="form-signin">

            <div class="form-label-group">
              
                <input name='login' type="text" id="inputLogin" class="form-control login" placeholder="Логин" required autofocus>
                <label for="inputLogin">Логин</label>
              </div>
            

              <div class="form-label-group">
                <input name='password' type="password" id="inputPassword" class="form-control password" placeholder="Пароль" required>
                <label for="inputPassword">Пароль</label>
              </div>
              <button class="login-btn btn btn-lg btn-primary btn-block text-uppercase" type='submit' name="do_login">вход</button>
              <a href="pages/signup.php" class='creat-acc'>Создать аккаунт</a>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>