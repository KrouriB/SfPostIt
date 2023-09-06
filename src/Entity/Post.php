<?php

namespace App\Entity;

use DateTime;
use InvalidArgumentException;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $information = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateLimite = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateFaite = null;

    public function __construct(DateTime $date = null)
    {
        $this->dateCreation = new DateTime();
        $this->dateLimite = $date;

        if ($this->dateLimite instanceof DateTime && $this->dateLimite < $this->dateCreation) {
            throw new InvalidArgumentException("bad value");
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getInformation(): ?string
    {
        return $this->information;
    }

    public function setInformation(string $information): static
    {
        $this->information = $information;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateLimite(): ?\DateTimeInterface
    {
        return $this->dateLimite;
    }

    public function setDateLimite(\DateTimeInterface $dateLimite): static
    {
        $this->dateLimite = $dateLimite;

        return $this;
    }

    public function getDateFaite(): ?\DateTimeInterface
    {
        return $this->dateFaite;
    }

    public function setDateFaite(?\DateTimeInterface $dateFaite): static
    {
        $this->dateFaite = $dateFaite;

        return $this;
    }

    public function isFinished()
    {
        return $this->dateFaite instanceof DateTime;
    }

    public function done()
    {
        $this->dateFaite = new DateTime();
    }
}
