<?php

class shopOAuthController extends waOAuthController
{
    public function afterAuth($data)
    {
        $params = $this->getStorage()->get('auth_params');
        if (isset($params['guest']) && $params['guest']) {
            $this->getStorage()->set('auth_user_data', $data);
        } else {
            $contact = parent::afterAuth($data);
            if ($contact && !$contact['is_user']) {
                $contact->addToCategory($this->getAppId());
            }
        }

        wa('webasyst');
        $this->executeAction(new webasystOAuthAction());
    }

    protected function getAuthAdapter($provider)
    {
        if ($provider == 'api_courier') {
            return new shopCourierAuthAdapter();
        }
        return parent::getAuthAdapter($provider);
    }
}
