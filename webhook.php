<?php include 'config.php';

  header('Content-Type: application/json');
  $request = file_get_contents('php://input');
  $write = print_r($request, TRUE)."\n";
  $file = fopen('webhook.txt', 'a+') or die('Unable to open');
  fwrite($file, $write);

  /*
  $now = DateTime::createFromFormat('U.u', microtime(true));
  $time = $now->format("Y-m-d H:i:s.u");
  $write = "NEW -> ".json_encode($_REQUEST).' ('.$time.")\n";
  $file = fopen('webhook.txt', 'a+') or die('Unable to open');
  fwrite($file, $write);
  /
  /*
  //GET PAYMENT
  if(array_key_exists('type', $_REQUEST))$type = $_REQUEST['type'];
  elseif(array_key_exists('topic', $_REQUEST))$type = $_REQUEST['topic'];
  else $type = '';

  if(array_key_exists('id', $_REQUEST))$id = $_REQUEST['id'];
  elseif(array_key_exists('data_id', $_REQUEST))$id = $_REQUEST['data_id'];
  else $id = '';

  if($type == 'payment' && $id != ''){

    $payment_url = "https://api.mercadopago.com/v1/payments/{$id}?access_token=".ACCESS_TOKEN;
    $fetch = fetch($payment_url);
    if($fetch != ''){
      $write = "URL -> {$payment_url}\nPAYMENT -> {$fetch}\n\n";
      fwrite($file, $write);
    }
  }
  //GET PAYMENT
  */
  fclose($file);
  echo 'WEBHOOK';
