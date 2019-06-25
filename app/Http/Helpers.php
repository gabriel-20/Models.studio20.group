<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

if (!function_exists('mydd')) {

    function mydd($var)
    {
        if (get_client_ip() == '188.214.255.240'){
            dd($var);
        } else {
            //dd('non-ip');
        }

    }
}

?>
