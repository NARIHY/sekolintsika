<?php

namespace App\Entity\Institution;

use App\Entity\Institution\Academic\UniteEnseignement;
use App\Repository\Institution\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'classes')]
    private ?Programme $programme = null;

    #[ORM\ManyToOne(inversedBy: 'classes')]
    private ?AnneeDEtude $anneeDEtude = null;

    /**
     * @var Collection<int, Etudiant>
     */
    #[ORM\OneToMany(targetEntity: Etudiant::class, mappedBy: 'classe')]
    private Collection $etudiants;

    /**
     * @var Collection<int, UniteEnseignement>
     */
    #[ORM\OneToMany(targetEntity: UniteEnseignement::class, mappedBy: 'classe')]
    private Collection $uniteEnseignements;

    #[ORM\Column]
    private ?\DateTime $dateCreation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateModification = null;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
        $this->uniteEnseignements = new ArrayCollection();
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

    public function getProgramme(): ?Programme
    {
        return $this->programme;
    }

    public function setProgramme(?Programme $programme): static
    {
        $this->programme = $programme;

        return $this;
    }

    public function getAnneeDEtude(): ?AnneeDEtude
    {
        return $this->anneeDEtude;
    }

    public function setAnneeDEtude(?AnneeDEtude $anneeDEtude): static
    {
        $this->anneeDEtude = $anneeDEtude;

        return $this;
    }

    /**
     * @return Collection<int, Etudiant>
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): static
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants->add($etudiant);
            $etudiant->setClasse($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): static
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getClasse() === $this) {
                $etudiant->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, UniteEnseignement>
     */
    public function getUniteEnseignements(): Collection
    {
        return $this->uniteEnseignements;
    }

    public function addUniteEnseignement(UniteEnseignement $uniteEnseignement): static
    {
        if (!$this->uniteEnseignements->contains($uniteEnseignement)) {
            $this->uniteEnseignements->add($uniteEnseignement);
            $uniteEnseignement->setClasse($this);
        }

        return $this;
    }

    public function removeUniteEnseignement(UniteEnseignement $uniteEnseignement): static
    {
        if ($this->uniteEnseignements->removeElement($uniteEnseignement)) {
            // set the owning side to null (unless already changed)
            if ($uniteEnseignement->getClasse() === $this) {
                $uniteEnseignement->setClasse(null);
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
