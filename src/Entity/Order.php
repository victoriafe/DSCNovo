<?php

namespace App\Entity;

use App\Enums\OrderStatus;
use App\Repository\OrderRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'orders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TableOrder $tableOrder = null;

    #[ORM\Column]
    private ?int $quantity = null;

    #[ORM\Column]
    private ?float $unitValue = null;

    #[ORM\Column]
    private ?float $subtotal = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Product $product = null;

    #[ORM\Column(type: 'integer', nullable: false, enumType: OrderStatus::class)]
    private OrderStatus $status;

    public function getStatus(): OrderStatus
    {
        return $this->status;
    }

    public function setStatus(OrderStatus $status): void
    {
        $this->status = $status;
    }

    public function __construct()
    {
        $this->status = OrderStatus::RECEIVED;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTableOrder(): ?TableOrder
    {
        return $this->tableOrder;
    }

    public function setTableOrder(?TableOrder $tableOrder): static
    {
        $this->tableOrder = $tableOrder;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnitValue(): ?float
    {
        return $this->unitValue;
    }

    public function setUnitValue(float $unitValue): static
    {
        $this->unitValue = $unitValue;

        return $this;
    }

    public function getSubtotal(): ?float
    {
        return $this->subtotal;
    }

    public function setSubtotal(float $subtotal): static
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): static
    {
        $this->product = $product;

        return $this;
    }
}
