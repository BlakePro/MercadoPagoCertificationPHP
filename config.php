<?php
  include 'vendor/autoload.php';

  define('EMAIL', 'cristian@i20veinte.com');
  define('CREATOR', 'Cristian Yosafat Hernandez Ruiz');
  define('PHONE', '+5215527683072');
  define('URL_GITHUB', 'https://github.com/BlakePro/MercadoPagoCertificationPHP');
  define('URL', 'https://ezequiel.software/mercadopago/');
  define('URL_WEBHOOK', URL.'webhook');

  define('TEST_USER', 'test_user_58295862@testuser.com');
  define('INTEGRATOR_ID', 'dev_24c65fb163bf11ea96500242ac130004');
  define('ACCESS_TOKEN', 'APP_USR-8058997674329963-062418-89271e2424bb1955bc05b1d7dd0977a8-592190948');

  define('PICTURE_URL', URL.'iphone.png');
  define('MODE', 'redirect');
  define('UNIT_TITLE', 'Sony Xperia XZ2');
  define('UNIT_DESCRIPTION', '"Dispositivo móvil de Tienda e-commerce​"​');
  define('UNIT_PRICE', 10000);


  $arr_excluded_payment_types = [
    //'account_money',
    'atm',
    'bank_transfer',
    //'credit_card',
    'debit_card',
    'digital_currency',
    'digital_wallet',
    'prepaid_card',
    'ticket',
    'voucher_card'
  ];

  $arr_excluded_payment_methods = [
    //'visa' => 'credit_card',
    'amex' => 'credit_card',
    //'master' => 'credit_card',
    'debmaster' => 'debit_card',
    'serfin' => 'atm',
    'bancomer' => 'atm',
    'banamex' => 'atm',
    'oxxo' => 'ticket',
    'mercadopagocard' => 'prepaid_card',
    //'account_money' => 'account_money',
    'consumer_credits' => 'digital_currency'
  ];

  //ARRAY DOCUMENTATION LINK
  $array_doc_href = [
    'https://docs.google.com/forms/d/e/1FAIpQLScgQ5sfdmE-nASv8lwO0tSuIMVWyzT5rk68OwirBudPnICVGA/viewform',
    'https://api.mercadopago.com/payment_types/',
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

  function icon($icon){
    if($icon == 'wallet'){
      return '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-wallet2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M2.5 4l10-3A1.5 1.5 0 0 1 14 2.5v2h-1v-2a.5.5 0 0 0-.5-.5L5.833 4H2.5z"/>
              <path fill-rule="evenodd" d="M1 5.5A1.5 1.5 0 0 1 2.5 4h11A1.5 1.5 0 0 1 15 5.5v8a1.5 1.5 0 0 1-1.5 1.5h-11A1.5 1.5 0 0 1 1 13.5v-8zM2.5 5a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h11a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-11z"/>
            </svg>';
    }elseif($icon == 'check'){
      return '<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-bag-check" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M14 5H2v9a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V5zM1 4v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4H1z"/>
        <path d="M8 1.5A2.5 2.5 0 0 0 5.5 4h-1a3.5 3.5 0 1 1 7 0h-1A2.5 2.5 0 0 0 8 1.5z"/>
        <path fill-rule="evenodd" d="M10.854 7.646a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 10.293l2.646-2.647a.5.5 0 0 1 .708 0z"/>
      </svg>';
    }
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
