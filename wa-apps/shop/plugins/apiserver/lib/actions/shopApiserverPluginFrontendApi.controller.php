<?php


class shopApiserverPluginFrontendApiController extends waJsonController
{

    public function execute()
    {
        print_r(waRequest::post());
//        waRequest::post('post',)
        $actionName = shopApiserverActionsList::getActionIfExist(waRequest::post('action')); //get action Name
        $format     = waRequest::param('format'); // webview || fullRestApi test
        $apiToken   = waRequest::get('api_token');
        $pushToken  = waRequest::post('push_token');
//        print_r($apiToken);
        $this->response = array("apiToken" => $apiToken);
     //   !empty ($actionName) ? $this->$actionName($format,$apiToken,$pushToken) : $this->setErrorReturnFalse('action not exist');

    }



    /*
     * here here are the actions, the list of which is in
     * the array $actionsArray -> shopApiserverActionsList:
     * array ('action_name'=>'actionName')*/

    function runApp($format,$apiToken,$pushToken){
        $shopApiserverRunApp = new shopApiserverRunapp();
        if ($shopApiserverRunApp->isWebview($format)) { //webview check
            isset($apiToken) ? : $result = $this->setErrorReturnFalse('api_token missed'); //check api_token
            isset($pushToken) ? : $result = $this->setErrorReturnFalse('push_token missed'); //check push_token

            $contactId = $shopApiserverRunApp->getContactIdWaContactDataByApiToken($apiToken);
            isset ($contactId) ? : $result = $this->setErrorReturnFalse('api_token not found'); //check push_token;

            $result['result'] = $shopApiserverRunApp->appRunArrayFunc($contactId);
            $this->response = array('result' => $result);
            $shopApiserverRunApp->shopPushTokensInsert($contactId, $apiToken, $pushToken); //insert new push_token if not exist
        }
        else {
            $this->setErrorReturnFalse('wrong or skipped /format/?');
        }
    }

    function setErrorReturnFalse ($errorMessage){
        $this->setError(_wp($errorMessage));
        $result = FALSE;
        $this->response = array('result' => $result);
    }

}