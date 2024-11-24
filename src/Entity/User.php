<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepository::class)]
class User 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string')]
    private $nom; 
    

    #[ORM\Column(type: 'string')]
    private $prenom;

    #[ORM\Column(type: 'string')]
    private $password; // Mot de passe (crypté)

    #[ORM\Column(type: 'json')]
    private $roles = []; // Rôles de l'utilisateur

    #[ORM\Column(type: 'date', nullable: true)]
    #[Assert\Date] // Vérifie que la valeur est une date valide
    #[Assert\LessThan("today")] // La date doit être antérieure à aujourd'hui
    private $dateNaissance;

    #[ORM\Column(type: 'string')] 
    private $email ;


     #[Assert\Length(min: 10, max: 15)]
    #[Assert\Regex(pattern: "/^[0-9]+$/", message: "Le numéro de téléphone doit être numérique.")]
    private $telephone; 

    #[ORM\Column(type: 'string')]
    private $adresse;



     // Getters et Setters 

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    // Méthode nécessaire pour UserInterface, mais vous pouvez le laisser vide si vous n'en avez pas besoin
    public function eraseCredentials()
    {
        // Cette méthode peut être laissée vide si vous n'avez pas de données sensibles à effacer
    } 


    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }
   
    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(?\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;
        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(?string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }
    

}


