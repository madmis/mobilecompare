<?php

namespace App\Grabber\Entity\Embeddable;

/**
 * Class Usb
 * @package App\Grabber\Entity\Embeddable
 */
class Usb implements UsbInterface
{
    /**
     * There are several USB connector types: the Standard one, the Mini and Micro connectors, On-The-Go connectors,
     * etc. Type of the USB connector used by the device.
     *
     * @var string
     */
    private string $connectorType;

    /**
     * There are several versions of the Universal Serial Bus (USB) standard:
     * USB 1.0 (1996), the USB 2.0 (2000), the USB 3.0 (2008), etc.
     * With each following version the rate of data transfer is increased.
     *
     * @var string
     */
    private string $version;

    /**
     * Information about other functions and features.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $features;
}
