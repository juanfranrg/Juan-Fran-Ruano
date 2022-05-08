<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $firstname;

    #[ORM\Column(type: 'string', length: 255)]
    private $lastname;

    #[ORM\Column(type: 'string', length: 128)]
    private $address1;

    #[ORM\Column(type: 'string', length: 128)]
    private $address2;

    #[ORM\Column(type: 'string', length: 64)]
    private $city;

    #[ORM\OneToOne(targetEntity: Customer::class, cascade: ['persist', 'remove'])]
    private $id_customer;

    #[ORM\OneToOne(targetEntity: CountryLang::class, cascade: ['persist', 'remove'])]
    private $id_country;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getAddress1(): ?string
    {
        return $this->address1;
    }

    public function setAddress1(string $address1): self
    {
        $this->address1 = $address1;

        return $this;
    }

    public function getAddress2(): ?string
    {
        return $this->address2;
    }

    public function setAddress2(string $address2): self
    {
        $this->address2 = $address2;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

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

    public function getIdCountry(): ?CountryLang
    {
        return $this->id_country;
    }

    public function setIdCountry(?CountryLang $id_country): self
    {
        $this->id_country = $id_country;

        return $this;
    }
    public function __toString()
    {
        $info= $this->address1." - ". $this->id_country;
        return $info;
    }




}
