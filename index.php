<?php include 'config.php';

  //START SDK MERCADOAPAGO AND INTEGRATION
  MercadoPago\SDK::setAccessToken(ACCESS_TOKEN);
  MercadoPago\SDK::setIntegratorId(INTEGRATOR_ID);

  //NEW PREFERENCE
  $preference = new MercadoPago\Preference();

  //BACK URL
  $preference->back_urls = ['success' => URL.'success', 'failure' => URL.'failure', 'pending' => URL.'pending'];
  $preference->auto_return = 'approved';

  //NOTIFICATION URL
  $preference->notification_url = URL_WEBHOOK;

  //ADITIONAL INFO
  $preference->additional_info = URL;

  //ITEM
  $arr_items = [];
  $item = new MercadoPago\Item();
  $item->category_id = 'Móviles';
  $item->currency_id = 'MXN';
  $item->description = UNIT_DESCRIPTION;
  $item->id = '1234';
  $item->picture_url = PICTURE_URL;
  $item->quantity = 1;
  $item->title = UNIT_TITLE;
  $item->unit_price = UNIT_PRICE;

  $arr_items[] = $item;
  $preference->items = $arr_items;

  //PAYER
  $payer = new MercadoPago\Payer();
  $payer->name = 'Lalo';
  $payer->surname = 'Landa';
  $payer->email = TEST_USER;
  $payer->phone = ['area_code' => '52', 'number' => '5549737300'];
  $payer->address = ['zip_code' => '03940', 'street_name' => 'Insurgentes Sur', 'street_number' => 1602];
  $preference->payer = $payer;

  $excluded_payment_methods = [];
  foreach($arr_excluded_payment_methods as $id_excluded => $type_excluded)$excluded_payment_methods[] = ['id' => $id_excluded];

  $excluded_payment_types = [];
  foreach($arr_excluded_payment_types as $no => $id_excluded)$excluded_payment_types[] = ['id' => $id_excluded];

  //PAYMENT METHOD / EXCLUDED
  $preference->payment_methods = [
    'excluded_payment_methods' => $excluded_payment_methods,
    'excluded_payment_types' => $excluded_payment_types,
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
  elseif(MODE == 'redirect')$mode_checkout = '<a class="btn btn-primary btn-block btn-lg my-3" target="_blank" href="'.$preference->init_point.'">'.icon('wallet').' Pagar la Compra</a>';

  //ARRAY DOCUMENTATION LINK
  $html_docs = '<ul>';
  foreach($array_doc_href as $no => $href)$html_docs .= "<li><a class='text-truncate' target='_blank' href='{$href}'>{$href}</a></li>";
  $html_docs .= '</ul>';

  $col_1 = "<a href='https://i20veinte.com' target='_blank'><img src='https://i20veinte.com/img/logo.png' alt='i20veinte' class='img-fluid mx-auto d-block' style='max-height:90px'></a>
              <div class='card my-3 p-3' style='width: 100%;'>
              <img src='".PICTURE_URL."' class='card-img-top img-fluid mx-auto d-block' style='max-width:90px' alt='i20veinte example product'>
              <div class='card-body text-center'>
                <h5 class='card-title'>".UNIT_TITLE."​</h5>
                <p class='card-text'>Dispositivo móvil de Tienda e-commerce​</p>
                <p class='card-text text-bold'>$".number_format(UNIT_PRICE, 2, '.', ',')."</p>
                <a href='#' class='btn btn-secondary' disabled>".icon('check')." Agregado</a>
              </div>
            </div>{$mode_checkout}
            <div class='text-center pt-4'>
              <h5>Made with ❤️ 🇲🇽</h5>
              <p><a class='text-decoration-none text-secondary' href='https://github.com/BlakePro'>".CREATOR."</a><br>
              <a class='text-decoration-none text-secondary' href='mailto:".EMAIL."'>".EMAIL."</a><br><a class='text-decoration-none text-secondary' href='tel:+".PHONE."'>".PHONE."</a>
              <h6 class='mb-3'><a class='text-decoration-none text-secondary' href='https://i20veinte.com'>i20veinte.com</a></h6>
            </div>";

  $table_accounts = '<table class="table table-striped"> <tbody><tr> <th>Tarjeta</th> <th>Número</th> <th>CVV</th> <th>Fecha de vencimiento</th> </tr> <tr> <td>Mastercard</td> <td>5031 7557 3453 0604</td> <td>123</td> <td>11/25</td> </tr> <tr> <td>Visa</td> <td>4170 0688 1010 8020</td> <td>123</td> <td>11/25</td> </tr> <tr> <td>American Express</td> <td>3711 8030 3257 522</td> <td>1234</td> <td>11/25</td> </tr> </tbody></table>';

  $col_2 = "<h4>Preference ID</h4><p>{$preference_id}</p>
            <h4>Code GitHub</h4><p><a target='_blank' href='".URL_GITHUB."'>".URL_GITHUB."</a></p>
            <h4>Preference</h4><a href='{$preference_url}' target='blank'>{$preference_url}</a><textarea rows='17' class='form-control code mb-2'>".print_r($preference_arr, TRUE)."</textarea>
            <h4>Curl User</h4><textarea rows='2' class='form-control code mb-2'>{$curl_new_user}</textarea>
            <h4>Accounts</h4>{$table_accounts}
            <h4>Submit / Documentation / Api</h4>{$html_docs}";

  //HTML (MODE REDIRECT ML)
  echo '<html>
          <head>
            <title>MercadoPago Certification</title>
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
            <style>svg{margin-bottom: 6px; margin-right: 5px;}</style>
          </head>
          <body>
            <div class="p-3">
              <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-3">
                  '.$col_1.'
                </div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 col-xl-9">
                  '.$col_2.'
                </div>
              </div>
            </div>
          </body>
          <script src="https://www.mercadopago.com/v2/security.js" view="home"></script>
        </html>';
