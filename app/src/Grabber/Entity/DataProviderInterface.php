<?php

namespace App\Grabber\Entity;

use App\Common\Entity\{IdEntityInterface, TimestampableEntityInterface};

/**
 * Interface DataProviderInterface
 * @package App\Grabber\Entity
 */
interface DataProviderInterface extends TimestampableEntityInterface, IdEntityInterface
{
    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @return string
     */
    public function getSite() : string;
}
