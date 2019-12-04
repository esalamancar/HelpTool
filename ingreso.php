<?php
  require 'templates/db.php';

  session_start();
  $s=0;

  if (!empty($_POST['em']) && !empty($_POST['pw'])) {
    $stmt = $connect->prepare('SELECT id_u, email, pw FROM usuarios WHERE email = :em');
    $stmt->bindParam(':em', $_POST['em']);
    $pass = hash(sha256, $_POST['pw']);
    $stmt->execute();
    $res=$stmt->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if (count($res) > 1){
      if ($pass===$res['pw']) {
        $_SESSION['u_id'] = $res['id_u'];
        header('Location: /login2/home.php');
      }
      else{
        $message = 'Contraseña Incorrecta';
      }
    }
    else{
      $message = 'Usuario Incorrecto';
    }
  }
  else{
    if ($s==0) {
      $s=1;
    }
    else{
        $message = 'Complete los campos';
    }
  }

?>

<html>
  <head>
    <title>Inicio | Erick Salamanca</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel=”shortcut icon” type=”image/png” href=”favicon.ico”>
  </head>
<body>
    <div id="cont">
      <div id="pannel2">
        <div id="artic">
          <h1>Login</h1>
          <form method="POST" action="ingreso.php">
              <input type="text" placeholder="Email" name="em" required>
              <input type="password" placeholder="Contraseña" name="pw" required>
              <input type="submit" name="Ingresar" value="Ingresar">
          </form>
          <br>
          <p id="alerta">
            <?php if(!empty($message)): ?>
              <?= $message ?>
            <?php endif; ?>
          </p>
          <p>
            <a href="registro.php">Registrame</a>
          </p>
        </div>
        
      </div>
    </div>
    <?php require 'templates/footer.php' ?>
</body>

</html>
