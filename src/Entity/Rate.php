<?php

namespace App\Entity;

use App\Repository\RateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RateRepository::class)
 */
class Rate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Type;

    /**
     * @ORM\Column(type="string", length=10000, nullable=true)
     */
    private $Description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Speed;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $Cost;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class)
     */
    private $Region;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $CostType;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(?string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getSpeed(): ?string
    {
        return $this->Speed;
    }

    public function setSpeed(?string $Speed): self
    {
        $this->Speed = $Speed;

        return $this;
    }

    public function getCost(): ?string
    {
        return $this->Cost;
    }

    public function setCost(string $Cost): self
    {
        $this->Cost = $Cost;

        return $this;
    }

    public function getRegion(): ?Region
    {
        return $this->Region;
    }

    public function setRegion(?Region $Region): self
    {
        $this->Region = $Region;

        return $this;
    }

    public function getCostType(): ?string
    {
        return $this->CostType;
    }

    public function setCostType(?string $CostType): self
    {
        $this->CostType = $CostType;

        return $this;
    }
}
