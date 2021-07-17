<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AnimalsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=AnimalsRepository::class)
 * 
 */
class Animals
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read", "one"})
     * 
     */
    private $id;
    

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "one"})
     * @Assert\NotBlank
     * @Assert\Type("string")
     * 
     */
    private $nameAnimals;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *@Groups({"read", "one"})
     * @Assert\Type("string")
     */
    private $imgAnimal;

    /**
     * @ORM\OneToMany(targetEntity=Poeples::class, mappedBy="idAnimals")
     *
     */
    private $poeples;

    /**
     * @ORM\OneToMany(targetEntity=Breeds::class, mappedBy="idAnimals")
     * @Groups("read")
     * 
     */
    private $breeds;

    /**
     * @ORM\ManyToMany(targetEntity=Country::class, inversedBy="animals")
     *
     */
    private $idCountry;

    public function __construct()
    {
        $this->poeples = new ArrayCollection();
        $this->breeds = new ArrayCollection();
        $this->idCountry = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameAnimals(): ?string
    {
        return $this->nameAnimals;
    }

    public function setNameAnimals(string $nameAnimals): self
    {
        $this->nameAnimals = $nameAnimals;

        return $this;
    }

    public function getImgAnimal(): ?string
    {
        return $this->imgAnimal;
    }

    public function setImgAnimal(?string $imgAnimal): self
    {
        $this->imgAnimal = $imgAnimal;

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
            $poeple->setIdAnimals($this);
        }

        return $this;
    }

    public function removePoeple(Poeples $poeple): self
    {
        if ($this->poeples->removeElement($poeple)) {
            // set the owning side to null (unless already changed)
            if ($poeple->getIdAnimals() === $this) {
                $poeple->setIdAnimals(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Breeds[]
     */
    public function getBreeds(): Collection
    {
        return $this->breeds;
    }

    public function addBreed(Breeds $breed): self
    {
        if (!$this->breeds->contains($breed)) {
            $this->breeds[] = $breed;
            $breed->setIdAnimals($this);
        }

        return $this;
    }

    public function removeBreed(Breeds $breed): self
    {
        if ($this->breeds->removeElement($breed)) {
            // set the owning side to null (unless already changed)
            if ($breed->getIdAnimals() === $this) {
                $breed->setIdAnimals(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Country[]
     */
    public function getIdCountry(): Collection
    {
        return $this->idCountry;
    }

    public function addIdCountry(Country $idCountry): self
    {
        if (!$this->idCountry->contains($idCountry)) {
            $this->idCountry[] = $idCountry;
        }

        return $this;
    }

    public function removeIdCountry(Country $idCountry): self
    {
        $this->idCountry->removeElement($idCountry);

        return $this;
    }
}
