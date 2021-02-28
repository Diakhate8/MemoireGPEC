<?php

namespace App\Entity;

use App\Entity\Personne;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ApiResource(
 *     itemOperations={
 *          "get"={ "access_control"="is_granted('CAN_POST', object)",

 *              "normalization_context"={"groups"={"user:read", "user:item:get"}},
 *          },
 *          "put"={
 *              "access_control"="is_granted('CAN_POST', object)",
 *              "access_control_message"="Accés non autorisé"
 *          },
 *          "delete"={"access_control"="is_granted('CAN_POST',object)"}
 *     },
 *     collectionOperations={
 *          "get"={"security"="is_granted(['ROLE_ADMIN_SYSTEM', 'ROLE_ADMIN'])"},
 *          "post"={"access_control"="is_granted('CAN_POST',object)"}
 *     }
 * )
 */
class User extends Personne implements UserInterface 
{

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"post:read", "post:write"})
     * @Assert\NotBlank(message="entrez username")
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255 )
     * @Groups({"post:read", "post:write"})
     * @Assert\NotBlank(message="entrez votre password")
     */
    private $password;


    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Groups({"post:read", "post:write"})
     * @Assert\Email(
     *     message = "The email is not a valid email."
     * )
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Role", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"post:read", "post:write"})
     * @Assert\NotBlank
     */
    private $role;

    private $roles = [];

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"post:read", "post:write"})
     */
    private $isActive;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contrat", mappedBy="userCreateur")
     */
    private $contrats;

  
    public function __construct()
    {
        $this->isActive = true;
        $this->contrats = new ArrayCollection();
       
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getRole(): ?Role
    {
        return $this->role;
    }

    public function setRole(?Role $role): self
    {
        $this->role = $role;

        return $this;
    }


    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        // guarantee every user at least has ROLE_.... 
        return $this->roles = [strtoupper($this->getRole()->getLibelle())];
    }

    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        return true;
    }

    /**
     * @return Collection|Contrat[]
     */
    public function getContrats(): Collection
    {
        return $this->contrats;
    }

    public function addContrat(Contrat $contrat): self
    {
        if (!$this->contrats->contains($contrat)) {
            $this->contrats[] = $contrat;
            $contrat->setUserCreateur($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->contains($contrat)) {
            $this->contrats->removeElement($contrat);
            // set the owning side to null (unless already changed)
            if ($contrat->getUserCreateur() === $this) {
                $contrat->setUserCreateur(null);
            }
        }

        return $this;
    }




    

}
