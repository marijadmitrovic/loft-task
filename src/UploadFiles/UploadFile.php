<?php

namespace UploadFiles;

use JsonSchema\Validator;
use Delivery\DeliveryNote;

/**
 * Class UploadFile
 *
 * @package Classes
 */
class UploadFile
{
    /**
     * Ordered list format
     */
    public function formatOrderedList(): void
    {
        if (isset($_POST['submit'])) {
            $fileName = $_FILES['jsonFile']['name'];
            $tempName = $_FILES['jsonFile']['tmp_name'];

            if (isset($fileName) && !empty($fileName)) {
                $location = "Files/";
                $file = $location . $fileName;
                move_uploaded_file($tempName, $file);
            }
        }

        if (isset($file) && !empty($file)) {
            $jsonData = file_get_contents($file);
            $schema = file_get_contents('schema.json');
            $objectSchema = (object)$schema;
            $validator = new Validator();
            $validator->validate($jsonData, $objectSchema);

            if ($validator->isValid()) {
                //Return ordered list
                $json = json_decode($jsonData, true);
                $outputList = "<ol>";
                foreach ($json['notes'] as $note) {
                    $newDeliverNote = new DeliveryNote(
                        $note['startLocation'],
                        $note['endLocation'],
                        $note['transportMethod'],
                        $note['deliveryCompany']
                    );
                    $outputList .= "<li>From " . $note['startLocation'];
                    $outputList .= " to " . $note['endLocation'];
                    $outputList .= " by " . $note['transportMethod'];
                    $outputList .= " &#40; " . $note['deliveryCompany']
                        . " &#41; </li>";
                    $outputList .= "<br>";
                }
                $outputList .= "</ol>";
                echo $outputList;
            }
        } else {
            echo "JSON does not validate. Violations:\n";
            $validator = new Validator();
            foreach ($validator->getErrors() as $error) {
                echo sprintf("[%s] %s\n", $error['property'], $error['message']);
            }
        }
    }

    /**
     * Json format
     *
     */
    public function formatJsonObject(): void
    {
        if (isset($_POST['submit'])) {
            $fileName = $_FILES['jsonFile']['name'];
            $tempName = $_FILES['jsonFile']['tmp_name'];

            if (isset($fileName) && !empty($fileName)) {
                $location = "Files/";
                $file = $location . $fileName;
                move_uploaded_file($tempName, $file);
            }
        }

        if (isset($file) && !empty($file)) {
            $jsonData = file_get_contents($file);
            $schema = file_get_contents('schema.json');
            $objectSchema = (object)$schema;
            $validator = new Validator();
            $validator->validate($jsonData, $objectSchema);

            if ($validator->isValid()) {
                //Return JSON format
                if (isset($file) && !empty($file)) {
                    $jsonData = file_get_contents($file);
                    $json = json_decode($jsonData, true);
                    foreach ($json['notes'] as $note) {
                        $newDeliverNote = new DeliveryNote(
                            $note['startLocation'],
                            $note['endLocation'],
                            $note['transportMethod'],
                            $note['deliveryCompany']
                        );
                        $outputList = json_encode($newDeliverNote);
                        echo $outputList;
                    }
                }
            } else {
                echo "JSON does not validate. Violations:\n";
                foreach ($validator->getErrors() as $error) {
                    echo sprintf("[%s] %s\n", $error['property'], $error['message']);
                }
            }
        }
    }
}
