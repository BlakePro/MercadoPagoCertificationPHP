<?php include 'config.php';

  header('Content-Type: application/json');
  $request = file_get_contents('php://input');
  $write = print_r($request, TRUE)."\n";
  $file = fopen('webhook.txt', 'a+') or die('Unable to open');
  fwrite($file, $write);
  fclose($file);
  echo 'WEBHOOK';
