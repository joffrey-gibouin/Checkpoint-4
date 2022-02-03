<?php

namespace App\Entity;

use App\Repository\MenuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MenuRepository::class)
 */
class Menu
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredient::class, mappedBy="menus")
     */
    private $ingredients;

    /**
     * @ORM\ManyToMany(targetEntity=Miamlist::class, mappedBy="menu")
     */
    private $miamlists;

    public function __construct()
    {
        $this->ingredients = new ArrayCollection();
        $this->miamlists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients[] = $ingredient;
            $ingredient->addMenu($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredients->removeElement($ingredient)) {
            $ingredient->removeMenu($this);
        }

        return $this;
    }

    /**
     * @return Collection|Miamlist[]
     */
    public function getMiamlists(): Collection
    {
        return $this->miamlists;
    }

    public function addMiamlist(Miamlist $miamlist): self
    {
        if (!$this->miamlists->contains($miamlist)) {
            $this->miamlists[] = $miamlist;
            $miamlist->addMenu($this);
        }

        return $this;
    }

    public function removeMiamlist(Miamlist $miamlist): self
    {
        if ($this->miamlists->removeElement($miamlist)) {
            $miamlist->removeMenu($this);
        }

        return $this;
    }
}
