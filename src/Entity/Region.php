<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RegionRepository::class)
 */
class Region
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
     * @ORM\Column(type="string", length=127, nullable=true)
     */
    private $Phone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Mail;

    /**
     * @ORM\Column(type="string", length=512, nullable=true)
     */
    private $Adress;

    /**
     * @ORM\Column(type="string", length=4096, nullable=true)
     */
    private $Map;

    /**
     * @ORM\Column(type="string", length=1024)
     */
    private $Geolocation;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $WhatsApp;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $Telegram;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $Viber;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $InternetWarning;



    public function __construct()
    {
        $this->rates = new ArrayCollection();
    }

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

    public function setPhone(?string $Phone): self
    {
        $this->Phone = $Phone;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(?string $Mail): self
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getAdress(): ?string
    {
        return $this->Adress;
    }

    public function setAdress(?string $Adress): self
    {
        $this->Adress = $Adress;

        return $this;
    }

    public function getMap(): ?string
    {
        return $this->Map;
    }

    public function setMap(?string $Map): self
    {
        $this->Map = $Map;

        return $this;
    }

    /**
     * @return Collection|Rate[]
     */
    public function getRates(): Collection
    {
        return $this->rates;
    }

    public function addRate(Rate $rate): self
    {
        if (!$this->rates->contains($rate)) {
            $this->rates[] = $rate;
            $rate->setRegion($this);
        }

        return $this;
    }

    public function removeRate(Rate $rate): self
    {
        if ($this->rates->removeElement($rate)) {
            // set the owning side to null (unless already changed)
            if ($rate->getRegion() === $this) {
                $rate->setRegion(null);
            }
        }

        return $this;
    }

    public function getGeolocation(): ?string
    {
        return $this->Geolocation;
    }

    public function setGeolocation(string $Geolocation): self
    {
        $this->Geolocation = $Geolocation;

        return $this;
    }

    public function getWhatsApp(): ?string
    {
        return $this->WhatsApp;
    }

    public function setWhatsApp(?string $WhatsApp): self
    {
        $this->WhatsApp = $WhatsApp;

        return $this;
    }

    public function getTelegram(): ?string
    {
        return $this->Telegram;
    }

    public function setTelegram(?string $Telegram): self
    {
        $this->Telegram = $Telegram;

        return $this;
    }

    public function getViber(): ?string
    {
        return $this->Viber;
    }

    public function setViber(?string $Viber): self
    {
        $this->Viber = $Viber;

        return $this;
    }

    public function getInternetWarning(): ?string
    {
        return $this->InternetWarning;
    }

    public function setInternetWarning(?string $InternetWarning): self
    {
        $this->InternetWarning = $InternetWarning;

        return $this;
    }
}
