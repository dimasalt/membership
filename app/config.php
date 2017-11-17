<?php

///**************************************************
// *              Development environment
// * ************************************************/
return array(
    "db" => array(
        "dsn" => 'mysql:host=localhost;dbname=membership;charset=utf8',
        "host" => "localhost",
        "database" => "membership",
        "username" => "root",
        "password" => "30e8a496f64cbf231",
    ),
    "mail" => array(
        "host" => 'smtp.zoho.com',
        "port" => '465', //ssl port
        "ssl" => true,
        "tls" => false,
        "require_auth" => true,
        "username" => 'dmitri@better-life-tips.com',
        "password" => 'Q74V(;7P8;F6xEk',
        "from" => 'dmitri@better-life-tips.com'
    ),
    "crm" => array(
        "url" => 'https://fulfilledlife.api-us1.com',
        "key" => '67087cf6113d6f3d7c55e919846b274b5e3fd12a2dba6b9a4725861148ef19fff8affb18'
    ),
    "paypal" => array(
        "url" => 'https://www.sandbox.paypal.com/cgi-bin/webscr'
    ),
    "stripe" => array(
        "secret_key" => 'sk_test_Lt4F7cOGbGFIVFFpq0VgG1ZF',
        "publishable_key" => "pk_test_t6e1YQaRC36zwflvQ7SkLv8O"
    ),
    "aws_s3" => array(
        'key' => 'AKIAIUNXP4DB47YNLYWA',
        'secret' => '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',
        'bucket' => 'www.memberstr.com'
    ),
    'aws_cloudfront' => array(
        'url' => 'https://d1kxu5yzl4taf2.cloudfront.net',
        'private_key' => INC_ROOT . '/app/pk-APKAIVCTPQAHLGNT3GMQ.pem',
        'key_pair_id' => 'APKAIVCTPQAHLGNT3GMQ'
    ),
    "website_url" => 'membership.dev',
    "app_token" => '51092c5b070f25d9c4eef87d08f3b86decad4570',
    "temp_password" => '8P4Q3gPS'
);


///**************************************************
// *              DigitalOcean
// * ************************************************/
//return array(
//    "db" => array(
//        "dsn" => 'mysql:host=localhost;dbname=membership;charset=utf8',
//        "host" => "localhost",
//        "database" => "membership",
//        "username" => "membership_user",
//        "password" => "30e8a496f64cbf231",
//    ),
//    "mail" => array(
//        "host" => 'smtp.zoho.com',
//        "port" => '465', //ssl port
//        "ssl" => true,
//        "tls" => false,
//        "require_auth" => true,
//        "username" => 'dmitri@better-life-tips.com',
//        "password" => 'Q74V(;7P8;F6xEk',
//        "from" => 'dmitri@better-life-tips.com'
//    ),
//    "crm" => array(
//        "url" => 'https://fulfilledlife.api-us1.com',
//        "key" => '67087cf6113d6f3d7c55e919846b274b5e3fd12a2dba6b9a4725861148ef19fff8affb18'
//    ),
//    "paypal" => array(
//        "url" => 'https://www.paypal.com/cgi-bin/webscr'
//        "url" => 'https://www.sandbox.paypal.com/cgi-bin/webscr'
//    ),
//    "stripe" => array(
//        "secret_key" => 'sk_test_Lt4F7cOGbGFIVFFpq0VgG1ZF',
//        "publishable_key" => "pk_test_t6e1YQaRC36zwflvQ7SkLv8O"
//    ),
//    "website_url" => 'membership.dev',
//    "app_token" => '51092c5b070f25d9c4eef87d08f3b86decad4570',
//    "temp_password" => '8P4Q3gPS'
//);

