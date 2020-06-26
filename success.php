<?php include 'config.php';
  pre($_REQUEST);

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
    pre($fetch);
  }
  //GET PAYMENT
