<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PizzasRepository")
 */
class Pizzas
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Toppings", inversedBy="ToppingId")
     */
    private $topping_id;

    public function __construct()
    {
        $this->topping_id = new ArrayCollection();
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

    /**
     * @return Collection|Toppings[]
     */
    public function getToppingId(): Collection
    {
        return $this->topping_id;
    }

    public function addToppingId(Toppings $toppingId): self
    {
        if (!$this->topping_id->contains($toppingId)) {
            $this->topping_id[] = $toppingId;
        }

        return $this;
    }

    public function removeToppingId(Toppings $toppingId): self
    {
        if ($this->topping_id->contains($toppingId)) {
            $this->topping_id->removeElement($toppingId);
        }

        return $this;
    }
}
