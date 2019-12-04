<?php
  session_start();
  unset($_SESSION['u_id']);
  session_unset();
  session_destroy();
  header('Location: index.php');
?>