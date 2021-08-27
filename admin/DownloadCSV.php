<h3>CSV wird geladen!</h3>
<?php 

$dateTimeFrom = $_POST['datePickerFromName'];    
$dateTimeTo = $_POST['datePickerToName'];


    
echo $dateTimeFrom . "\n" . $dateTimeTo;

$dbhost = "mysqlsvr74.world4you.com";
        $dbuser = "sql4504066";
        $dbpass = "g@wjt7w";
        $db = "4773441db1";
$conn = new mysqli($dbhost, $dbuser, $dbpass,$db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST["btnCreateReiwagCSV"])) {
    $sql = "SELECT * FROM Rating WHERE DATE >= '{$dateTimeFrom} 00:00:00' AND DATE <= '{$dateTimeTo} 23:59:59'";

    echo $sql;
    $result = $conn->query($sql);

     echo "<br>";
    $conn->close();

    $rows = [];
    while($row = mysqli_fetch_array($result))
    {
        echo $row["DATE"] . " <br>";
        $rows[] = array($row["ID"], $row["OBJECT_ID"], $row["DATE"], $row["CLEAN"], $row["SANITARY_MATERIAL"], $row["STAFF"], $row["USER_INPUT"]);
    }
  
    //to clean html in csv
    ob_end_clean();
    //add csv header
    array_unshift($rows, array('ID', 'OBJECT_ID', 'DATE', 'CLEAN', 'SANITARY_MATERIAL', 'STAFF', 'USER_INPUT'));
    array_to_csv_download($rows, // this array is going to be the second row
      "Kundenberwertung_Reiwag_{$dateTimeFrom}_{$dateTimeTo}.csv"
    );
    
} else if (isset($_POST["btnCreateLewagCSV"])) {
    
    $sql = "SELECT * FROM LEWAG_RATING WHERE DATE >= '{$dateTimeFrom} 00:00:00' AND DATE <= '{$dateTimeTo} 23:59:59'";

    echo $sql;
    $result = $conn->query($sql);

     echo "<br>";
    $conn->close();

    $rows = [];
    while($row = mysqli_fetch_array($result))
    {
        echo $row["DATE"] . " <br>";
        $rows[] = array($row["ID"], $row["OBJECT_ID"], $row["DATE"], $row["CLEAN"], $row["CLEANING_INTERVAL"], $row["STAFF"], $row["USER_INPUT"]);
    }

    //to clean html in csv
    ob_end_clean();
    //add csv header
    array_unshift($rows, array('ID', 'OBJECT_ID', 'DATE', 'CLEAN', 'CLEANING_INTERVAL', 'STAFF', 'USER_INPUT'));
    array_to_csv_download($rows, // this array is going to be the second row
      "Kundenberwertung_Lewag_{$dateTimeFrom}_{$dateTimeTo}.csv"
    );
}


function array_to_csv_download($array, $filename = "export.csv", $delimiter=";") {
    // open raw memory as file so no temp files needed, you might run out of memory though
    $f = fopen('php://memory', 'w'); 
    // loop over the input array
    foreach ($array as $line) { 
        // generate csv lines from the inner arrays
        fputcsv($f, $line, $delimiter); 
    }
    // reset the file pointer to the start of the file
    fseek($f, 0);
    // tell the browser it's going to be a csv file
    header('Content-Type: application/csv');
    // tell the browser we want to save it instead of displaying it
    header('Content-Disposition: attachment; filename="'.$filename.'";');
    // make php send the generated csv lines to the browser
    fpassthru($f);
}
?>
