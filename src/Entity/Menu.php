<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MenuRepository::class)
 */
class Menu
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
     * @ORM\Column(type="array", nullable=true)
     */
    private $Childs = [];

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $URL;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Parent;

    /**
     * @ORM\Column(type="integer")
     */
    private $Level;

    /**
     * @ORM\Column(type="integer")
     */
    private $Number;

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

    public function getURL(): ?string
    {
        return $this->URL;
    }

    public function setURL(?string $URL): self
    {
        $this->URL = $URL;

        return $this;
    }

    public function getChilds(): ?array
    {
        return $this->Childs;
    }

    public function setChilds(?array $Childs): self
    {
        $this->Childs = $Childs;

        return $this;
    }

    public function getParent(): ?string
    {
        return $this->Parent;
    }

    public function setParent(?string $Parent): self
    {
        $this->Parent = $Parent;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->Level;
    }

    public function setLevel(int $Level): self
    {
        $this->Level = $Level;

        return $this;
    }

    public function getNumber(): ?int
    {
        return $this->Number;
    }

    public function setNumber(int $Number): self
    {
        $this->Number = $Number;

        return $this;
    }
}
