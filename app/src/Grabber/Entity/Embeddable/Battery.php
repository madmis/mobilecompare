<?php

namespace App\Grabber\Entity\Embeddable;

/**
 * Class Battery
 * @package App\Grabber\Entity\Embeddable
 */
class Battery implements BatteryInterface
{
    /**
     * The capacity of a battery shows the maximum charge, which it can store, measured in mili-Ampere hours.
     *
     * @var string
     */
    private string $capacity;

    /**
     * The battery type is determined by its structure and more specifically,
     * by the chemicals used in it.
     * There are different battery types and some of the most commonly used
     * in mobile devices are the lithium-ion (Li-Ion) and the lithium-ion polymer battery (Li-Polymer).
     *
     * @var string
     */
    private string $type;

    /**
     * Information about the electric current (amperes) and voltage (volts) the charger outputs.
     * The higher power output allows faster charging.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $chargerOutputPower;

    /**
     * Information about other functions and features.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $features;
}
