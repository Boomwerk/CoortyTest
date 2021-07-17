<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BreedsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=BreedsRepository::class)
 */
class Breeds
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read", "one"})
 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "one"})
     * @Assert\NotBlank
   
     */
    private $nameBreed;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "one"})
     * @Assert\NotBlank
     */
    private $sizeBreed;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "one"})
     * @Assert\NotBlank
     */
    private $ageBreed;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "one"})
     */
    private $imgAnimal;

    /**
     * @ORM\OneToMany(targetEntity=Poeples::class, mappedBy="idBreeds")
     */
    private $poeples;

    /**
     * @ORM\ManyToOne(targetEntity=Animals::class, inversedBy="breeds")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAnimals;

    public function __construct()
    {
        $this->poeples = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameBreed(): ?string
    {
        return $this->nameBreed;
    }

    public function setNameBreed(string $nameBreed): self
    {
        $this->nameBreed = $nameBreed;

        return $this;
    }

    public function getSizeBreed(): ?string
    {
        return $this->sizeBreed;
    }

    public function setSizeBreed(string $sizeBreed): self
    {
        $this->sizeBreed = $sizeBreed;

        return $this;
    }

    public function getAgeBreed(): ?int
    {
        return $this->ageBreed;
    }

    public function setAgeBreed(int $ageBreed): self
    {
        $this->ageBreed = $ageBreed;

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
            $poeple->setIdBreeds($this);
        }

        return $this;
    }

    public function removePoeple(Poeples $poeple): self
    {
        if ($this->poeples->removeElement($poeple)) {
            // set the owning side to null (unless already changed)
            if ($poeple->getIdBreeds() === $this) {
                $poeple->setIdBreeds(null);
            }
        }

        return $this;
    }

    public function getIdAnimals(): ?Animals
    {
        return $this->idAnimals;
    }

    public function setIdAnimals(?Animals $idAnimals): self
    {
        $this->idAnimals = $idAnimals;

        return $this;
    }
}
