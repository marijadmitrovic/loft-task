<?php

namespace DeliveryNoteService;

use Delivery\DeliveryNote;
use JsonSchema\Validator;
use phpDocumentor\Reflection\Types\Null_;

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
     * @var DeliveryNote[]
     */
    protected $deliveryNotes = [];

    /**
     * DeliveryNoteService constructor.
     */
    public function __construct(?string $file)
    {
        $this->file = $file;
    }

    /**
     * @param $file
     */
    public function getListAsJsonObject(?string $file): void
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
     *
     * @return Validator
     */
    protected function parseFile(string $file): Validator
    {
        $jsonData = file_get_contents($file);
        $schema = file_get_contents('schema.json');
        $objectSchema = (object)$schema;
        $validator = new Validator();
        $validator->validate($jsonData, $objectSchema);
        return $validator;
    }

    /**
     * @param string $fileName
     */
    protected function loadJsonFile(string $fileName): void
    {
        // get json file and make array
        $jsonData = file_get_contents($fileName);
        $json = json_decode($jsonData, true);

        // check if there are some errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            die("JSON error: " . json_last_error_msg());
        }

        // put data in DeliveryNote class
        foreach ($json as $note) {
            $deliverNote = new DeliveryNote();
            $deliverNote->setStartLocation($note['startLocation']);
            $deliverNote->setEndLocation($note['endLocation']);
            $deliverNote->setTransportMethod($note['transportMethod']);
            $deliverNote->setDeliveryCompany($note['deliveryCompany']);

            $this->deliveryNotes[$note['startLocation']] = $deliverNote;
        }
    }

    /**
     * @param $file
     */
    protected function orderList(string $file)
    {
        $this->loadJsonFile($file);

        // make copy
        $deliveryNotes = $this->deliveryNotes;

        // make empty array where we need to put ordered json objects
        /** @var DeliveryNote[] $orderedArray */
        $orderedArray = [];

        // find start point of new array
        $startLocation = $this->findStartLocation($deliveryNotes);

        // removed DeliveryNote from $deliveryNotes array and put like start point in ordered array
        unset($deliveryNotes[$startLocation->getStartLocation()]);
        $orderedArray[] = $startLocation;

        // get next DeliveryNote, put in ordered array and set as start point
        while (true) {
            $nextDeliveryNote = $this->findNextStep($deliveryNotes, $startLocation);

            if (null == $nextDeliveryNote) {
                break;
            }

            unset($deliveryNotes[$startLocation->getStartLocation()]);
            $orderedArray[] = $nextDeliveryNote;
            $startLocation = $nextDeliveryNote;
        }

        // output ordered Json objects
        $outputJsonList = json_encode($orderedArray);
        echo $outputJsonList;
    }

    /**
     * @param $deliveryNotes
     *
     * @return DeliveryNote
     */
    protected function findStartLocation(array $deliveryNotes): DeliveryNote
    {
        foreach ($deliveryNotes as $deliveryNote) {
            $startLocation = $deliveryNote->getStartLocation();

            foreach ($deliveryNotes as $deliveryNote2) {
                if ($startLocation == $deliveryNote2->getEndLocation()) {
                    continue 2;
                }
            }
            return $deliveryNote;
        }
        // this should not happen for unbroken chain
        return null;
    }

    /**
     * @param array|DeliveryNote[] $deliveryNotes
     * @param DeliveryNote         $startLocation
     * @return DeliveryNote|null
     */
    protected function findNextStep(array $deliveryNotes, ?DeliveryNote $startLocation): ?DeliveryNote
    {
        foreach ($deliveryNotes as $deliveryNote) {
            if ($deliveryNote->getStartLocation() == $startLocation->getEndLocation()) {
                return $deliveryNote;
            }
        }
        return null;
    }
}
