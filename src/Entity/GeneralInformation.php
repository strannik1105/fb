<?php

namespace App\Entity;

use App\Repository\GeneralInformationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GeneralInformationRepository::class)
 */
class GeneralInformation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $FromMail;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $Mails;

    /**
     * @ORM\Column(type="string", length=4095, nullable=true)
     */
    private $SEO_Title;

    /**
     * @ORM\Column(type="string", length=4096, nullable=true)
     */
    private $SEO_Description;

    /**
     * @ORM\Column(type="string", length=4096, nullable=true)
     */
    private $SEO_Keywords;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromMail(): ?string
    {
        return $this->FromMail;
    }

    public function setFromMail(?string $FromMail): self
    {
        $this->FromMail = $FromMail;

        return $this;
    }

    public function getMails(): ?string
    {
        return $this->Mails;
    }

    public function setMails(?string $Mails): self
    {
        $this->Mails = $Mails;

        return $this;
    }

    public function getSEOTitle(): ?string
    {
        return $this->SEO_Title;
    }

    public function setSEOTitle(?string $SEO_Title): self
    {
        $this->SEO_Title = $SEO_Title;

        return $this;
    }

    public function getSEODescription(): ?string
    {
        return $this->SEO_Description;
    }

    public function setSEODescription(?string $SEO_Description): self
    {
        $this->SEO_Description = $SEO_Description;

        return $this;
    }

    public function getSEOKeywords(): ?string
    {
        return $this->SEO_Keywords;
    }

    public function setSEOKeywords(?string $SEO_Keywords): self
    {
        $this->SEO_Keywords = $SEO_Keywords;

        return $this;
    }
}
