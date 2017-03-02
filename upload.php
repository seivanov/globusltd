<?php

require_once('NumberHelper.php');

$file = file($_FILES['file']['tmp_name']);

header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');

$output = fopen('php://output', 'w');

$number = new NumberHelper();

foreach($file as $row) {

    preg_match("#([0-9]+)#", trim($row), $matches);
    if(count($matches) && isset($matches[1])) {

        $digit = $matches[1];
        $strdigit = $number->num2str($matches[1]);

    	fputcsv($output, [$digit, $strdigit]);

    }

}
