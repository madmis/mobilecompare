<?php

namespace App\Grabber\Entity\Embeddable;

/**
 * Class FrontCamera
 * @package App\Grabber\Entity\Embeddable
 */
class FrontCamera implements FrontCameraInterface
{
    /**
     * The aperture (f-stop number) indicates the size of the lens diaphragm opening,
     * which controls the amount of light reaching the image sensor.
     * The lower the f-stop number, the larger the diaphragm opening is,
     * hence, the more light reaches the sensor.
     * Usually, the f-stop number specified is the one that corresponds to the maximum possible diaphragm opening.
     *
     * @var string
     */
    private string $aperture;

    /**
     * Information about the number of pixels on the horizontal and vertical dimensions
     * of the photos taken by the front camera, indicated in megapixels as well.
     *
     * @var string
     */
    private string $imageResolution;

    /**
     * @var string
     */
    private string $videoResolution;
    /**
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
