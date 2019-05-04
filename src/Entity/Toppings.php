<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ToppingsRepository")
 */
class Toppings
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
     * @ORM\ManyToMany(targetEntity="App\Entity\Pizzas", mappedBy="topping_id")
     */
    private $ToppingId;

    public function __construct()
    {
        $this->ToppingId = new ArrayCollection();
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

    public function addPizzaId(Pizzas $pizzaId): self
    {
        if (!$this->pizza_id->contains($pizzaId)) {
            $this->pizza_id[] = $pizzaId;
        }

        return $this;
    }

    public function removePizzaId(Pizzas $pizzaId): self
    {
        if ($this->pizza_id->contains($pizzaId)) {
            $this->pizza_id->removeElement($pizzaId);
        }

        return $this;
    }

    /**
     * @return Collection|Pizzas[]
     */
    public function getToppingId(): Collection
    {
        return $this->ToppingId;
    }

    public function addToppingId(Pizzas $toppingId): self
    {
        if (!$this->ToppingId->contains($toppingId)) {
            $this->ToppingId[] = $toppingId;
            $toppingId->addToppingId($this);
        }

        return $this;
    }

    public function removeToppingId(Pizzas $toppingId): self
    {
        if ($this->ToppingId->contains($toppingId)) {
            $this->ToppingId->removeElement($toppingId);
            $toppingId->removeToppingId($this);
        }

        return $this;
    }
}
