<?php
namespace App\DTO;

/**
 * Class CustomerDTO
 *
 * Data Transfer Object for Customer entity.
 *
 * @package App\DTO
 */
class CustomerDTO
{

    /**
     * @var string The customer's firstName.
     */
    private $firstName;

    /**
     * @var string The customer's lastName.
     */
    private $lastName;

    /**
     * @var string The customer's email.
     */
    private $email;

    /**
     * @var string The customer's country.
     */
    private $country;

    /**
     * @var string The customer's username.
     */
    private $username;

    /**
     * @var string The customer's gender.
     */
    private $gender;

    /**
     * @var string The customer's city.
     */
    private $city;

    /**
     * @var string The customer's phone.
     */
    private $phone;

    /**
     * @var string The customer's password.
     */
    private $password;


    /**
     * CustomerDTO constructor
     * 
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     * @param string $country
     * @param string $city
     * @param string $username
     * @param string $gender
     * @param string $phone
     */
    public function __construct(
        string $firstName = null,
        string $lastName = null,
        string $email = null,
        string $password = null,
        string $country = null,
        string $city = null,
        string $username = null,
        string $gender = null,
        string $phone = null
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->password = $password;
        $this->country = $country;
        $this->city = $city;
        $this->username = $username;
        $this->gender = $gender;
        $this->phone = $phone;
    }

    /**
     * Get the customer firstName.
     *
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * Get the customer lastName.
     *
     * @return string|null
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * Get the customer email.
     *
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Get the customer password.
     *
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Get the customer country.
     *
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * Get the customer username.
     *
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Get the customer gender.
     *
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * Get the customer city.
     *
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * Get the customer phone.
     *
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }
}