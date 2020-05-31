<?php

namespace App\Grabber\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class SrcMobileAdditional
 * @package App\Grabber\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="src_mobile_additional")
 */
class SrcMobileAdditional implements SrcMobileAdditionalInterface
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * Information about the operating system used by the device as well as its version.
     *
     * @ORM\Column(type="string", length=200, name="os", nullable=true)
     *
     * @var string|null
     */
    private ?string $operatingSystem;

    /**
     * Sensors vary in type and purpose.
     * They increase the overall functionality of the device, in which they are integrated.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false, options={"default" : "{}"})
     */
    private array $sensors;

    /**
     * Information whether the device has an FM radio receiver or not.
     *
     * @ORM\Column(type="boolean", nullable=false)
     *
     * @var bool
     */
    private bool $radio;

    /**
     * Tracking/Positioning
     * The tracking/positioning service is provided by various satellite navigation systems,
     * which track the autonomous geo-spatial positioning of the device that supports them.
     * The most common satellite navigation systems are the GPS and the GLONASS.
     * There are also non-satellite technologies for locating mobile devices
     * such as the Enhanced Observed Time Difference, Enhanced 911, GSM Cell ID.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false, options={"default" : "{}"})
     */
    private array $tracking;

    /**
     * Information whether the device is equipped with a 3.5 mm audio jack.
     *
     * @var bool
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private bool $headphoneJack;

    /**
     * Information about some of the most widely used connectivity technologies supported by the device.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false, options={"default" : "{}"})
     */
    private array $connectivity;

    /**
     * Information about some of the features and standards supported by the browser of the device.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false, options={"default" : "{}"})
     */
    private array $browser;

    /**
     * List of some of the most common audio file formats and codecs supported standardly by the device.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false, options={"default" : "{}"})
     */
    private array $audioFileFormats;

    /**
     * List of some of the most common video file formats and codecs supported standardly by the device.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false, options={"default" : "{}"})
     */
    private array $videoFileFormats;

    /**
     * Information about other functions and features.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false, options={"default" : "{}"})
     */
    private array $additionalFeatures;

    /**
     * @inheritDoc
     */
    public function getId() : int
    {
        return $this->id;
    }
}
