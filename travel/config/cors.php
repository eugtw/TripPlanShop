<?php

return [
    /*
     |--------------------------------------------------------------------------
     | Laravel CORS
     |--------------------------------------------------------------------------
     |

     | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*') 
     | to accept any value, the allowed methods however have to be explicitly listed.
     |
     */
    'defaults' => array(
        'supportsCredentials' => true,
        'allowedOrigins' => array('*'),
        'allowedHeaders' => array('*'),
        'allowedMethods' => array('*'),
        'maxAge' => 3600,
        'hosts' => array()
    ),
    'paths' => array(),
];

