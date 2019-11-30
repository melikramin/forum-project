<?php
  setcookie('login',"", time() - 3600 * 24 * 30, "/");
  setcookie('userID',"", time() - 3600 * 24 * 30, "/");
  //unset($_COOKIE['login']);
  //unset($_COOKIE['userID']);
  echo true;
?>
