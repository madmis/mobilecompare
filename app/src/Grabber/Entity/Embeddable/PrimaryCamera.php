<?php

namespace App\Grabber\Entity\Embeddable;

/**
 * Class PrimaryCamera
 * @package App\Grabber\Entity\Embeddable
 */
class PrimaryCamera implements PrimaryCameraInterface
{
    /**
     * Information about the manufacturer and model of the image sensor used by this camera of the device.
     *
     * @var string
     */
    private string $sensorModel;

    /**
     * Information about the sensor type of the camera.
     * Some of the most widely used types of image sensors on mobile devices are CMOS, BSI, ISOCELL, etc.
     *
     * @var string
     */
    private string $sensorType;

    /**
     * The optical format of an image sensor is an indication of its shape and size.
     * It is usually expressed in inches.
     *
     * @var string
     */
    private string $sensorFormat;

    /**
     * Pixels are usually measured in microns (μm).
     * Larger ones are capable of recording more light, hence, will offer better low light shooting
     * and wider dynamic range compared to the smaller pixels.
     * On the other hand, smaller pixels allow for increasing the resolution while preserving the same sensor size.
     *
     * @var string
     */
    private string $pixelSize;

    /**
     * The aperture (f-stop number) indicates the size of the lens diaphragm opening,
     * which controls the amount of light reaching the image sensor.
     * The lower the f-stop number, the larger the diaphragm opening is, hence, the more light reaches the sensor.
     * Usually, the f-stop number specified is the one that corresponds to the maximum possible diaphragm opening.
     *
     * @var string
     */
    private string $aperture;

    /**
     * Information about the number of lenses used by the optical system of the camera.
     *
     * @var string
     */
    private string $numberOfLenses;

    /**
     * The rear cameras of mobile devices use mainly a LED flash.
     * It may arrive in a single, dual- or multi-light setup and in different arrangements.
     *
     * @var string
     */
    private string $flashType;

    /**
     * One of the main characteristics of the cameras is their image resolution.
     * It states the number of pixels on the horizontal and vertical dimensions of the image,
     * which can also be shown in megapixels that indicate the approximate number of pixels in millions.
     *
     * @var string
     */
    private string $imageResolution;

    /**
     * Information about the maximum resolution at which the rear camera can shoot videos.
     *
     * @var string
     */
    private string $videoResolution;

    /**
     * Information about the maximum number of frames per second (fps)
     * supported by the rear camera while recording video at the maximum resolution.
     * Some of the main standard frame rates for recording and playing video are 24 fps, 25 fps, 30 fps, 60 fps.
     *
     * @var string
     */
    private string $videoFPS;

    /**
     * Information about other functions and features.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $features;
}
