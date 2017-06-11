<?php
$current_month = null;
$current_year = null;
function getCurrentYear(){
    global $current_year;
    if(null === $current_year) $current_year  = date('Y');
	return $current_year;
}

function getAllMonth(){
	return [
        '1' => 'Janaury',
        '2' => 'February',
        '3' => 'March',
        '4' => 'April',
        '5' => 'May',
        '6' => 'June',
        '7' => 'July',
        '8' => 'August',
        '9' => 'September',
        '10' => 'October',
        '11' => 'November',
        '12' => 'December',
	];
}

function getCurrentMonth(){
    global $current_month;
    if(null === $current_month) $current_month  = date('n');
    return $current_month;
}