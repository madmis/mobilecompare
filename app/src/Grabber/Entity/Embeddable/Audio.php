<?php

namespace App\Grabber\Entity\Embeddable;

/**
 * Class Audio
 * @package App\Grabber\Entity\Embeddable
 */
class Audio implements AudioInterface
{
    /**
     * The loudspeaker is a device, which reproduces various sounds
     * such as ring tones, alarms, music, voice calls, etc.
     * Information about the type of speakers the device uses.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $speaker;

    /**
     * Information about other functions and features.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $features;
}
