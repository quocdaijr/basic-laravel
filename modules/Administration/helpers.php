<?php
if (!function_exists('isAdmin')) {

    function isAdmin()
    {
        return Auth::user()->hasRole('administration');
    }
}
