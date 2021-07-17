<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CountryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CountryRepository::class)
 */
class Country
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read", "one"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Groups({"read", "one"})
     * @Assert\NotBlank
     * @Assert\Type("string")
     */
    private $countryName;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "one"})
     * @Assert\Type("string")
     */
    private $countryImg;

    /**
     * @ORM\OneToMany(targetEntity=Poeples::class, mappedBy="idCountry")
     */
    private $poeples;

    /**
     * @ORM\ManyToMany(targetEntity=Animals::class, mappedBy="idCountry")
     * @Groups("read")
     * 
     */
    private $animals;

    /**
     * @ORM\OneToMany(targetEntity=Department::class, mappedBy="country")
     */
    private $idDepartment;

    public function __construct()
    {
        $this->poeples = new ArrayCollection();
        $this->animals = new ArrayCollection();
        $this->idDepartment = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    public function setCountryName(string $countryName): self
    {
        $this->countryName = $countryName;

        return $this;
    }

    public function getCountryImg(): ?string
    {
        return $this->countryImg;
    }

    public function setCountryImg(?string $countryImg): self
    {
        $this->countryImg = $countryImg;

        return $this;
    }

    /**
     * @return Collection|Poeples[]
     */
    public function getPoeples(): Collection
    {
        return $this->poeples;
    }

    public function addPoeple(Poeples $poeple): self
    {
        if (!$this->poeples->contains($poeple)) {
            $this->poeples[] = $poeple;
            $poeple->setIdCountry($this);
        }

        return $this;
    }

    public function removePoeple(Poeples $poeple): self
    {
        if ($this->poeples->removeElement($poeple)) {
            // set the owning side to null (unless already changed)
            if ($poeple->getIdCountry() === $this) {
                $poeple->setIdCountry(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Animals[]
     */
    public function getAnimals(): Collection
    {
        return $this->animals;
    }

    public function addAnimal(Animals $animal): self
    {
        if (!$this->animals->contains($animal)) {
            $this->animals[] = $animal;
            $animal->addIdCountry($this);
        }

        return $this;
    }

    public function removeAnimal(Animals $animal): self
    {
        if ($this->animals->removeElement($animal)) {
            $animal->removeIdCountry($this);
        }

        return $this;
    }

    /**
     * @return Collection|Department[]
     */
    public function getIdDepartment(): Collection
    {
        return $this->idDepartment;
    }

    public function addIdDepartment(Department $idDepartment): self
    {
        if (!$this->idDepartment->contains($idDepartment)) {
            $this->idDepartment[] = $idDepartment;
            $idDepartment->setCountry($this);
        }

        return $this;
    }

    public function removeIdDepartment(Department $idDepartment): self
    {
        if ($this->idDepartment->removeElement($idDepartment)) {
            // set the owning side to null (unless already changed)
            if ($idDepartment->getCountry() === $this) {
                $idDepartment->setCountry(null);
            }
        }

        return $this;
    }
}
