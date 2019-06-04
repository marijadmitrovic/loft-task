<?php
include "src/DeliveryNote.php";

if (isset($_POST['submit'])) {
    $fileName = $_FILES['jsonFile']['name'];
    $tempName = $_FILES['jsonFile']['tmp_name'];

    if (isset($fileName)) {
        if (!empty($fileName)) {
            $location = "Files/";
            $file = $location . $fileName;
            if (move_uploaded_file($tempName, $file)) {
                echo "The file uploaded";
            } else {
                echo "File was not uploaded";
            }
        }
    }
}

if (isset($file) && !empty($file)) {
    $jsonData = file_get_contents($file);
    $json = json_decode($jsonData, true);
    $outputList = "<ol>";
    foreach ($json['notes'] as $note) {
        $newDeliverNote = new DeliveryNote($note['startLocation'], $note['endLocation'], $note['transportMethod'],
            $note['deliveryCompany']);
        $outputList .= "<li>From " . $note['startLocation'] . " to " . $note['endLocation'];
        $outputList .= " by " . $note['transportMethod'] . " &#40; " . $note['deliveryCompany'] . " &#41; </li>";
        $outputList .= "<br>";
    }
    $outputList .= "</ol>";
    echo $outputList;
} else {
    echo "Please upload the file !";
}

