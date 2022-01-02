<?php

require './vendor/autoload.php';

use Avana\Excel\ExcelValidator as ExcelValidator;

$result_excel_a = ExcelValidator::validate("file/Type_A.xlsx");

$result_excel_b = ExcelValidator::validate("file/Type_B.xlsx");

echo "<h1>Excel Validation</h1>";
echo "<h2>Result Type A</h2>";
render_table($result_excel_a);

echo "<h2>Result Type B</h2>";
render_table($result_excel_b);

function render_table($array) {
    echo "<table border=1>";
    echo "<tr>";
    echo "<th>Row</th>";
    echo "<th>Error</th>";
    echo "</tr>";
    foreach($array as $key => $value) {
        echo "<tr>";
        echo "<td>" . $key . "</td>";
        echo "<td>" . implode(", ", $value) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}