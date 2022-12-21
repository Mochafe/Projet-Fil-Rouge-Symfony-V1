<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiFilter;
use App\Repository\ProductRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read:product']],
    paginationItemsPerPage: 30
)]
#[ApiFilter(RangeFilter::class, properties: ["price"])]
#[ApiFilter(SearchFilter::class, properties: ["category" => "exact", "name" => "partial", "reference" => "exact"])]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["read:product"])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(["read:product"])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(["read:product"])]
    private ?string $description = null;

    #[ORM\Column(type: Types::GUID)]
    #[Groups(["read:product"])]
    private ?string $reference = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    #[Groups(["read:product"])]
    private ?string $price = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    #[Groups(["read:product"])]
    private ?string $discount = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 4, scale: 2, nullable: true)]
    #[Groups(["read:product"])]
    private ?string $discountRate = null;

    #[ORM\Column]
    #[Groups(["read:product"])]
    private ?int $quantity = null;

    #[ORM\ManyToOne(inversedBy: 'products')]
    #[Groups(["read:product"])]
    private ?Category $category = null;

    #[ORM\Column(nullable: true)]
    #[Groups(["read:product"])]
    private array $content = [];

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: Image::class, cascade:["persist", "remove"], orphanRemoval: true)]
    #[Groups(["read:product"])]
    private Collection $images;

    #[Groups(["read:product"])]
    #[ORM\OneToMany(mappedBy: 'product', targetEntity: CartDetail::class)]
    private Collection $cartDetails;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: OrderDetail::class)]
    #[Groups(["read:product"])]
    private Collection $orderDetails;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->cartDetails = new ArrayCollection();
        $this->orderDetails = new ArrayCollection();
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

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }


    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDiscount(): ?string
    {
        return $this->discount;
    }

    public function setDiscount(?string $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getDiscountRate(): ?string
    {
        return $this->discountRate;
    }

    public function setDiscountRate(?string $discountRate): self
    {
        $this->discountRate = $discountRate;

        return $this;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getContent(): array
    {
        return $this->content;
    }

    public function setContent(?array $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images->add($image);
            $image->setProduct($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->removeElement($image)) {
            // set the owning side to null (unless already changed)
            if ($image->getProduct() === $this) {
                $image->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CartDetail>
     */
    public function getCartDetails(): Collection
    {
        return $this->cartDetails;
    }

    public function addCartDetail(CartDetail $cartDetail): self
    {
        if (!$this->cartDetails->contains($cartDetail)) {
            $this->cartDetails->add($cartDetail);
            $cartDetail->setProduct($this);
        }

        return $this;
    }

    public function removeCartDetail(CartDetail $cartDetail): self
    {
        if ($this->cartDetails->removeElement($cartDetail)) {
            // set the owning side to null (unless already changed)
            if ($cartDetail->getProduct() === $this) {
                $cartDetail->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, OrderDetail>
     */
    public function getOrderDetails(): Collection
    {
        return $this->orderDetails;
    }

    public function addOrderDetail(OrderDetail $orderDetail): self
    {
        if (!$this->orderDetails->contains($orderDetail)) {
            $this->orderDetails->add($orderDetail);
            $orderDetail->setProduct($this);
        }

        return $this;
    }

    public function removeOrderDetail(OrderDetail $orderDetail): self
    {
        if ($this->orderDetails->removeElement($orderDetail)) {
            // set the owning side to null (unless already changed)
            if ($orderDetail->getProduct() === $this) {
                $orderDetail->setProduct(null);
            }
        }

        return $this;
    }

}
