<?php

namespace App\Grabber\Entity\Embeddable;

/**
 * Class MobileStorage
 * @package App\Grabber\Entity\Embeddable
 */
class MobileStorage implements MobileStorageInterface
{
    /**
     * Information about the capacity of the built-in storage of the device.
     * Sometimes one and the same model may is offered in variants with different internal storage capacity.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $storage;

    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $features;

    /**
     * The various types of memory cards are characterized by different sizes and capacity.
     * Information about the supported types of memory cards.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $memoryCardTypes;

    /**
     * Capacity of the memory card offered together with the device.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $includedCard;
}
