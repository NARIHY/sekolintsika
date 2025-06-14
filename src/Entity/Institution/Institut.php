<?php

namespace App\Entity\Institution;

use App\Repository\Institution\InstitutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InstitutRepository::class)]
class Institut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    /**
     * @var Collection<int, NiveauEtude>
     */
    #[ORM\OneToMany(targetEntity: NiveauEtude::class, mappedBy: 'institut')]
    private Collection $niveauEtudes;

    #[ORM\Column]
    private ?\DateTime $dateCreation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateModification = null;

    public function __construct()
    {
        $this->niveauEtudes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, NiveauEtude>
     */
    public function getNiveauEtudes(): Collection
    {
        return $this->niveauEtudes;
    }

    public function addNiveauEtude(NiveauEtude $niveauEtude): static
    {
        if (!$this->niveauEtudes->contains($niveauEtude)) {
            $this->niveauEtudes->add($niveauEtude);
            $niveauEtude->setInstitut($this);
        }

        return $this;
    }

    public function removeNiveauEtude(NiveauEtude $niveauEtude): static
    {
        if ($this->niveauEtudes->removeElement($niveauEtude)) {
            // set the owning side to null (unless already changed)
            if ($niveauEtude->getInstitut() === $this) {
                $niveauEtude->setInstitut(null);
            }
        }

        return $this;
    }

    public function getDateCreation(): ?\DateTime
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTime $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateModification(): ?\DateTime
    {
        return $this->dateModification;
    }

    public function setDateModification(?\DateTime $dateModification): static
    {
        $this->dateModification = $dateModification;

        return $this;
    }
}
