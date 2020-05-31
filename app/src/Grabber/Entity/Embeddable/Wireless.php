<?php

namespace App\Grabber\Entity\Embeddable;

/**
 * Class Wireless
 * @package App\Grabber\Entity\Embeddable
 */
class Wireless implements WirelessInterface
{
    /**
     * Wi-Fi communication between devices is realized via the IEEE 802.11 standards.
     * Some devices have the possibility to serve as Wi-Fi Hotspots
     * by providing internet access for other nearby devices.
     * Wi-Fi Direct (Wi-Fi P2P) is another useful standard
     * that allows devices to communicate with each other without the need for wireless access point (WAP).
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $wifi;

    /**
     * Information about other functions and features.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $wifiFeatures;

    /**
     * The technology has several versions,
     * which improve the connection speed, range, connectivity and discoverability of the devices.
     * Information about the Bluetooth version of the device.
     *
     * @var string
     */
    private string $bluetoothVersion;

    /**
     * Information about other functions and features.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $bluetoothFeatures;

}
