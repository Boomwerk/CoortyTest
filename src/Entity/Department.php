<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\DepartmentRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DepartmentRepository::class)
 */
class Department
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"read", "one"})
     * @Assert\NotBlank
     */
    private $nameDepartment;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Groups({"read", "one"})
     */
    private $imgDepartment;

    /**
     * @ORM\OneToMany(targetEntity=Poeples::class, mappedBy="idDepartment")
     * @Groups("read")
     */
    private $poeples;

    /**
     * @ORM\ManyToOne(targetEntity=Country::class, inversedBy="idDepartment")
     * @ORM\JoinColumn(nullable=false)
     * @Groups("read")
     */
    private $country;

    public function __construct()
    {
        $this->poeples = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameDepartment(): ?string
    {
        return $this->nameDepartment;
    }

    public function setNameDepartment(string $nameDepartment): self
    {
        $this->nameDepartment = $nameDepartment;

        return $this;
    }

    public function getImgDepartment(): ?string
    {
        return $this->imgDepartment;
    }

    public function setImgDepartment(?string $imgDepartment): self
    {
        $this->imgDepartment = $imgDepartment;

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
            $poeple->setIdDepartment($this);
        }

        return $this;
    }

    public function removePoeple(Poeples $poeple): self
    {
        if ($this->poeples->removeElement($poeple)) {
            // set the owning side to null (unless already changed)
            if ($poeple->getIdDepartment() === $this) {
                $poeple->setIdDepartment(null);
            }
        }

        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;

        return $this;
    }
}
