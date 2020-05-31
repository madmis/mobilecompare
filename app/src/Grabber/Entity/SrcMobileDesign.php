<?php

namespace App\Grabber\Entity;

/**
 * Class SrcMobileDesign
 * @package App\Grabber\Entity
 */
class SrcMobileDesign implements SrcMobileDesignInterface
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
     * @ORM\Column(type="string", length=10, nullable=true)
     *
     * @var string|null
     */
    private ?string $width;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     *
     * @var string|null
     */
    private ?string $height;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     *
     * @var string|null
     */
    private ?string $thickness;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     *
     * @var string|null
     */
    private ?string $weight;

    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     *
     * @var string|null
     */
    private string $volume;

    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false, options={"default" : "{}"})
     */
    private array $colors;

    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false, options={"default" : "{}"})
     */
    private array $bodyMaterials;

    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false, options={"default" : "{}"})
     */
    private array $features;

    /**
     * @inheritDoc
     */
    public function getId() : int
    {
        return $this->id;
    }
}
