<?php

namespace App\Entity;

use App\Repository\Vacancy1Repository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=Vacancy1Repository::class)
 */
class Vacancy1
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=512)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=256)
     */
    private $Phone;

    /**
     * @ORM\Column(type="string", length=4096)
     */
    private $Vacancy;

    /**
     * @ORM\Column(type="string", length=4096)
     */
    private $Resume;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $Region;

    /**
     * @ORM\Column(type="string", length=256, nullable=true)
     */
    private $IP;

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

    public function getPhone(): ?string
    {
        return $this->Phone;
    }

    public function setPhone(string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getVacancy(): ?string
    {
        return $this->Vacancy;
    }

    public function setVacancy(string $Vacancy): self
    {
        $this->Vacancy = $Vacancy;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->Resume;
    }

    public function setResume(string $Resume): self
    {
        $this->Resume = $Resume;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->Region;
    }

    public function setRegion(?string $Region): self
    {
        $this->Region = $Region;

        return $this;
    }

    public function getIP(): ?string
    {
        return $this->IP;
    }

    public function setIP(?string $IP): self
    {
        $this->IP = $IP;

        return $this;
    }
}
