<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrderRepository::class)]
#[ORM\Table(name: '`order`')]
class Order
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $createAt = null;

    #[ORM\Column]
    private ?bool $shipped = null;

    #[ORM\Column(type: Types::ARRAY)]
    private array $paymentMethod = [];

    #[ORM\Column(length: 255)]
    private ?string $cardOwner = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->createAt;
    }

    public function setCreateAt(\DateTimeInterface $createAt): self
    {
        $this->createAt = $createAt;

        return $this;
    }

    public function isShipped(): ?bool
    {
        return $this->shipped;
    }

    public function setShipped(bool $shipped): self
    {
        $this->shipped = $shipped;

        return $this;
    }

    public function getPaymentMethod(): array
    {
        return $this->paymentMethod;
    }

    public function setPaymentMethod(array $paymentMethod): self
    {
        $this->paymentMethod = $paymentMethod;

        return $this;
    }

    public function getCardOwner(): ?string
    {
        return $this->cardOwner;
    }

    public function setCardOwner(string $cardOwner): self
    {
        $this->cardOwner = $cardOwner;

        return $this;
    }
}
