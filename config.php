<?php
  include 'vendor/autoload.php';

  define('EMAIL', 'cristian@i20veinte.com');
  define('URL_GITHUB', 'https://github.com/BlakePro/MercadoPagoCertificationPHP');
  define('URL', 'https://ezequiel.software/mercadopago/');

  define('TEST_USER', 'test_user_58295862@testuser.com');
  define('INTEGRATOR_ID', 'dev_24c65fb163bf11ea96500242ac130004');
  define('ACCESS_TOKEN', 'APP_USR-8058997674329963-062418-89271e2424bb1955bc05b1d7dd0977a8-592190948');

  define('PICTURE_URL', URL.'iphone.png');
  define('MODE', 'redirect');
  define('UNIT_NAME', strval('Nombre del producto seleccionado del carrito del ejercicio​.'));
  define('UNIT_PRICE', 16000);

  /*$arr_excluded_payment_methods = ['MLMMP', 'MLMPO', 'MLMMO', 'MLMCH', 'MLMWT', 'MLMWC', 'MLMAM', 'MLMTD',
   'amex', 'prepaid_card', 'digital_currency', 'debit_card', 'atm', 'bank_transfer', 'ticket', 'banamex', 'serfin', 'bancomer', 'consumer_credits', 'oxxo', 'mercadopagocard'];
   */

  $arr_excluded_payment_methods = ['MLMMP', 'MLMPO', 'MLMMO', 'MLMCH', 'MLMWT', 'MLMWC', 'MLMAM', 'MLMTD',
   'amex', 'prepaid_card', 'digital_currency', 'debit_card', 'atm', 'bank_transfer', 'ticket', 'banamex', 'serfin', 'bancomer', 'consumer_credits', 'oxxo', 'mercadopagocard',
   'debit_card', 'prepaid_card', 'ticket', 'atm', 'ticket', 'bank_transfer'];

  //ARRAY DOCUMENTATION LINK
  $array_doc_href = [
    'https://www.mercadopago.com.mx/developers/es/reference/preferences/_checkout_preferences/post',
    'https://api.mercadolibre.com/sites/MLM',
    'https://api.mercadopago.com/payment_types',
    'https://api.mercadopago.com/sites/MLM/payment_methods',
    'https://www.mercadopago.com.mx/developers/en/guides/payments/api/other-payment-ways/',
    'https://www.mercadopago.com.mx/developers/en/guides/notifications/webhooks'
  ];

  function pre($array){
    echo '<pre>',print_r($array, TRUE),'</pre>';
  }
  
  function fetch($url){
    if($url != ''){
      $timeout = 90;
      $user_agent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.97 Safari/537.36';
      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
      curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
      curl_setopt($curl, CURLOPT_TIMEOUT, $timeout);
      curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);
      $content = curl_exec($curl);
      curl_close($curl);
      return trim($content);
    }
  }
