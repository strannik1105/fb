<?php

namespace App\Entity;

use App\Repository\VacantPositionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VacantPositionRepository::class)
 */
class VacantPosition
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
     * @ORM\Column(type="string", length=4096, nullable=true)
     */
    private $Requirements;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $Payment;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $Image;

    /**
     * @ORM\ManyToOne(targetEntity=Region::class)
     */
    private $Region;

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

    public function getRequirements(): ?string
    {
        return $this->Requirements;
    }

    public function setRequirements(?string $Requirements): self
    {
        $this->Requirements = $Requirements;

        return $this;
    }

    public function getPayment(): ?string
    {
        return $this->Payment;
    }

    public function setPayment(?string $Payment): self
    {
        $this->Payment = $Payment;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(?string $Image): self
    {
        $this->Image = $Image;

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
}
