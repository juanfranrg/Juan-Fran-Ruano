<?php

namespace App\Entity;

use App\Repository\OrdersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrdersRepository::class)]
class Orders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 150, nullable: true)]
    private $reference;

    #[ORM\Column(type: 'decimal', precision: 20, scale: 6)]
    private $total_paid;

    #[ORM\Column(type: 'datetime')]
    private $date_add;

    #[ORM\ManyToOne(targetEntity: Customer::class)]
    private $id_customer;

    #[ORM\ManyToOne(targetEntity: Address::class)]
    private $id_address;

    #[ORM\ManyToOne(targetEntity: OrderStateLang::class, inversedBy: 'orders')]
    private $current_state;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(?string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getTotalPaid(): ?string
    {
        return $this->total_paid;
    }

    public function setTotalPaid(string $total_paid): self
    {
        $this->total_paid = $total_paid;

        return $this;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->date_add;
    }

    public function setDateAdd(\DateTimeInterface $date_add): self
    {
        $this->date_add = $date_add;

        return $this;
    }

    public function getIdCustomer(): ?Customer
    {
        return $this->id_customer;
    }

    public function setIdCustomer(?Customer $id_customer): self
    {
        $this->id_customer = $id_customer;

        return $this;
    }

    public function getIdAddress(): ?Address
    {
        return $this->id_address;
    }

    public function setIdAddress(?Address $id_address): self
    {
        $this->id_address = $id_address;

        return $this;
    }

    public function getCurrentState(): ?OrderStateLang
    {
        return $this->current_state;
    }

    public function setCurrentState(?OrderStateLang $current_state): self
    {
        $this->current_state = $current_state;

        return $this;
    }
    public function __toString()
    {
        
        return $this->reference;
        //return $variable;
    }

 
}
