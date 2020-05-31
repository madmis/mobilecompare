<?php

namespace App\Grabber\Entity\Embeddable;

/**
 * Class MobileNetwork
 * @package App\Grabber\Entity\Embeddable
 */
class MobileNetwork implements MobileNetworkInterface
{
    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $gsm;

    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $cdma;

    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $wCdma;

    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $lte;

    /**
     * There are several network technologies that enhance the performance
     * of mobile networks mainly by increased data bandwidth.
     * Information about the communication technologies
     * supported by the device and their respective uplink and downlink bandwidth.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $technologies;

    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $features;
}
