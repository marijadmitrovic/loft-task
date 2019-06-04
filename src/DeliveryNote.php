<?php

class DeliveryNote implements JsonSerializable
{
    private $startLocation;
    private $endLocation;
    private $transportMethod;
    private $deliveryCompany;

    public function __construct($startLocation = '', $endLocation = '', $transportMethod = ' ', $deliveryCompany = '')
    {

        $this->startLocation = $startLocation;
        $this->endLocation = $endLocation;
        $this->transportMethod = $transportMethod;
        $this->deliveryCompany = $deliveryCompany;
    }

    /**
     * @return string
     */
    public function getStartLocation()
    {
        return $this->startLocation;
    }

    /**
     * @param string $startLocation
     */
    public function setStartLocation(string $startLocation): void
    {
        $this->startLocation = $startLocation;
    }

    /**
     * @return string
     */
    public function getEndLocation()
    {
        return $this->endLocation;
    }

    /**
     * @param string $endLocation
     */
    public function setEndLocation(string $endLocation): void
    {
        $this->endLocation = $endLocation;
    }

    /**
     * @return string
     */
    public function getTransportMethod()
    {
        return $this->transportMethod;
    }

    /**
     * @param string $transportMethod
     */
    public function setTransportMethod(string $transportMethod): void
    {
        $this->transportMethod = $transportMethod;
    }

    /**
     * @return string
     */
    public function getDeliveryCompany(): string
    {
        return $this->deliveryCompany;
    }

    /**
     * @param string $deliveryCompany
     */
    public function setDeliveryCompany(string $deliveryCompany): void
    {
        $this->deliveryCompany = $deliveryCompany;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return
            [
                'startLocation' => $this->getStartLocation(),
                'endLocation' => $this->getEndLocation(),
                'transportMethod' => $this->getTransportMethod(),
                'deliveryCompany' => $this->getDeliveryCompany(),
            ];
    }
}