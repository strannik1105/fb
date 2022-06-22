<?php

namespace App\Entity;

use App\Repository\LicensesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LicensesRepository::class)
 */
class Licenses
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $Images = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImages(): ?array
    {
        return $this->Images;
    }

    public function setImages(?array $Images): self
    {
        $this->Images = $Images;

        return $this;
    }
}
