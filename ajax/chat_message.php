<?php
  $message = trim(filter_var($_POST['message'], FILTER_SANITIZE_STRING));

  // Если длина сообщения равна нулю, то просто выходим из скрипта
  if(strlen($message) == 0)
    exit();

  require_once '../mysql_connect.php';

  // Добавляем сообщение в базу данных
  $sql = 'INSERT INTO chat(message) VALUES(?)';
  $query = $pdo->prepare($sql);
  $query->execute([$message]);
?>
