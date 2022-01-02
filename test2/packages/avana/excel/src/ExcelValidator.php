<?php

namespace Avana\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExcelValidator {

    public static function validate($file) {        
        $file_type = IOFactory::identify($file);
        
        $reader = IOFactory::createReader($file_type);
        
        $spreadsheet = $reader->load($file);
        
        $data = $spreadsheet->getActiveSheet()->toArray();
        
        // store column property
        $column_property = [];
        
        // store column name
        $column_name = [];
        
        // store error
        $error_list = [];
        
        foreach($data as $row_index => $row) {
            foreach($row as $column_index => $column) {
                // get column header
                if($row_index == 0) {
                    // define column property (header)
                    if(isset($column[0]) && $column[0] == "#") {
                        $column_property[$column_index][] = "not_spaced";
                    }
                    else if(substr($column, -1) == "*") {
                        $column_property[$column_index][] = "required";
                    }
                    else {
                        $column_property[$column_index][] = "";
                    }
        
                    // define column name
                    $name = str_replace("#", "", $column);
                    $name = str_replace("*", "", $name);
        
                    $column_name[$column_index] = $name;
                }
                // get value for row
                else {
                    // store error containing any space
                    if(in_array("not_spaced", $column_property[$column_index])) {
                        if(str_contains($column, " ")) {
                            $error_list[$row_index+1][] = $column_name[$column_index] . " should not contain any space";
                        }
                    }
                    // store error required field
                    if(in_array("required", $column_property[$column_index])) {
                        if(!$column) {
                            $error_list[$row_index+1][] = "Missing value in " . $column_name[$column_index];
                        }
                    }
                }
            }
        }
        
        return $error_list;
    } 
}