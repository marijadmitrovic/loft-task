<?php

require "src/DeliveryNote.php";

if (isset($_POST['submit'])) {
    $fileName = $_FILES['jsonFile']['name'];
    $tempName = $_FILES['jsonFile']['tmp_name'];

    if (isset($fileName) && !empty($fileName)) {
        $location = "Files/";
        $file = $location . $fileName;
        move_uploaded_file($tempName, $file);
    }
}
//Return ordered list
if (isset($file) && !empty($file)) {
    $jsonData = file_get_contents($file);

    $json = json_decode($jsonData, true);
    $outputList = "<ol>";
    foreach ($json['notes'] as $note) {
        $newDeliverNote = new DeliveryNote(
            $note['startLocation'], $note['endLocation'], $note['transportMethod'],
            $note['deliveryCompany']
        );
        $outputList .= "<li>From " . $note['startLocation'];
        $outputList .= " to " . $note['endLocation'];
        $outputList .= " by " . $note['transportMethod'];
        $outputList .= " &#40; " . $note['deliveryCompany'] . " &#41; </li>";
        $outputList .= "<br>";
    }
    $outputList .= "</ol>";
    echo $outputList;
} else {
    echo "Please upload the file !";
}

//Return JSON format
if (isset($file) && !empty($file)) {
    $jsonData = file_get_contents($file);
    $json = json_decode($jsonData, true);
    foreach ($json['notes'] as $note) {
        $newDeliverNote = new DeliveryNote(
            $note['startLocation'], $note['endLocation'], $note['transportMethod'],
            $note['deliveryCompany']
        );
        $outputList = json_encode($newDeliverNote);
        echo $outputList;
    }
} else {
    echo "Please upload the file !";
}
