<?php

namespace App\Entity;

use App\Enums\TableStatus;
use App\Repository\TableRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TableRepository::class)]
#[ORM\Table(name: '`table`')]
class Table
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $number = null;

    #[ORM\Column]
    private ?int $capacity = null;

    #[ORM\Column(type: 'integer', nullable: false, enumType: TableStatus::class)]
    private TableStatus $status;

    public function isOccupied(): bool
    {
        return $this->status === TableStatus::OCCUPIED;
    }

    public function getStatus(): TableStatus
    {
        return $this->status;
    }

    public function setStatus(TableStatus $status): void
    {
        $this->status = $status;
    }

    /**
     * @var Collection<int, TableOrder>
     */
    #[ORM\OneToMany(targetEntity: TableOrder::class, mappedBy: 'occupiedTable')]
    private Collection $tableOrders;

    public function __construct()
    {
        $this->tableOrders = new ArrayCollection();
        $this->status = TableStatus::EMPTY;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumber(): ?int
    {
        return $this->number;
    }

    public function setNumber(int $number): static
    {
        $this->number = $number;

        return $this;
    }

    public function getCapacity(): ?int
    {
        return $this->capacity;
    }

    public function setCapacity(int $capacity): static
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * @return Collection<int, TableOrder>
     */
    public function getTableOrders(): Collection
    {
        return $this->tableOrders;
    }

    public function addTableOrder(TableOrder $tableOrder): static
    {
        if (!$this->tableOrders->contains($tableOrder)) {
            $this->tableOrders->add($tableOrder);
            $tableOrder->setOccupiedTable($this);
        }

        return $this;
    }

    public function removeTableOrder(TableOrder $tableOrder): static
    {
        if ($this->tableOrders->removeElement($tableOrder)) {
            // set the owning side to null (unless already changed)
            if ($tableOrder->getOccupiedTable() === $this) {
                $tableOrder->setOccupiedTable(null);
            }
        }

        return $this;
    }
}
