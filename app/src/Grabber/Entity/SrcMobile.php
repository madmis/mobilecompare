<?php

namespace App\Grabber\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class SrcMobile
 * @package App\Grabber\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="src_mobile")
 */
class SrcMobile extends SrcDevice implements SrcMobileInterface
{
    /**
     * @var SrcMobileAdditionalInterface
     *
     * @ORM\OneToOne(targetEntity="SrcMobileAdditional")
     * @ORM\JoinColumn(name="additional_features_id", referencedColumnName="id")
     */
    private SrcMobileAdditionalInterface $additionalFeatures;

    /**
     * @var SrcMobileDesignInterface
     *
     *
     * @ORM\OneToOne(targetEntity="SrcMobileDesign")
     * @ORM\JoinColumn(name="design_id", referencedColumnName="id")
     */
    private SrcMobileDesignInterface $design;
}
