<?php
include_once 'office_extractor.php';

if ($xlsx = SimpleXLSX::parse('contact.xlsx')) {
    $year = "2".$xlsx->rows(2)[0][5];
    echo "<h1>$year</h1>";
    $class = substr($year,0,4);
    foreach ($xlsx->rows(2) as $row) {
        echo "BEGIN:VCARD <br>VERSION:2.1<br>";
        echo "N:Class_".$class."_".$row[0]."<br>";
        echo "FN:Class_".$class."_".$row[0]."<br>";
        if (substr($row[1],0,1)!=0)echo "TEL;TYPE=CELL:0".$row[1]."<br>";
        else echo "TEL;TYPE=CELL:".$row[1]."<br>";
        echo "END:VCARD<br><br>";
    }
} else {
    echo SimpleXLSX::parse_error();
    echo("<pre>");
}
?>