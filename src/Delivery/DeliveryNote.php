<?php

namespace Delivery;

use JsonSerializable;

/**
 * Class DeliveryNote
 *
 * @package Delivery
 */
class DeliveryNote implements JsonSerializable
{
    /**
     * Start the location point
     *
     * @var string|null
     */
    protected $startLocation;

    /**
     * End the location point
     *
     * @var string|null
     */
    protected $endLocation;

    /**
     * Transport method
     *
     * @var string|null
     */
    protected $transportMethod;

    /**
     * Delivery company
     *
     * @var string|null
     */
    protected $deliveryCompany;

    /**
     * @return string
     */
    public function getStartLocation(): string
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
    public function getEndLocation(): string
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
    public function getTransportMethod(): string
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
    public function jsonSerialize(): array
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
