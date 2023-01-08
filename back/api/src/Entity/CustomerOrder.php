<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\CustomerOrderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CustomerOrderRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['customer_order:read']],
    denormalizationContext: ['groups' => ['customer_order:create', 'customer_order:update']],
)]
#[GetCollection(
    security: 'is_granted("ROLE_ADMIN")',
    normalizationContext: ['groups' => ['customer_order:read', 'customer_order:cget']],
)]
#[Get(
    security: 'is_granted("ROLE_ADMIN") or object.getOwner() == user',
    normalizationContext: ['groups' => ['customer_order:read', 'customer_order:get']],
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


class CustomerOrder
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['customer_order:read'])]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'customerOrders')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['customer_order:get', 'customer_order:create', 'customer_order:update'])]
    private ?User $customer = null;

    #[ORM\Column(length: 255)]
    #[Groups(['customer_order:read', 'customer_order:create', 'customer_order:update'])]
    private ?string $status = null;

    #[ORM\Column]
    #[Groups(['customer_order:get', 'customer_order:create', 'customer_order:update'])]
    private ?float $totalPrice = null;

    #[ORM\OneToMany(mappedBy: 'customerOrder', targetEntity: ProductOrder::class, cascade: ["remove"])]
    #[Groups(['customer_order:get'])]
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

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTotalPrice(): ?float
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(float $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

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
            $productOrder->setCustomerOrder($this);
        }

        return $this;
    }

    public function removeProductOrder(ProductOrder $productOrder): self
    {
        if ($this->productOrders->removeElement($productOrder)) {
            // set the owning side to null (unless already changed)
            if ($productOrder->getCustomerOrder() === $this) {
                $productOrder->setCustomerOrder(null);
            }
        }

        return $this;
    }
}
