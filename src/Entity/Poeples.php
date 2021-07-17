<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\PoeplesRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PoeplesRepository::class)
 */
class Poeples
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read", "one"})
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"read", "one"})
     * @Assert\NotBlank
     */
    private $numberPeople;

    /**
     * @ORM\ManyToOne(targetEntity=Department::class, inversedBy="poeples")
     */
    private $idDepartment;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="poeples")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idCountry;

    /**
     * @ORM\ManyToOne(targetEntity=Animals::class, inversedBy="poeples")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idAnimals;

    /**
     * @ORM\ManyToOne(targetEntity=Breeds::class, inversedBy="poeples")
     * @ORM\JoinColumn(nullable=false)
     */
    private $idBreeds;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumberPeople(): ?int
    {
        return $this->numberPeople;
    }

    public function setNumberPeople(int $numberPeople): self
    {
        $this->numberPeople = $numberPeople;

        return $this;
    }

    public function getIdDepartment(): ?Department
    {
        return $this->idDepartment;
    }

    public function setIdDepartment(?Department $idDepartment): self
    {
        $this->idDepartment = $idDepartment;

        return $this;
    }

    public function getIdCountry(): ?Country
    {
        return $this->idCountry;
    }

    public function setIdCountry(?Country $idCountry): self
    {
        $this->idCountry = $idCountry;

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

    public function getIdBreeds(): ?Breeds
    {
        return $this->idBreeds;
    }

    public function setIdBreeds(?Breeds $idBreeds): self
    {
        $this->idBreeds = $idBreeds;

        return $this;
    }
}
