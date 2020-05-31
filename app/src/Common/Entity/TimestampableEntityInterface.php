<?php

namespace App\Common\Entity;

use DateTime;

/**
 * Interface TimestampableEntityInterface
 * @package App\Common\Entity
 */
interface TimestampableEntityInterface
{

    /**
     * Sets createdAt.
     *
     * @param DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt(DateTime $createdAt);

    /**
     * Returns createdAt.
     *
     * @return DateTime
     */
    public function getCreatedAt();

    /**
     * Sets updatedAt.
     *
     * @param DateTime $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt(DateTime $updatedAt);

    /**
     * Returns updatedAt.
     *
     * @return DateTime
     */
    public function getUpdatedAt();
}
