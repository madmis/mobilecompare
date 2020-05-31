<?php

namespace App\Grabber\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Timestampable\Traits\TimestampableEntity;

/**
 * Class DataProvider
 * @package App\Grabber\Entity
 *
 * @ORM\Entity()
 * @ORM\Table(name="data_provider")
 */
class DataProvider implements DataProviderInterface
{
    use TimestampableEntity;

    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", unique=true, length=50, name="name", nullable=false)
     */
    private string $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250, name="site", nullable=false)
     */
    private string $site;

    /**
     * @param int $id
     * @param string $name
     * @param string $site
     */
    public function __construct(int $id, string $name, string $site)
    {
        $this->id = $id;
        $this->name = $name;
        $this->site = $site;
    }

    /**
     * @inheritDoc
     */
    public function getId() : int
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
    public function getSite() : string
    {
        return $this->site;
    }
}
