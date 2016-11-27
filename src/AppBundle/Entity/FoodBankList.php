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
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Unit")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $unit_id;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\FoodBank")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    private $food_bank_id;

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
     * @param integer $quantity
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
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
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

    /**
     * Set unitId
     *
     * @param \AppBundle\Entity\Unit $unitId
     *
     * @return FoodBankList
     */
    public function setUnitId(\AppBundle\Entity\Unit $unitId = null)
    {
        $this->unit_id = $unitId;

        return $this;
    }

    /**
     * Get unitId
     *
     * @return \AppBundle\Entity\Unit
     */
    public function getUnitId()
    {
        return $this->unit_id;
    }

    /**
     * Set foodBankId
     *
     * @param \AppBundle\Entity\FoodBank $foodBankId
     *
     * @return FoodBankList
     */
    public function setFoodBankId(\AppBundle\Entity\FoodBank $foodBankId = null)
    {
        $this->food_bank_id = $foodBankId;

        return $this;
    }

    /**
     * Get foodBankId
     *
     * @return \AppBundle\Entity\FoodBank
     */
    public function getFoodBankId()
    {
        return $this->food_bank_id;
    }
}
