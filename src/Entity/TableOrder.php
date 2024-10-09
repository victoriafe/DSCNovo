<?php

namespace App\Entity;

use App\Repository\TableOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TableOrderRepository::class)]
class TableOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $orderDate = null;

    #[ORM\Column]
    private ?float $totalValue = null;

    #[ORM\ManyToOne(inversedBy: 'tableOrders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Table $occupiedTable = null;

    /**
     * @var Collection<int, Order>
     */
    #[ORM\OneToMany(targetEntity: Order::class, mappedBy: 'tableOrder')]
    private Collection $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrderDate(): ?\DateTimeInterface
    {
        return $this->orderDate;
    }

    public function setOrderDate(\DateTimeInterface $orderDate): static
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    public function getTotalValue(): ?float
    {
        return $this->totalValue;
    }

    public function setTotalValue(float $totalValue): static
    {
        $this->totalValue = $totalValue;

        return $this;
    }

    public function getOccupiedTable(): ?Table
    {
        return $this->occupiedTable;
    }

    public function setOccupiedTable(?Table $occupiedTable): static
    {
        $this->occupiedTable = $occupiedTable;

        return $this;
    }

    /**
     * @return Collection<int, Order>
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): static
    {
        if (!$this->orders->contains($order)) {
            $this->orders->add($order);
            $order->setTableOrder($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): static
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getTableOrder() === $this) {
                $order->setTableOrder(null);
            }
        }

        return $this;
    }
}
