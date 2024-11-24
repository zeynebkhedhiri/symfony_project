<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\Column(type: 'string', length: 255)]
    private $nom;  // Nom de l'événement
    #[ORM\Column(type: 'text', nullable: true)]
    private $description;  // Description de l'événement

    #[ORM\Column(type: 'datetime')]
    #[Assert\GreaterThan("today")]  // La date de début doit être dans le futur
    private $dateDebut;  // Date et heure de début de l'événement

    #[ORM\Column(type: 'datetime')]
    #[Assert\GreaterThan(propertyPath: "dateDebut")]  // La date de fin doit être après la date de début
    private $dateFin;  // Date et heure de fin de l'événement

    #[ORM\Column(type: 'string', length: 255)]
    private $lieu;  // Lieu de l'événement

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $image;  // Image de l'événement (facultatif)

    #[ORM\Column(type: 'decimal', scale: 2, nullable: true)]
    private $prix;  // Prix de l'événement (si applicable)

    #[ORM\Column(type: 'string', length: 50)]
    private $status;  // Statut de l'événement (actif, terminé, annulé, etc.)

    #[ORM\Column(type: 'datetime')]
    private $createdAt;  // Date de création de l'événement

    #[ORM\Column(type: 'datetime')]
    private $updatedAt;  // Date de la dernière mise à jour

    // Getters et Setters...


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;
        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->lieu;
    }

    public function setLieu(string $lieu): self
    {
        $this->lieu = $lieu;
        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(?string $prix): self
    {
        $this->prix = $prix;
        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }






}
