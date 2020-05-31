<?php

namespace App\Grabber\Entity;

use DateTimeImmutable;
use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class SrcDevice
 * @package App\Grabber\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="src_device")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"mobile" = "SrcMobile"})
 */
abstract class SrcDevice implements SrcDeviceInterface
{
    use TimestampableEntity;

    /**
     * ID.
     *
     * @var string
     *
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     */
    private string $id;

    /**
     * @var SrcBrandInterface
     *
     * @ORM\ManyToOne(targetEntity="SrcBrand")
     * @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     */
    private SrcBrandInterface $brand;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250, nullable=false)
     */
    private string $model;

    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false, options={"default" : "{}"})
     */
    private array $aliases;

    /**
     * @var array
     *
     * @ORM\Column(type="json", nullable=false, options={"default" : "{}"})
     */
    private array $tags;

    /**
     * @var null|DateTimeImmutable
     *
     * @ORM\Column(type="date_immutable", nullable=true)
     */
    private ?DateTimeImmutable $releaseDate;

    /**
     * @param string $id
     * @param SrcBrandInterface $brand
     * @param string $model
     * @param array $aliases
     * @param array $tags
     * @param DateTimeImmutable|null $releaseDate
     */
    public function __construct(
        string $id,
        SrcBrandInterface $brand,
        string $model,
        array $aliases,
        array $tags,
        ?DateTimeImmutable $releaseDate = null
    ) {
        $this->id = $id;
        $this->brand = $brand;
        $this->model = $model;
        $this->aliases = $aliases;
        $this->tags = $tags;
        $this->releaseDate = $releaseDate;
    }

    /**
     * @return string
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @return SrcBrandInterface
     */
    public function getBrand() : SrcBrandInterface
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getModel() : string
    {
        return $this->model;
    }

    /**
     * @return array
     */
    public function getAliases() : array
    {
        return $this->aliases;
    }

    /**
     * @return array
     */
    public function getTags() : array
    {
        return $this->tags;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getReleaseDate() : ?DateTimeImmutable
    {
        return $this->releaseDate;
    }
}
