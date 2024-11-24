<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private $User;

    #[ORM\ManyToOne(targetEntity: Event::class, inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private $Event;
    #[ORM\Column(type: 'datetime')]
    #[Assert\GreaterThan("today")]  // La date de début doit être dans le futur
    private $dateDebut;  // Date de début de la réservation
    #[ORM\Column(type: 'datetime')]
    #[Assert\GreaterThan(propertyPath: "dateDebut")]  // La date de fin doit être après la date de début
    private $dateFin;  // Date de fin de la réservation

    #[ORM\Column(type: 'string', length: 20)]
    private $status;  // Statut de la réservation (confirmée, annulée, etc.)

    #[ORM\Column(type: 'integer')]
    private $nombrePersonnes;  // Nombre de personnes pour la réservation

    #[ORM\Column(type: 'string', length: 255)]
    private $lieu;  // Lieu de la réservation (ex : salle, hôtel, etc.)

    #[ORM\Column(type: 'datetime')]
    private $createdAt;  // Date de création de la réservation

    #[ORM\Column(type: 'datetime')]
    private $updatedAt;  // Date de la dernière mise à jour de la réservation

    #[ORM\Column(type: 'text', nullable: true)]
    private $commentaires;  // Commentaires ou demandes spéciales de l'utilisateur

    #[ORM\Column(type: 'decimal', scale: 2, nullable: true)]
    private $prix;  // Montant total de la réservation

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $moyenPaiement;  // Mode de paiement (ex : carte bancaire, PayPal)
 
     // Getters et Setters 

    public function getId(): ?int
    {
        return $this->id;
    }
       public function getUtilisateur(): ?User
    {
        return $this->utilisateur;
    }

    public function setUtilisateur(?User $utilisateur): self
    {
        $this->utilisateur = $utilisateur;
        return $this;
    }
    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): self
    {
        $this->event = $event;

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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getNombrePersonnes(): ?int
    {
        return $this->nombrePersonnes;
    }

    public function setNombrePersonnes(int $nombrePersonnes): self
    {
        $this->nombrePersonnes = $nombrePersonnes;
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

    public function getCommentaires(): ?string
    {
        return $this->commentaires;
    }

    public function setCommentaires(?string $commentaires): self
    {
        $this->commentaires = $commentaires;
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

    public function getMoyenPaiement(): ?string
    {
        return $this->moyenPaiement;
    }

    public function setMoyenPaiement(?string $moyenPaiement): self
    {
        $this->moyenPaiement = $moyenPaiement;
        return $this;
    }
}
