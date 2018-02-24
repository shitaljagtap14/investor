<?php
return array(

    /** set your paypal credential **/

    'client_id' => 'AcYLfPw4iQo_6Jnf4k0uRp6iVpkT1_ZBt8yRRqRcAAViWDcLCardmFWyzY4vGKZnEgDFSBnbz_Wh_9AI',
    'secret' => 'EPYkK0Wfs6xxsFIFnnK0TrC7GPoSqPHUTeZqKSx5jc-571sG_LAWIZppzpiInn7KJ89je1sTTu3YKfNU',
    /**

     * SDK configuration
     */
    /*'sandbox_client_id' => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
    'sandbox_secret' => env('PAYPAL_SANDBOX_SECRET', ''),
    'live_client_id' => env('PAYPAL_LIVE_CLIENT_ID', ''),
    'live_secret' => env('PAYPAL_LIVE_SECRET', ''),*/
    'settings' => array(

        /**
         * Available option 'sandbox' or 'live'
         */

        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */

        'http.ConnectionTimeOut' => 4000,

        /**
         * Whether want to log to a file
         */

        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */

        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */

        'log.LogLevel' => 'FINE'

    ),
);