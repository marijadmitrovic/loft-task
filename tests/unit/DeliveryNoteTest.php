<?php

/**
 * Class DeliveryNoteTest
 */
class DeliveryNoteTest extends \Codeception\Test\Unit
{

    /**
     * Test getters and setters
     */
    public function testGetterSetter(): void
    {
        $deliveryNote = new DeliveryNote('Prague', 'Viena', 'Truck', 'City');

        $deliveryNote->setStartLocation('Brno');
        $deliveryNote->setEndLocation('Berlin');
        $deliveryNote->setTransportMethod('Van');
        $deliveryNote->setDeliveryCompany('City Sprint');

        $this->assertEquals('Brno', $deliveryNote->getStartLocation());
        $this->assertEquals('Berlin', $deliveryNote->getEndLocation());
        $this->assertEquals('Van', $deliveryNote->getTransportMethod());
        $this->assertEquals('City Sprint', $deliveryNote->getDeliveryCompany());
    }
}