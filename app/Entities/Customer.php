<?php

namespace App\Entities;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="customers")
 */
class Customer {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $firstName;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $lastName;
    
    /**
     * @ORM\Column(type="string", length=255, unique=true, nullable=true)
     */
    private $email;
    
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $password;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $country;
    
    /**
     * @ORM\Column(type="string", length=50, unique=true, nullable=true)
     */
    private $username;
    
    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $gender;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $city;
    
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $phone;

    
    /**
     * Get the customer's ID.
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Set the ID of the customer.
     *
     * @param string $id The id of the customer.
     * @return void
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * Get the customer's firstName.
     *
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Set the firstName of the customer.
     *
     * @param string $firstName The firstName of the customer.
     * @return void
     */
    public function setFirstName(?string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * Get the customer's lastName.
     *
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Set the lastName of the customer.
     *
     * @param string $lastName The lastName of the customer.
     * @return void
     */
    public function setLastName(?string $lastName): void
    {
        $this->lastName = $lastName;
    }

    /**
     * Get the customer's fullName.
     *
     * @return string|null
     */
    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }

    /**
     * Get the customer's email.
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Set the email of the customer.
     *
     * @param string $email The email of the customer.
     * @return void
     */
    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    /**
     * Set the password of the customer.
     *
     * @param string $password The password of the customer.
     * @return void
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * Get the customer's country.
     *
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * Set the country of the customer.
     *
     * @param string $country The country of the customer.
     * @return void
     */
    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    /**
     * Get the customer's username.
     *
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Set the username of the customer.
     *
     * @param string $username The username of the customer.
     * @return void
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * Get the customer's gender.
     *
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * Set the gender of the customer.
     *
     * @param string $gender The gender of the customer.
     * @return void
     */
    public function setGender(?string $gender): void
    {
        $this->gender = $gender;
    }

    /**
     * Get the customer's city.
     *
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Set the city of the customer.
     *
     * @param string $city The city of the customer.
     * @return void
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * Get the phone's city.
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

     /**
     * Set the phone of the customer.
     *
     * @param string $phone The phone of the customer.
     * @return void
     */
    public function setPhone(?string $phone): void
    {
        $this->phone = $phone;
    }
}