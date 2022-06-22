<?php

namespace App\Entity;

use App\Repository\PageSettingsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PageSettingsRepository::class)
 */
class PageSettings
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60000, nullable=true)
     */
    private $MainPage;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $Company_About_Years;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $Company_About_Companies;

    /**
     * @ORM\Column(type="string", length=1024, nullable=true)
     */
    private $Company_About_Abonents;

    /**
     * @ORM\Column(type="string", length=60000, nullable=true)
     */
    private $Company_Text;

    /**
     * @ORM\Column(type="string", length=60000, nullable=true)
     */
    private $Rates_Warning;

    /**
     * @ORM\Column(type="string", length=60000, nullable=true)
     */
    private $Internet_Text;

    /**
     * @ORM\Column(type="string", length=60000, nullable=true)
     */
    private $TV_Warning;

    /**
     * @ORM\Column(type="string", length=60000, nullable=true)
     */
    private $Video_Text;

    /**
     * @ORM\Column(type="string", length=60000, nullable=true)
     */
    private $Support_Questions;

    /**
     * @ORM\Column(type="string", length=60000, nullable=true)
     */
    private $Support_Text;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $CompanyImage;

    /**
     * @ORM\Column(type="string", length=4096, nullable=true)
     */
    private $WhatsApp;

    /**
     * @ORM\Column(type="string", length=4096, nullable=true)
     */
    private $Telegram;

    /**
     * @ORM\Column(type="string", length=2048, nullable=true)
     */
    private $Viber;

    /**
     * @ORM\Column(type="string", length=1026, nullable=true)
     */
    private $VacancyImage;

    /**
     * @ORM\Column(type="string", length=50000, nullable=true)
     */
    private $VacancyText;

    /**
     * @ORM\Column(type="string", length=4096, nullable=true)
     */
    private $SupportImage;

    /**
     * @ORM\Column(type="string", length=4096, nullable=true)
     */
    private $TVBanner;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMainPage(): ?string
    {
        return $this->MainPage;
    }

    public function setMainPage(?string $MainPage): self
    {
        $this->MainPage = $MainPage;

        return $this;
    }

    public function getCompanyAboutYears(): ?string
    {
        return $this->Company_About_Years;
    }

    public function setCompanyAboutYears(?string $Company_About_Years): self
    {
        $this->Company_About_Years = $Company_About_Years;

        return $this;
    }

    public function getCompanyAboutCompanies(): ?string
    {
        return $this->Company_About_Companies;
    }

    public function setCompanyAboutCompanies(?string $Company_About_Companies): self
    {
        $this->Company_About_Companies = $Company_About_Companies;

        return $this;
    }

    public function getCompanyAboutAbonents(): ?string
    {
        return $this->Company_About_Abonents;
    }

    public function setCompanyAboutAbonents(?string $Company_About_Abonents): self
    {
        $this->Company_About_Abonents = $Company_About_Abonents;

        return $this;
    }

    public function getCompanyText(): ?string
    {
        return $this->Company_Text;
    }

    public function setCompanyText(?string $Company_Text): self
    {
        $this->Company_Text = $Company_Text;

        return $this;
    }

    public function getRatesWarning(): ?string
    {
        return $this->Rates_Warning;
    }

    public function setRatesWarning(?string $Rates_Warning): self
    {
        $this->Rates_Warning = $Rates_Warning;

        return $this;
    }

    public function getInternetText(): ?string
    {
        return $this->Internet_Text;
    }

    public function setInternetText(?string $Internet_Text): self
    {
        $this->Internet_Text = $Internet_Text;

        return $this;
    }

    public function getTVWarning(): ?string
    {
        return $this->TV_Warning;
    }

    public function setTVWarning(?string $TV_Warning): self
    {
        $this->TV_Warning = $TV_Warning;

        return $this;
    }

    public function getVideoText(): ?string
    {
        return $this->Video_Text;
    }

    public function setVideoText(?string $Video_Text): self
    {
        $this->Video_Text = $Video_Text;

        return $this;
    }

    public function getSupportQuestions(): ?string
    {
        return $this->Support_Questions;
    }

    public function setSupportQuestions(?string $Support_Questions): self
    {
        $this->Support_Questions = $Support_Questions;

        return $this;
    }

    public function getSupportText(): ?string
    {
        return $this->Support_Text;
    }

    public function setSupportText(?string $Support_Text): self
    {
        $this->Support_Text = $Support_Text;

        return $this;
    }

    public function getCompanyImage(): ?string
    {
        return $this->CompanyImage;
    }

    public function setCompanyImage(?string $CompanyImage): self
    {
        $this->CompanyImage = $CompanyImage;

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

    public function getVacancyImage(): ?string
    {
        return $this->VacancyImage;
    }

    public function setVacancyImage(?string $VacancyImage): self
    {
        $this->VacancyImage = $VacancyImage;

        return $this;
    }

    public function getVacancyText(): ?string
    {
        return $this->VacancyText;
    }

    public function setVacancyText(?string $VacancyText): self
    {
        $this->VacancyText = $VacancyText;

        return $this;
    }

    public function getSupportImage(): ?string
    {
        return $this->SupportImage;
    }

    public function setSupportImage(?string $SupportImage): self
    {
        $this->SupportImage = $SupportImage;

        return $this;
    }

    public function getTVBanner(): ?string
    {
        return $this->TVBanner;
    }

    public function setTVBanner(?string $TVBanner): self
    {
        $this->TVBanner = $TVBanner;

        return $this;
    }
}
