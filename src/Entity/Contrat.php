<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\ContratRepository")
 */
class Contrat
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=55)
     */
    private $numContrat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;
 /**
     * @ORM\Column(type="string", length=255)
     */
    private $libele;
  
    /**
     * @ORM\Column(type="text")
     */
    private $intitule;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $arrete;

    /**
     * @ORM\Column(type="text")
     */
    private $preambule;

    /**
     * @ORM\Column(type="text")
     */
    private $article1;

    /**
     * @ORM\Column(type="text")
     */
    private $article2;

    /**
     * @ORM\Column(type="text")
     */
    private $article3;

    /**
     * @ORM\Column(type="text")
     */
    private $article4;

    /**
     * @ORM\Column(type="text")
     */
    private $article5;

    /**
     * @ORM\Column(type="text")
     */
    private $article6;

    /**
     * @ORM\Column(type="text")
     */
    private $article7;

    /**
     * @ORM\Column(type="text")
     */
    private $article8;

    /**
     * @ORM\Column(type="text")
     */
    private $article9;

    /**
     * @ORM\Column(type="text")
     */
    private $article10;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Facture", mappedBy="contrat")
     */
    private $factures;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="contrats")
     */
    private $client;

    /**
     * @ORM\Column(type="date")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="contrats")
     */
    private $userCreateur;

    public function __construct()
    {
        $this->factures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get the value of numContrat
     */ 
    public function getNumContrat()
    {
        return $this->numContrat;
    }

    /**
     * Set the value of numContrat
     *
     * @return  self
     */ 
    public function setNumContrat($numContrat)
    {
        $this->numContrat = $numContrat;

        return $this;
    }

    public function getLibele(): ?string
    {
        return $this->libele;
    }

    public function setLibele(string $libele): self
    {
        $this->libele = $libele;

        return $this;
    }
    
    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getPreambule(): ?string
    {
        return $this->preambule;
    }

    public function setPreambule(string $preambule): self
    {
        $this->preambule = $preambule;

        return $this;
    }

    public function getArrete(): ?string
    {
        return $this->arrete;
    }

    public function setArrete(string $arrete): self
    {
        $this->arrete = $arrete;

        return $this;
    }

    public function getArticle1(): ?string
    {
        return $this->article1;
    }

    public function setArticle1(string $article1): self
    {
        $this->article1 = $article1;

        return $this;
    }

    public function getArticle2(): ?string
    {
        return $this->article2;
    }

    public function setArticle2(string $article2): self
    {
        $this->article2 = $article2;

        return $this;
    }

    public function getArticle3(): ?string
    {
        return $this->article3;
    }

    public function setArticle3(string $article3): self
    {
        $this->article3 = $article3;

        return $this;
    }

    public function getArticle4(): ?string
    {
        return $this->article4;
    }

    public function setArticle4(string $article4): self
    {
        $this->article4 = $article4;

        return $this;
    }

    public function getArticle5(): ?string
    {
        return $this->article5;
    }

    public function setArticle5(string $article5): self
    {
        $this->article5 = $article5;

        return $this;
    }

    public function getArticle6(): ?string
    {
        return $this->article6;
    }

    public function setArticle6(string $article6): self
    {
        $this->article6 = $article6;

        return $this;
    }

    public function getArticle7(): ?string
    {
        return $this->article7;
    }

    public function setArticle7(string $article7): self
    {
        $this->article7 = $article7;

        return $this;
    }

    public function getArticle8(): ?string
    {
        return $this->article8;
    }

    public function setArticle8(string $article8): self
    {
        $this->article8 = $article8;

        return $this;
    }

    public function getArticle9(): ?string
    {
        return $this->article9;
    }

    public function setArticle9(string $article9): self
    {
        $this->article9 = $article9;

        return $this;
    }

    public function getArticle10(): ?string
    {
        return $this->article10;
    }

    public function setArticle10(string $article10): self
    {
        $this->article10 = $article10;

        return $this;
    }

    /**
     * @return Collection|Facture[]
     */
    public function getFactures(): Collection
    {
        return $this->factures;
    }

    public function addFacture(Facture $facture): self
    {
        if (!$this->factures->contains($facture)) {
            $this->factures[] = $facture;
            $facture->setContrat($this);
        }

        return $this;
    }

    public function removeFacture(Facture $facture): self
    {
        if ($this->factures->contains($facture)) {
            $this->factures->removeElement($facture);
            // set the owning side to null (unless already changed)
            if ($facture->getContrat() === $this) {
                $facture->setContrat(null);
            }
        }

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

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

    public function getUserCreateur(): ?User
    {
        return $this->userCreateur;
    }

    public function setUserCreateur(?User $userCreateur): self
    {
        $this->userCreateur = $userCreateur;

        return $this;
    }

}
