<?php

namespace App\Entity\Institution;

use App\Repository\Institution\AnneeDEtudeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnneeDEtudeRepository::class)]
class AnneeDEtude
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTime $dateOuCommenceLAnne = null;

    #[ORM\Column]
    private ?\DateTime $dateOuTermineLAnneeDEtude = null;

    /**
     * @var Collection<int, Classe>
     */
    #[ORM\OneToMany(targetEntity: Classe::class, mappedBy: 'anneeDEtude')]
    private Collection $classes;

    #[ORM\Column]
    private ?\DateTime $dateCreation = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTime $dateModification = null;

    public function __construct()
    {
        $this->classes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateOuCommenceLAnne(): ?\DateTime
    {
        return $this->dateOuCommenceLAnne;
    }

    public function setDateOuCommenceLAnne(\DateTime $dateOuCommenceLAnne): static
    {
        $this->dateOuCommenceLAnne = $dateOuCommenceLAnne;

        return $this;
    }

    public function getDateOuTermineLAnneeDEtude(): ?\DateTime
    {
        return $this->dateOuTermineLAnneeDEtude;
    }

    public function setDateOuTermineLAnneeDEtude(\DateTime $dateOuTermineLAnneeDEtude): static
    {
        $this->dateOuTermineLAnneeDEtude = $dateOuTermineLAnneeDEtude;

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasses(): Collection
    {
        return $this->classes;
    }

    public function addClass(Classe $class): static
    {
        if (!$this->classes->contains($class)) {
            $this->classes->add($class);
            $class->setAnneeDEtude($this);
        }

        return $this;
    }

    public function removeClass(Classe $class): static
    {
        if ($this->classes->removeElement($class)) {
            // set the owning side to null (unless already changed)
            if ($class->getAnneeDEtude() === $this) {
                $class->setAnneeDEtude(null);
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
