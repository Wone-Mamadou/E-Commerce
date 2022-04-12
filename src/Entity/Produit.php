<?php

namespace App\Entity;

use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProduitRepository::class)]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'text', nullable: true)]
    private $infoComplémentaire;

    #[ORM\Column(type: 'float')]
    private $prix;

    #[ORM\Column(type: 'boolean')]
    private $meileureVente = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $nouvelleArrivage = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isFeaturead = false;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $offreSpéciale = false;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'produits')]
    private $categories;

    #[ORM\ManyToMany(targetEntity: TagsProduit::class, mappedBy: 'produit')]
    private $tagsProduits;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: ProduitEnRelation::class)]
    private $produitEnRelations;

    #[ORM\OneToMany(mappedBy: 'produit', targetEntity: AvisProduit::class)]
    private $avisProduits;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
        $this->tagsProduits = new ArrayCollection();
        $this->produitEnRelations = new ArrayCollection();
        $this->avisProduits = new ArrayCollection();
    }

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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getInfoComplémentaire(): ?string
    {
        return $this->infoComplémentaire;
    }

    public function setInfoComplémentaire(?string $infoComplémentaire): self
    {
        $this->infoComplémentaire = $infoComplémentaire;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getMeileureVente(): ?bool
    {
        return $this->meileureVente;
    }

    public function setMeileureVente(bool $meileureVente): self
    {
        $this->meileureVente = $meileureVente;

        return $this;
    }

    public function getNouvelleArrivage(): ?bool
    {
        return $this->nouvelleArrivage;
    }

    public function setNouvelleArrivage(?bool $nouvelleArrivage): self
    {
        $this->nouvelleArrivage = $nouvelleArrivage;

        return $this;
    }

    public function getIsFeaturead(): ?bool
    {
        return $this->isFeaturead;
    }

    public function setIsFeaturead(?bool $isFeaturead): self
    {
        $this->isFeaturead = $isFeaturead;

        return $this;
    }

    public function getOffreSpéciale(): ?bool
    {
        return $this->offreSpéciale;
    }

    public function setOffreSpéciale(?bool $offreSpéciale): self
    {
        $this->offreSpéciale = $offreSpéciale;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Categories $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
        }

        return $this;
    }

    public function removeCategory(Categories $category): self
    {
        $this->categories->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, TagsProduit>
     */
    public function getTagsProduits(): Collection
    {
        return $this->tagsProduits;
    }

    public function addTagsProduit(TagsProduit $tagsProduit): self
    {
        if (!$this->tagsProduits->contains($tagsProduit)) {
            $this->tagsProduits[] = $tagsProduit;
            $tagsProduit->addProduit($this);
        }

        return $this;
    }

    public function removeTagsProduit(TagsProduit $tagsProduit): self
    {
        if ($this->tagsProduits->removeElement($tagsProduit)) {
            $tagsProduit->removeProduit($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, ProduitEnRelation>
     */
    public function getProduitEnRelations(): Collection
    {
        return $this->produitEnRelations;
    }

    public function addProduitEnRelation(ProduitEnRelation $produitEnRelation): self
    {
        if (!$this->produitEnRelations->contains($produitEnRelation)) {
            $this->produitEnRelations[] = $produitEnRelation;
            $produitEnRelation->setProduit($this);
        }

        return $this;
    }

    public function removeProduitEnRelation(ProduitEnRelation $produitEnRelation): self
    {
        if ($this->produitEnRelations->removeElement($produitEnRelation)) {
            // set the owning side to null (unless already changed)
            if ($produitEnRelation->getProduit() === $this) {
                $produitEnRelation->setProduit(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, AvisProduit>
     */
    public function getAvisProduits(): Collection
    {
        return $this->avisProduits;
    }

    public function addAvisProduit(AvisProduit $avisProduit): self
    {
        if (!$this->avisProduits->contains($avisProduit)) {
            $this->avisProduits[] = $avisProduit;
            $avisProduit->setProduit($this);
        }

        return $this;
    }

    public function removeAvisProduit(AvisProduit $avisProduit): self
    {
        if ($this->avisProduits->removeElement($avisProduit)) {
            // set the owning side to null (unless already changed)
            if ($avisProduit->getProduit() === $this) {
                $avisProduit->setProduit(null);
            }
        }

        return $this;
    }
}
