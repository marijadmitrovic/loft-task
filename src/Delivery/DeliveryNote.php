<?php

namespace Delivery ;

use JsonSerializable;

/**
 * Class DeliveryNote
 */
class DeliveryNote implements JsonSerializable
{
    /**
     * @var string
     */
    protected $startLocation;

    /**
     * @var string
     */
    protected $endLocation;

    /**
     * @var string
     */
    protected $transportMethod;

    /**
     * @var string
     */
    protected $deliveryCompany;

    /**
     * DeliveryNote constructor.
     *
     * @param string $startLocation
     * @param string $endLocation
     * @param string $transportMethod
     * @param string $deliveryCompany
     */
    public function __construct(
        string $startLocation,
        string $endLocation,
        string $transportMethod,
        string $deliveryCompany
    ) {

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