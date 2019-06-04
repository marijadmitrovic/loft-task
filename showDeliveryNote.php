<?php
include "src/DeliveryNote.php";
if (isset($_GET['jsonFile'])) {
    $jsonData = file_get_contents($_GET['jsonFile']);
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

