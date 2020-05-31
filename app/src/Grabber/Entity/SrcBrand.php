<?php

namespace App\Grabber\Entity;

use Gedmo\Timestampable\Traits\TimestampableEntity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class SrcBrand
 * @package App\Grabber\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="src_brand")
 */
class SrcBrand implements SrcBrandInterface
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
     * @var DataProviderInterface
     *
     * @ORM\ManyToOne(targetEntity="DataProvider")
     * @ORM\JoinColumn(name="data_provider_id", referencedColumnName="id")
     */
    private DataProviderInterface $dataProvider;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true, length=1000, name="src_url", nullable=false)
     */
    private string $srcUrl;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true, length=100, name="name", nullable=false)
     */
    private string $name;

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
     * @param string $id
     * @param string $name
     * @param array $aliases
     * @param array $tags
     */
    public function __construct(
        string $id,
        string $name,
        array $aliases = [],
        array $tags = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->aliases = $aliases;
        $this->tags = $tags;
    }

    /**
     * @inheritDoc
     */
    public function getId() : string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
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
}
