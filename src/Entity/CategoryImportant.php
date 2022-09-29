<?php

namespace App\Entity;

use App\Repository\CategoryImportantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryImportantRepository::class)]
class CategoryImportant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'categoryImportant', targetEntity: Todolist::class)]
    private Collection $TodoImportant;

    public function __construct()
    {
        $this->TodoImportant = new ArrayCollection();
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

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Todolist>
     */
    public function getTodoImportant(): Collection
    {
        return $this->TodoImportant;
    }

    public function addTodoImportant(Todolist $todoImportant): self
    {
        if (!$this->TodoImportant->contains($todoImportant)) {
            $this->TodoImportant->add($todoImportant);
            $todoImportant->setCategoryImportant($this);
        }

        return $this;
    }

    public function removeTodoImportant(Todolist $todoImportant): self
    {
        if ($this->TodoImportant->removeElement($todoImportant)) {
            // set the owning side to null (unless already changed)
            if ($todoImportant->getCategoryImportant() === $this) {
                $todoImportant->setCategoryImportant(null);
            }
        }

        return $this;
    }
}
