<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\CartRepository;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartRepository::class)]
#[ApiResource(
    // this means that the API will only return the cart if the user is logged in
    normalizationContext: ['groups' => ['cart:read']],
    denormalizationContext: ['groups' => ['cart:create', 'cart:update']],
)]
#[GetCollection(
    security: 'is_granted("ROLE_ADMIN")',
    normalizationContext: ['groups' => ['cart:read','cart:cget']],
)]
#[Get(
    security: 'is_granted("ROLE_ADMIN") or object.getOwner() == user',
    normalizationContext: ['groups' => ['cart:read','cart:get']],
)]
#[Post(
    security: 'is_granted("ROLE_ADMIN") or object.getOwner() == user',
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


class Cart
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['cart:read'])]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'cart', cascade: ['persist', 'remove'])]
    #[Groups(['cart:read', 'cart:create', 'cart:update'])]
    private ?User $customer = null;

    #[ORM\OneToMany(mappedBy: 'cart', targetEntity: ProductOrder::class)]
    #[Groups(['cart:read', 'cart:create', 'cart:update'])]
    private Collection $productOrders;

    public function __construct()
    {
        $this->productOrders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?User
    {
        return $this->customer;
    }

    public function setCustomer(?User $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    /**
     * @return Collection<int, ProductOrder>
     */
    public function getProductOrders(): Collection
    {
        return $this->productOrders;
    }

    public function addProductOrder(ProductOrder $productOrder): self
    {
        if (!$this->productOrders->contains($productOrder)) {
            $this->productOrders->add($productOrder);
            $productOrder->setCart($this);
        }

        return $this;
    }

    public function removeProductOrder(ProductOrder $productOrder): self
    {
        if ($this->productOrders->removeElement($productOrder)) {
            // set the owning side to null (unless already changed)
            if ($productOrder->getCart() === $this) {
                $productOrder->setCart(null);
            }
        }

        return $this;
    }
}
