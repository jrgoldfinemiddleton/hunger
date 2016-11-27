<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FoodBankList
 *
 * @ORM\Table(name="food_bank_list")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FoodBankListRepository")
 */
class FoodBankList
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\FoodItem")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $food_item_id;

    /**
     * @ORM\Column(name="quantity", type="float")
     */
    private $quantity;

    /**
     * @ORM\Column(name="unit", type="string", length=50)
     */
    private $unit;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\FoodBank")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $user_id;

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
     * Set quantity
     *
     * @param float $quantity
     *
     * @return FoodBankList
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set unit
     *
     * @param string $unit
     *
     * @return FoodBankList
     */
    public function setUnit($unit)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * Set userId
     *
     * @param \AppBundle\Entity\FoodBank $userId
     *
     * @return FoodBankList
     */
    public function setUserId(\AppBundle\Entity\FoodBank $userId = null)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \AppBundle\Entity\FoodBank
     */
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     * Set foodItemId
     *
     * @param \AppBundle\Entity\FoodItem $foodItemId
     *
     * @return FoodBankList
     */
    public function setFoodItemId(\AppBundle\Entity\FoodItem $foodItemId = null)
    {
        $this->food_item_id = $foodItemId;

        return $this;
    }

    /**
     * Get foodItemId
     *
     * @return \AppBundle\Entity\FoodItem
     */
    public function getFoodItemId()
    {
        return $this->food_item_id;
    }
}
