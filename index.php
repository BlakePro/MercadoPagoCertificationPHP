<?php require_once 'vendor/autoload.php';

  define('EMAIL', 'cristian@i20veinte.com');
  define('URL_GITHUB', 'https://github.com/BlakePro/MercadoPagoCertificationPHP');
  define('URL', 'https://ezequiel.software/mercadopago/');

  define('TEST_USER', 'test_user_88281084@testuser.com');
  define('INTEGRATOR_ID', 'dev_24c65fb163bf11ea96500242ac130004');
  define('ACCESS_TOKEN', 'APP_USR-2827457341168958-041607-755d8c9f5cd6bd292cff47d0cd9fdfbf-535650015');
  //{"id":592148149,"nickname":"TESTYXARW8RJ","password":"qatest4645","site_status":"active","email":"test_user_88281084@testuser.com"}

  define('PICTURE_URL', URL.'iphone.png');
  define('MODE', 'redirect');

  //START SDK MERCADOAPAGO AND INTEGRATION
  MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);
  MercadoPago\SDK::setIntegratorId(INTEGRATOR_ID);

  //NEW PREFERENCE
  $preference = new MercadoPago\Preference();

  //BACK URL
  $preference->back_urls = ['success' => URL.'success', 'failure' => URL.'failure', 'pending' => URL.'pending'];
  $preference->auto_return = 'approved';

  //NOTIFICATION URL
  $preference->notification_url = URL.'webhook';

  //ADITIONAL INFO
  $preference->additional_info = EMAIL;

  //ITEM
  $arr_items = [];
  $item = new MercadoPago\Item();
  $item->id = '1234';
  $item->title = 'iPhone 11​';
  $item->description = 'Dispositivo móvil de Tienda e-commerce​';
  $item->picture_url = PICTURE_URL;
  $item->category_id = 'Móviles';
  $item->quantity = 1;
  $item->currency_id = 'MXN';
  $item->unit_price = 9997.30;
  $arr_items[] = $item;
  $preference->items = $arr_items;

  //PAYER
  $payer = new MercadoPago\Payer();
  $payer->first_name = 'Lalo';
  $payer->last_name = 'Landa';
  $payer->email = TEST_USER;
  $payer->phone = ['area_code' => '52', 'number' => '​5549737300'];
  $payer->address = ['zip_code' => '03940', 'street_name' => 'Insurgentes Sur', 'street_number' => 1602];
  $preference->payer = $payer;

  //PAYMENT METHOD / EXCLUDED
  $preference->payment_methods = [
    'excluded_payment_methods' => [
      ['id' => 'MLMAM'],
      ['id' => 'amex'],
    ],
    'excluded_payment_types' => [
      ['id' => 'atm']
    ],
    'installments' => 6
  ];

  //EXTERNAL REFERENCE
  $preference->external_reference = EMAIL;

  //SAVE PREFERENCE
  $preference->save();

  //PREFERENCE ID
  $preference_id = $preference->id;

  //GET PREFERENCE
  $preference_url = "https://api.mercadopago.com/checkout/preferences/{$preference_id}?access_token=".ACCESS_TOKEN;
  $preference_arr = json_decode(fetch($preference_url), TRUE);

  //CURL NEW USER
  $curl_new_user = 'curl -X POST -H "Content-Type: application/json" "https://api.mercadopago.com/users/test_user?access_token='.ACCESS_TOKEN.'" -d \'{"site_id":"MLM"}\'';

  //END PREFERENCE -- START HTML

  //TYPE MODE
  if(MODE == 'modal')$mode_checkout = '<form method="POST"><script src="https://www.mercadopago.com.mx/integrations/v1/web-payment-checkout.js" data-preference-id="'.$preference_id.'" data-button-label="Pagar la Compra"></script></form>';
  elseif(MODE == 'redirect')$mode_checkout = '<a class="btn btn-primary btn-block btn-lg my-3" href="'.$preference->init_point.'">Pagar la Compra</a>';

  //ARRAY DOCUMENTATION LINK
  $array_doc_href = [
    'https://www.mercadopago.com.mx/developers/es/reference/preferences/_checkout_preferences/post',
    'https://api.mercadolibre.com/sites/MLM',
    'https://api.mercadolibre.com/payment_types',
    'https://api.mercadolibre.com/payment_methods/MLMAM'
  ];
  $html_docs = '<ul>';
  foreach($array_doc_href as $no => $href)$html_docs .= "<li><a class='text-truncate' target='_blank' href='{$href}'>{$href}</a></li>";
  $html_docs .= '</ul>';

  $col_1 = "<a href='https://i20veinte.com' target='_blank'><img src='https://i20veinte.com/img/logo.png' alt='i20veinte' class='img-fluid mx-auto d-block' style='max-height:90px'></a>
              <div class='card my-3 p-3' style='width: 100%;'>
              <img src='".PICTURE_URL."' class='card-img-top img-fluid mx-auto d-block' style='max-width:90px' alt='iPhone i20veinte'>
              <div class='card-body'>
                <h5 class='card-title'>iPhone 11​</h5>
                <p class='card-text'>Dispositivo móvil de Tienda e-commerce​</p>
                <a href='#' class='btn btn-secondary' disabled>Agregado</a>
              </div>
            </div>{$mode_checkout}<h6 class='mb-3 text-right'><a class='text-decoration-none text-secondary' href='https://i20veinte.com'>i20veinte.com</a></h6>";

  $col_2 = "<h4>Preference ID</h4><p>{$preference_id}</p>
            <h4>Code GitHub</h4><p><a target='_blank' href='".URL_GITHUB."'>".URL_GITHUB."</a></p>
            <h4>Preference</h4><textarea rows='17' class='form-control code mb-2'>".print_r($preference_arr, TRUE)."</textarea>
            <h4>Curl User</h4><textarea rows='2' class='form-control code mb-2'>{$curl_new_user}</textarea>
            <h4>Documentation / Api</h4>{$html_docs}
            <h5>Made with ❤️ 🇲🇽</h5>
              <p><a class='text-decoration-none text-secondary' href='https://github.com/BlakePro'>Cristian Yosafat Hernández Ruiz</a><br>
              <a class='text-decoration-none text-secondary' href='mailto:".EMAIL."'>".EMAIL."</a> | <a class='text-decoration-none text-secondary' href='tel:+5215527683072'>5527683072</a>";

  //HTML (MODE REDIRECT ML)
  echo '<html>
          <head>
            <title>MercadoPago Certification</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
          </head>
          <body>
            <div class="p-3">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-2">
                  '.$col_1.'
                </div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-10">
                  '.$col_2.'
                </div>
              </div>
            </div>
          </body>
          <script src="https://.mercadopago.com/v2/security.js" view="item"></script>
        </html>';

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
