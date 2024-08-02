<?php

//format the date in 26-Apr-2021 9:02 am
function formatDateTime($date)
{
    return date('d-M-Y g:i a', strtotime($date));
}

//format the date in 26-Apr-2021
function formatDate($date)
{
    return date('d-M-Y', strtotime($date));
}

//check url is active or not
function isActive($url)
{
    if (Request::segment(1) == $url) {
        return 'mm-active';
    } else {
        return 'no-class';
    }
}

//get Current date time
function getCurrenDateTime()
{
    return Carbon\Carbon::now()->toDateTimeString();
}

//get time difference
function getTimeDifference($endTime, $startTime)
{
    $t1 = strtotime($endTime);
    $t2 = strtotime($startTime);
    $diff = $t1 - $t2;
    $hours = round($diff / (60 * 60), 2);
    return $hours;
}

//convert the dateTime With 24 to 12 hours
function convertdt24To12($dt = "")
{
    return date("d-M-Y g:iA", strtotime($dt));
}

//get the difference of dateTime
function getdtDiffBetween($dt1 = "", $dt2 = "")
{
    $startTime = \Carbon\Carbon::parse($dt1);
    $endTime = \Carbon\Carbon::parse($dt2);

    $diffBetweenDt = $startTime->diff($endTime)->format('%H:%I:%S') . " Minutes";

    return $diffBetweenDt;
}

//get default profile pic
function profilePic()
{
    try {
        $profilePic = \Auth::user()->profile_pic;

        if (!$profilePic) {
            $profilePic = url('/User/default_profile_pic/avatar.png');
        }

        return $profilePic;
    } catch (Exception $e) {
        return redirect()->to(route('login'));
    }

}

//convert number to words
function number_to_words($number)
{
    $no = floor($number);
    $point = round($number - $no, 2) * 100;
    $hundred = null;
    $digits_1 = strlen($no);
    $i = 0;
    $str = array();
    $words = array('0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety');
    $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
    while ($i < $digits_1) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += ($divider == 10) ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str[] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;
        } else {
            $str[] = null;
        }

    }
    $str = array_reverse($str);
    $result = implode('', $str);
    $points = ($point) ?
    "." . $words[$point / 10] . " " .
    $words[$point = $point % 10] : '';
    return $result;
}

//get configuration data
function getConfig($code = '')
{

    $configuration = [];

    $configuration = \Modules\Configurations\Entities\Configurations::where('config', $code)->select('value')->first()->toArray();
    return $configuration['value'];
}