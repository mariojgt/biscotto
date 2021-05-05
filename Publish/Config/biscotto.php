<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cookie you wish to remove if the user don't allow them
    |--------------------------------------------------------------------------
    |
    | If you know the cookies name you wish to remove
    | Once the user don't allow, if you don't know the cookie you can setup
    | The varaible test mode to true it will show all the cookie inf you browser
    |
    */

    'cookie_functional' => [

    ],
    // Example
    'cookie_statstics' => [
        '_ga','_gid','_gat_gtag_UA_152696431_2'
    ],
    'cookie_marketing' => [

    ],

    /*
    |--------------------------------------------------------------------------
    | Script, iframe id to disable
    |--------------------------------------------------------------------------
    |
    | In here you can target scripts an disable or enable them
    |
    |
    |
    */

    'script_cookie_functional' => 'script_cookie_functional',
    'script_cookie_statstics'  => 'script_cookie_statstics',
    'script_cookie_marketing'  => 'script_cookie_marketing',

    /*
    |--------------------------------------------------------------------------
    | Debug mode
    |--------------------------------------------------------------------------
    |
    | If you looking for cookie or scripts to disable
    | Please this option to true
    |
    |
    */
    'biscotto_debug' => false,

    /*
    |--------------------------------------------------------------------------
    | Cookie popup message
    |--------------------------------------------------------------------------
    |
    | In here you can add you message and the link to cookie policy page
    |
    |
    |
    */
    'biscotto_message' => 'Your Cookie message.',   // Box Message
    'biscotto_link'    => 'youlink.com',            // Yor Cookie policy link
];
