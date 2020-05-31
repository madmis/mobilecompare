<?php

namespace App\Grabber\Entity;

use App\Common\Entity\{TimestampableEntityInterface, UuidEntityInterface};

/**
 * Interface SrcBrandInterface
 * @package App\Grabber\Entity
 */
interface SrcBrandInterface extends TimestampableEntityInterface, UuidEntityInterface
{
    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @return array
     */
    public function getAliases() : array;

    /**
     * @return array
     */
    public function getTags() : array;
}
