<?php
return array (
  'priceuploader.com' => 
  array (
    'auth' => true,
    'fields' => 
    array (
      'firstname' => 
      array (
        'caption' => 'Имя',
        'placeholder' => '',
      ),
      'lastname' => 
      array (
        'caption' => 'Фамилия',
        'placeholder' => '',
      ),
      'password' => 
      array (
        'caption' => 'Пароль',
        'placeholder' => '',
        'required' => true,
      ),
      'email' => 
      array (
        'caption' => 'Email',
        'placeholder' => '',
        'required' => true,
      ),
      'phone' => 
      array (
        'caption' => 'Телефон',
        'placeholder' => '',
      ),
      'address' => 
      array (
        'caption' => 'Адрес',
        'placeholder' => '',
      ),
      'url' => 
      array (
        'caption' => 'Веб-сайт',
        'placeholder' => '',
      ),
    ),
    'params' => 
    array (
      'service_agreement' => '',
      'service_agreement_text' => '',
      'button_caption' => 'Регистрация',
      'confirm_email' => false,
    ),
    'route_url' => 'updater/*',
    'app' => 'updater',
    'auth_type' => 'user_password',
    'signup_confirm' => false,
    'signup_notify' => true,
    'onetime_password_timeout' => '60',
    'confirmation_code_timeout' => '60',
    'recovery_password_timeout' => '60',
    'can_login_by_contact_login' => true,
    'used_auth_methods' => 
    array (
      0 => 'email',
    ),
    'priority_auth_method' => '',
    'signup_captcha' => false,
    'login_captcha' => 'always',
    'rememberme' => true,
    'login_caption' => 'Email',
    'login_placeholder' => 'Email',
    'password_placeholder' => '',
  ),
  'vm10464.fozzyhost.com' => 
  array (
    'auth' => true,
    'fields' => 
    array (
      'firstname' => 
      array (
        'caption' => 'First name',
      ),
      'lastname' => 
      array (
        'caption' => 'Last name',
      ),
      'password' => 
      array (
        'caption' => 'Password',
        'required' => true,
      ),
      'email' => 
      array (
        'caption' => 'Email',
        'required' => true,
      ),
    ),
    'params' => 
    array (
      'confirm_email' => true,
    ),
    'signup_confirm' => true,
  ),
);
