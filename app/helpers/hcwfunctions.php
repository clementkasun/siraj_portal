<?php

use App\Client;
use App\Minute;
use App\FileLog;
use App\Setting;
use Carbon\Carbon;
use PhpParser\Node\Expr\Cast\Array_;

function changeDateFormate()
{
    return "h1";
}

function productImagePath($image_name)
{
    return public_path('images/products/' . $image_name);
}



// function fileLog($id, $code, $description,  $authlevel)
// {
//     $log = [];
//     $log['client_id'] = $id;
//     $log['code'] =  $code;
//     $log['description'] = $description;
//     $log['auth_level'] = $authlevel;
//     $log['user_id'] = auth()->check() ? auth()->user()->id : "N/A";
//     FileLog::create($log);
// }







function monthNames()
{
    return [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December',
    ];
}
function refineArrayMonth($array)
{
    $rtn = $array;
    if (!array_key_exists('01', $rtn)) {
        $rtn['01'] = 0;
    }
    if (!array_key_exists('02', $rtn)) {
        $rtn['02'] = 0;
    }
    if (!array_key_exists('03', $rtn)) {
        $rtn['03'] = 0;
    }
    if (!array_key_exists('04', $rtn)) {
        $rtn['04'] = 0;
    }
    if (!array_key_exists('05', $rtn)) {
        $rtn['05'] = 0;
    }
    if (!array_key_exists('06', $rtn)) {
        $rtn['06'] = 0;
    }
    if (!array_key_exists('07', $rtn)) {
        $rtn['07'] = 0;
    }
    if (!array_key_exists('08', $rtn)) {
        $rtn['08'] = 0;
    }
    if (!array_key_exists('09', $rtn)) {
        $rtn['09'] = 0;
    }
    if (!array_key_exists(10, $rtn)) {
        $rtn[10] = 0;
    }
    if (!array_key_exists(11, $rtn)) {
        $rtn[11] = 0;
    }
    if (!array_key_exists(12, $rtn)) {
        $rtn[12] = 0;
    }
    return $rtn;
}

function getArraySum($array1, $array2)
{
    $rtn = [];
    $i = 0;
    foreach ($array1 as $a) {
        array_push($rtn, $a + $array2[$i++]);
    }
    return $rtn;
}

function array_flat($array, $prefix = '')
{
    $result = array();

    foreach ($array as $key => $value) {
        $new_key = $prefix . (empty($prefix) ? '' : '.') . $key;

        if (is_array($value)) {
            $result = array_merge($result, array_flat($value, $new_key));
        } else {
            $result[$new_key] = $value;
        }
    }

    return $result;
}

function array_flatten($array)
{
    if (!is_array($array)) {
        return FALSE;
    }
    $result = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, array_flatten($value));
        } else {
            $result[$key] = $value;
        }
    }
    return $result;
}
