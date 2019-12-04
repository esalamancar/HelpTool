<?php
  session_start();

  if (isset($_SESSION['u_id'])) {
    header('Location: /login2/home.php');
  }
  else{
    header('Location: /login2/ingreso.php');
  }
?>
