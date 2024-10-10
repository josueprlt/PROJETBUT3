<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datetime_start = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $datetime_end = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: 'text')]
    private ?string $description = null;

    #[ORM\Column]
    private ?bool $visibility = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatetimeStart(): ?\DateTimeInterface
    {
        return $this->datetime_start;
    }

    public function setDatetimeStart(\DateTimeInterface $datetime_start): static
    {
        $this->datetime_start = $datetime_start;

        return $this;
    }

    public function getDatetimeEnd(): ?\DateTimeInterface
    {
        return $this->datetime_end;
    }

    public function setDatetimeEnd(\DateTimeInterface $datetime_end): static
    {
        $this->datetime_end = $datetime_end;

        return $this;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function isVisibility(): ?bool
    {
        return $this->visibility;
    }

    public function setVisibility(bool $visibility): static
    {
        $this->visibility = $visibility;

        return $this;
    }
}
