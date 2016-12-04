<?php

// src/AppBundle/Entity/FoodBank.php
namespace AppBundle\Entity;

use AppBundle\Util\DataValidator;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="food_bank")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FoodBankRepository")
 */
class FoodBank
{


    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100, unique=TRUE)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $address1;

    /**
     * @ORM\Column(type="string", length=100, nullable=TRUE)
     */
    private $address2;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=5)
     */
    private $zip_code;

    /**
     * @ORM\Column(type="string", length=10)
     */
    private $phone_number;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    /**
     * FoodBank constructor.
     * @param $id
     * @param $name
     * @param $address1
     * @param $address2
     * @param $city
     * @param $state
     * @param $zip_code
     * @param $phone_number
     * @param $created_at
     * @param $updated_at
     */
    public function __construct($id = null, $name = null, $address1 = null, $address2 = null, $city = null, $state = null, $zip_code = null, $phone_number = null, $created_at = null, $updated_at = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address1 = $address1;
        $this->address2 = $address2;
        $this->city = $city;
        $this->state = $state;
        $this->zip_code = $zip_code;
        $this->phone_numner = $phone_number;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return FoodBank
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address1
     *
     * @param string $address1
     *
     * @return FoodBank
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     *
     * @return FoodBank
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return FoodBank
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return FoodBank
     */
    public function setState($state)
    {
        if (DataValidator::isValidStateAbbr($state)) {
            $this->state = $state;
        } else {
            throw new \InvalidArgumentException();
        }

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set zipCode
     *
     * @param integer $string
     *
     * @return FoodBank
     */
    public function setZipCode($zipCode)
    {
        $this->zip_code = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zip_code;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return FoodBank
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return FoodBank
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return FoodBank
     */
    public function setPhoneNumber($phoneNumber)
    {
        $phoneNumber = DataValidator::normalizePhone($phoneNumber);

        if (DataValidator::isValidPhoneNumber($phoneNumber)) {
            $this->phone_number = $phoneNumber;
        } else {
            throw new \InvalidArgumentException();
        }

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }
}
