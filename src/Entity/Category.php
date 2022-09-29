<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category', targetEntity: Todolist::class)]
    private Collection $TodoCategory;

    public function __construct()
    {
        $this->TodoCategory = new ArrayCollection();
    }

    public function __toString() {
        return $this->getName();
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
     * @return Collection<int, Todolist>
     */
    public function getTodoCategory(): Collection
    {
        return $this->TodoCategory;
    }

    public function addTodoCategory(Todolist $todoCategory): self
    {
        if (!$this->TodoCategory->contains($todoCategory)) {
            $this->TodoCategory->add($todoCategory);
            $todoCategory->setCategory($this);
        }

        return $this;
    }

    public function removeTodoCategory(Todolist $todoCategory): self
    {
        if ($this->TodoCategory->removeElement($todoCategory)) {
            // set the owning side to null (unless already changed)
            if ($todoCategory->getCategory() === $this) {
                $todoCategory->setCategory(null);
            }
        }

        return $this;
    }
}
