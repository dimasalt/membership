<?php

//--------------------------------------------------
//              account group routes
//--------------------------------------------------
$app->group('/account', function () {
    $this->get('/login', '\Membership\Controllers\AccountController:Index')->setName('login');
    $this->post('/dologin', '\Membership\Controllers\AccountController:DoLogin');
    $this->get('/forgotpassword', '\Membership\Controllers\AccountController:ForgotPassword');
    $this->post('/getpassword', '\Membership\Controllers\AccountController:GetPassword');
})->add(new \Membership\Middleware\NotLoggedIn());

//$app->post('/account/register', '\Membership\Controllers\AccountController:Register'); //temporary commented out


//--------------------------------------------------
//              user profile pages
//--------------------------------------------------
$app->get('/account/profile', '\Membership\Controllers\AccountController:UserProfile')->add(new Membership\Middleware\LoggedIn($app->getContainer()->get('router')));
$app->post('/account/changeprofile', '\Membership\Controllers\AccountController:ChangeUserProfile')->add(new Membership\Middleware\LoggedIn($app->getContainer()->get('router')));
$app->get('/account/logout', '\Membership\Controllers\AccountController:Logout')->setName('logout')->add(new \Membership\Middleware\LoggedIn($app->getContainer()->get('router')));

$app->get('/account/new_password', '\Membership\Controllers\AccountController:NewPassword')->add(new Membership\Middleware\LoggedIn($app->getContainer()->get('router')));
$app->post('/account/password_change', '\Membership\Controllers\AccountController:ChangePassword')->add(new Membership\Middleware\LoggedIn($app->getContainer()->get('router')));


//---------------------------------------------
//          API calls
//---------------------------------------------
//$app->group('/api', function (){
//    $this->post('/register[/{app_token}[/{program_id}]]', '\Membership\Controllers\AccountController:Register');
//})->add(new Membership\Middleware\HasAccessToAPI());


//------------------------------------------
//              contact us page
//------------------------------------------
$app->get('/contact', '\Membership\Controllers\SupportController:Index');
$app->post('/contact_send', '\Membership\Controllers\SupportController:SendSupportMessage');


//----------------------------------------------
//          Program pages
//----------------------------------------------
$app->get('/program/index/{program_id}', '\Membership\Controllers\ProgramController:Index');

$app->group('/program', function (){
    $this->get('/item/{program_id}/{item_id}', '\Membership\Controllers\ProgramController:DisplayItem');
    $this->post('/download', '\Membership\Controllers\ProgramController:DownloadFile'); //ajax

//    $this->get('/download/{program_id}/{file_id}', '\Membership\Controllers\ProgramController:DownloadFile');
})->add(new Membership\Middleware\HasAccessToProgram($app->getContainer()->get('router')));


//-----------------------------------------------
//          Order Pages
//-----------------------------------------------
$app->group('/order', function (){
    $this->get('/checkout/{program_id}', '\Membership\Controllers\OrderController:Index');
    $this->post('/charge[/{program_id}]', '\Membership\Controllers\OrderController:Charge');
    $this->get('/thank_you[/{txn_id}]', '\Membership\Controllers\OrderController:ThankYouPage')->setName('thankyou');
});

$app->get('/sp[/{page_id}]', '\Membership\Controllers\OrderController:SalesPage');


//-----------------------------------------------
//          admin routes
//-----------------------------------------------
$app->group('/admin', function () {
    $this->get('/index', '\Membership\Area\Admin\HomeController:Index');
    $this->get('/logs', '\Membership\Area\Admin\LogsController:Index');

    //admin profile
    $this->post('/getprofile', '\Membership\Area\Admin\HomeController:getProfile');


    //system pages
    $this->get('/system/logs', '\Membership\Area\Admin\SystemController:Logs');
    $this->post('/system/getlogs', '\Membership\Area\Admin\SystemController:getLogs');
    $this->post('/system/removeselectedlogs', '\Membership\Area\Admin\SystemController:removeSelectedLogs');
    $this->post('/system/removealllogs', '\Membership\Area\Admin\SystemController:removeAllLogs');

    $this->get('/system/sqlbackup', '\Membership\Area\Admin\SystemController:SQLBackup');
    $this->get('/system/takesqlbackup', '\Membership\Area\Admin\SystemController:GetSqlBackup');

    //transactions
    $this->get('/transactions', '\Membership\Area\Admin\TransactionController:index');
    $this->post('/transactions/getTransactions', '\Membership\Area\Admin\TransactionController:getTransactions');
    $this->post('/transactions/getTodayTransactions', '\Membership\Area\Admin\TransactionController:getTodayTransactions');
})->add(new \Membership\Middleware\IsAdmin($app->getContainer()->get('router')));


//-----------------------------------------------
//          legal pages
//------------------------------------------------
$app->get('/terms', '\Membership\Controllers\LegalController:Terms');
$app->get('/disclaimer', '\Membership\Controllers\LegalController:Disclaimer');
$app->get('/privacy', '\Membership\Controllers\LegalController:Privacy');


//---------------------------------------------
//          IPN and Hooks calls
//---------------------------------------------
$app->any('/ipn/paypalstandard', '\Area\Ipn\PaypalIPN:Index');
$app->any('/webhooks/stripe', '\Area\WebHooks\StripeHooks:Index');



//website main/index route
$app->get('/', '\Membership\Controllers\HomeController:index')->setName('home');

