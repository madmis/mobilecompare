<?php

namespace App\Grabber\Entity;

use DateTimeImmutable;
use App\Common\Entity\{TimestampableEntityInterface, UuidEntityInterface};

/**
 * Interface SrcDeviceInterface
 * @package App\Grabber\Entity
 */
interface SrcDeviceInterface extends TimestampableEntityInterface, UuidEntityInterface
{
    /**
     * @return SrcBrandInterface
     */
    public function getBrand() : SrcBrandInterface;

    /**
     * @return string
     */
    public function getModel() : string;

    /**
     * @return array
     */
    public function getAliases() : array;

    /**
     * @return array
     */
    public function getTags() : array;

    /**
     * @return DateTimeImmutable|null
     */
    public function getReleaseDate() : ?DateTimeImmutable;
}
