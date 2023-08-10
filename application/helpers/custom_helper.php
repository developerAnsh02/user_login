<?php

function pre($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function getCurrentDateTime() {
    $dateTime = date('Y-m-d H:i:s');
    return $dateTime;
}

function getCurrentDate() {
    $dateTime = date('Y-m-d');
    return $dateTime;
}

function getWriterTeams()
{
    $arr = array();
    $arr['Team 1(My Assignment)']     = 'Team 1 (My Assignment)';
    $arr['Team 2(Sanatan)']           = 'Team 2 (Sanatan)';
    $arr['Team 3 (Biman)']            = 'Team 3 (Biman)';
    $arr['Team 4 (Arnab)']            = 'Team 4 (Arnab)';
    $arr['Team 5 (Hive)']             = 'Team 5 (Hive)';
    $arr['Team 6 (Student)']          = 'Team 6 (Student)';
    $arr['Team 7 (Uppal)']            = 'Team 7 (Uppal)';
    $arr['Team 8 (Oddesy)']           = 'Team 8 (Oddesy)';
    $arr['Team 9 (Priyanka)']         = 'Team 9 (Priyanka)';
    $arr['Team 10 (Nafeesa)']         = 'Team 10 (Nafeesa)';
    $arr['Team 11 (Dipanjan)']        = 'Team 11 (Dipanjan)';
    return $arr;
}

function checkIP($ip='')
{
    $ourIP = array(
        '192.168.0.113',
        '192.168.0.103',
        '192.168.0.107',
        '192.168.0.103',
        '192.168.0.106',
        '192.168.0.101',
        '192.168.0.105',

        '184.168.114.123',
        
        // HS Local IP
        '157.38.60.67',
    );    
    $status = in_array($ip, $ourIP);
    return $status;
}

?>