<?php

namespace App\Grabber\Entity\Embeddable;

/**
 * Class SimCard
 * @package App\Grabber\Entity\Embeddable
 */
class SimCard implements SimCardInterface
{
    /**
     * Information about the type and size (form factor) of the SIM card used in the device.
     *
     * @var string
     */
    private string $type;

    /**
     * Number of SIM cards.
     *
     * @var string
     */
    private string $cardsNumber;

    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $features;
}
