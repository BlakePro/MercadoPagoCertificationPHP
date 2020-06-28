<?php include 'config.php';
  echo '<h2>REQUEST</h2>';
  pre($_REQUEST);

  //GET PAYMENT
  if(array_key_exists('collection_id', $_REQUEST))$id = $_REQUEST['collection_id'];
  elseif(array_key_exists('data_id', $_REQUEST))$id = $_REQUEST['data_id'];
  elseif(array_key_exists('id', $_REQUEST))$id = $_REQUEST['id'];
  else $id = '';

  if(is_numeric($id)){

    if(array_key_exists('preference_id', $_REQUEST))$preference_id = $_REQUEST['preference_id'];
    else $preference_id = '';

    echo "<hr><h2>TO SEND TO FORM</h2>
    <p>".EMAIL."</p>
    <p>".CREATOR."</p>
    <p>+5215527683072</p>
    <p>{$preference_id}</p>
    <p>{$id}</p>
    <p>".URL."</p>
    <p>".TEST_USER."</p>";
    echo fetch(URL_WEBHOOK.'.txt');

    $payment_url = "https://api.mercadopago.com/v1/payments/{$id}?access_token=".ACCESS_TOKEN;
    echo "<hr><h2>PAYMENT DATA</h2><p><a href='{$payment_url}' target='_blank'>{$payment_url}</a></p>";
    $fetch = json_decode(fetch($payment_url), TRUE);
    pre($fetch);
  }
  //GET PAYMENT
