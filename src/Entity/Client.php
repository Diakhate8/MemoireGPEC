<?php

namespace App\Entity;

use App\Entity\Personne;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints\Unique;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 */
class Client extends Personne
{
    
    /**
     * @ORM\Column(type="string", length=25, unique=true)
     * @Assert\Unique
     */
    private $numClient;
 
    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\NotBlank(message="entrez votre piece didentite ou passeword")
     */
    private $cni;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDCni;

    /**
     * @ORM\Column(type="date")
     */
    private $dateECni;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $domicile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contrat", mappedBy="client")
     */
    private $contrats;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contrat", mappedBy="userCreateur")
     */
    private $contrat;

    public function __construct()
    {
        $this->contrats = new ArrayCollection();
        $this->contrat = new ArrayCollection();
    }
   

    public function getNumClient(): ?string
    {
        return $this->numClient;
    }

    public function setNumClient(string $numClient): self
    {
        $this->numClient = $numClient;

        return $this;
    }
    public function getDateDCni(): ?\DateTimeInterface
    {
        return $this->dateDCni;
    }

    public function setDateDCni(\DateTimeInterface $dateDCni): self
    {
        $this->dateDCni = $dateDCni;

        return $this;
    }

    public function getDateECni(): ?\DateTimeInterface
    {
        return $this->dateECni;
    }

    public function setDateECni(\DateTimeInterface $dateECni): self
    {
        $this->dateECni = $dateECni;

        return $this;
    }

    /**
     * Get the value of cni
     */ 
    public function getCni()
    {
        return $this->cni;
    }

    /**
     * Set the value of cni
     *
     * @return  self
     */ 
    public function setCni($cni)
    {
        $this->cni = $cni;

        return $this;
    }

    public function getDomicile(): ?string
    {
        return $this->domicile;
    }

    public function setDomicile(?string $domicile): self
    {
        $this->domicile = $domicile;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
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
            $contrat->setClient($this);
        }

        return $this;
    }

    public function removeContrat(Contrat $contrat): self
    {
        if ($this->contrats->contains($contrat)) {
            $this->contrats->removeElement($contrat);
            // set the owning side to null (unless already changed)
            if ($contrat->getClient() === $this) {
                $contrat->setClient(null);
            }
        }

        return $this;
    }

   

   
   
}
