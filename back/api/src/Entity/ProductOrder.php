<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\ProductOrderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ProductOrderRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['product_order:read']],
    denormalizationContext: ['groups' => ['product_order:create', 'product_order:update']],
)]
#[GetCollection(
    security: 'is_granted("ROLE_ADMIN")',
    normalizationContext: ['groups' => ['product_order:read', 'product_order:cget']],
)]
#[Get(
    security: 'is_granted("ROLE_ADMIN") or object.getOwner() == user',
    normalizationContext: ['groups' => ['product_order:read', 'product_order:get']],
)]
#[Post(
    security: 'is_granted(["ROLE_ADMIN", "ROLE_CUSTOMER"])',
)]
#[Put(
    security: 'is_granted("ROLE_ADMIN") or object.getOwner() == user',
)]
#[Patch(
    security: 'is_granted("ROLE_ADMIN") or object.getOwner() == user',
)]
#[Delete(
    security: 'is_granted("ROLE_ADMIN")',
)]
class ProductOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['product_order:read','customer_order:get'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['product_order:read','customer_order:get'])]
    private ?int $productId = null;

    #[ORM\Column]
    #[Groups(['product_order:read','customer_order:get'])]
    private ?int $quantity = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['product_order:get'])]
    private ?int $discount = null;

    #[ORM\ManyToOne(inversedBy: 'productOrders')]
    private ?CustomerOrder $customerOrder = null;

    #[ORM\ManyToOne(inversedBy: 'productOrders')]
    private ?Cart $cart = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

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

    public function getDiscount(): ?int
    {
        return $this->discount;
    }

    public function setDiscount(int $discount): self
    {
        $this->discount = $discount;

        return $this;
    }

    public function getCustomerOrder(): ?CustomerOrder
    {
        return $this->customerOrder;
    }

    public function setCustomerOrder(?CustomerOrder $customerOrder): self
    {
        $this->customerOrder = $customerOrder;

        return $this;
    }

    public function getCart(): ?Cart
    {
        return $this->cart;
    }

    public function setCart(?Cart $cart): self
    {
        $this->cart = $cart;

        return $this;
    }
}
