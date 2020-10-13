<?php
/**
 * Created by PhpStorm.
 * User: vitali
 * Date: 22.01.20
 * Time: 10:26
 */

class shopApiserverRunapp{

    public function isWebview($format){
        return ($format == 'webview') ? TRUE : FALSE;
    }

    public function getContactIdWaContactDataByApiToken($apiToken){
        $selectContactIdWaContactData = "SELECT `contact_id` FROM `wa_contact_data` WHERE `wa_contact_data`.`value` = ?;";
        $contactIdArr = (new waModel())->query($selectContactIdWaContactData, $apiToken)->fetchAll();
        if(!empty($contactIdArr)) {
            foreach ($contactIdArr as $arr) {
                $contactId = $arr['contact_id'];
                break;
            }
        }
        else {
            $contactId = NULL;
        }
        return $contactId;
    }

    //fullRest check
    public function isFullRest($format){
        return ($format == 'fullrest') ? TRUE : FALSE;
    }

    private function getLocale($contactId){
        $selectLocaleWaContact = "SELECT `locale` FROM `wa_contact` WHERE `id` = ? ";
        isset($contactId) ? $contactLocaleArr = (new waModel())->query($selectLocaleWaContact, $contactId)->fetchAll() : $contactLocale = NULL;
        foreach ($contactLocaleArr as $arr){
            $contactLocale = $arr['locale'];
        }
        return $contactLocale;
    }

    /*this function returns an array
    for the first app run:
        array(
            'id' => '',
            'api_token' =>'',
            'logo'=> '',
            'shop_name' => '',
            'status' => '',
            'url' => '',
            'locale' => '',)
    */

    public function appRunArrayFunc($contactId){
        $selectAllWaContacDataById = "SELECT * FROM `wa_contact_data` WHERE `contact_id`=? AND (`field`='status' OR `field`='api_token' OR `field`='url' OR `field`='logo' OR `field`='shop_name');";
        isset($contactId) ? $contactDataArr = (new waModel())->query($selectAllWaContacDataById, $contactId)->fetchAll() : $contactDataArr = NULL;

        //creating $appRunArray
        $appRunArray['id'] = $contactId;
        if (!empty($contactDataArr)){
            foreach ($contactDataArr as $arr){
                $key   = $arr['field'];
                $value = $arr['value'];
                $appRunArray[$key]=$value;
            }
            $url = $appRunArray['url'];
            $appRunArray['url'] = $this->getHttpStatus($url); //передали работает ли https или только http
            $contactLocale = $this->getLocale($contactId);
            !empty ($contactLocale) ? $appRunArray['locale'] = $contactLocale : $appRunArray['locale'] = "ru_RU";
        }

        return($appRunArray);
    }

    /*
     * insert if $pushToken not Exist
     * */
    public function shopPushTokensInsert($contactId, $shopApi, $pushApi){
        $selectApiTokenShopPushTokens = "SELECT * FROM `shop_push_tokens` WHERE `shop_api` = ? AND `push_api` = ?";
        $shopPushTokensArr = (new waModel())->query($selectApiTokenShopPushTokens, $shopApi, $pushApi)->fetchAll();
//    print_r($shopPushTokensArr);
        if(empty($shopPushTokensArr) &&isset($contactId)  &&isset($shopApi) &&isset($pushApi)){
            $shopApiserverModel = new shopApiserverModel();
            $shopApiserverModel->insert(array(
                'shop_id' => $contactId,
                'shop_api' => $shopApi,
                'push_api' => $pushApi,
            ));
        }
    }

    /*
    * @var url
    * return https://domain.com, if ssl,
    * http://domain.com if not ssl
    * FALSE if domain.com is not available */
    private function getHttpStatus($url)
    {
        //check host
        $urlHost = parse_url($url, PHP_URL_HOST);
        $urlHostHttps = 'https://' . $urlHost;

        $c = curl_init();
        curl_setopt($c, CURLOPT_NOBODY, true);
        curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($c, CURLOPT_URL, $urlHostHttps);
        $status = curl_exec($c);
//    $status = curl_getinfo($c, CURLINFO_HTTP_CODE);


        if ($status) {
            return $urlHostHttps;
            curl_close($c);
        } else {
            $urlHostHttp = 'http://' . $urlHost;
            curl_setopt($c, CURLOPT_URL, $urlHostHttp);
            $status = curl_exec($c);
            curl_close($c);

            //check http
            if ($status) {
                return $urlHostHttp;
            } //site
            else {
                return false;
            }

        }
    }
}