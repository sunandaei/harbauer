<?php

// Create sample data array
$data = array(
    array(
        "DT_RowId" => "row_1",
        "first_name" => "Tiger",
        "last_name" => "Nixon"
       
    ),
    array(
        "DT_RowId" => "row_2",
        "first_name" => "Garrett",
        "last_name" => "Winters"
       
    )
);

// Wrap data in a 'data' key
$json_data = array('data' => $data);

// Set the appropriate headers to indicate JSON content
header('Content-Type: application/json');

// Output the JSON data
echo $json;
?>