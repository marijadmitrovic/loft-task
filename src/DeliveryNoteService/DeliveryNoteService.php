<?php

namespace DeliveryNoteService;

use Delivery\DeliveryNote;
use JsonSchema\Validator;

/**
 * Class DeliveryNoteService
 *
 * @package DeliveryNoteService
 */
class DeliveryNoteService
{
    /**
     * @var string|null
     */
    private $file;

    /**
     * DeliveryNoteService constructor.
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    /**
     * @param $file
     */
    public function getDataAsOrderedList($file): void
    {
        if (isset($file) && !empty($file)) {
            $validator = $this->parseFile($file);
            if ($validator->isValid()) {
                $this->orderList($file);
            }
        } else {
            echo "Please upload file!";
        }
    }

    /**
     * @param $file
     */
    public function getListAsJsonObject($file): void
    {
        if (isset($file) && !empty($file)) {
            $validator = $this->parseFile($file);
            if ($validator->isValid()) {
                $this->getJsonObject($file);
            }
        } else {
            echo "Please upload file!";
        }
    }

    /**
     * @param $file
     *
     * @return Validator
     */
    protected function parseFile($file): Validator
    {
        $jsonData = file_get_contents($file);
        $schema = file_get_contents('schema.json');
        $objectSchema = (object)$schema;
        $validator = new Validator();
        $validator->validate($jsonData, $objectSchema);
        return $validator;
    }

    /**
     * @param $file
     */
    protected function orderList($file): void
    {
        $jsonData = file_get_contents($file);
        $json = json_decode($jsonData, true);
        $outputList = "<ol>";
        foreach ($json['notes'] as $note) {
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

    /**
     * @param $file
     */
    protected function getJsonObject($file): void
    {
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
}
