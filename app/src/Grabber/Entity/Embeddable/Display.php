<?php

namespace App\Grabber\Entity\Embeddable;

/**
 * Class Display
 * @package App\Grabber\Entity\Embeddable
 */
class Display implements DisplayInterface
{
    /**
     * One of the main characteristics of the display is its type/technology, on which depends its performance.
     *
     * @var string
     */
    private string $technology;

    /**
     * In mobile devices display size is represented by the length of its diagonal measured in inches.
     *
     * @var string
     */
    private string $diagonalSize;
    private string $width;
    private string $height;
    private string $aspectRatio;
    private string $resolution;
    private string $pixelDensity;
    private string $colorDepth;
    private string $displayArea;

    /**
     * Information about other functions and features.
     *
     * @var array
     *
     * @ORM\Column(type="json", nullable=false)
     */
    private array $features;
}
