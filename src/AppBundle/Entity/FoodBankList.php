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
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\FoodBank")
     * @ORM\JoinColumn(name="food_bank_id", referencedColumnName="id")
     */
    private $food_bank;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\FoodItem")
     * @ORM\JoinColumn(name="food_item_id", referencedColumnName="id")
     */
    private $food_item;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Unit")
     * @ORM\JoinColumn(name="unit_id", referencedColumnName="id")
     */
    private $unit;

    /**
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;


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
     * Set foodBank
     *
     * @param \AppBundle\Entity\FoodBank $foodBank
     *
     * @return FoodBankList
     */
    public function setFoodBank(\AppBundle\Entity\FoodBank $foodBank = null)
    {
        $this->food_bank = $foodBank;

        return $this;
    }

    /**
     * Get foodBank
     *
     * @return \AppBundle\Entity\FoodBank
     */
    public function getFoodBank()
    {
        return $this->food_bank;
    }

    /**
     * Set foodItem
     *
     * @param \AppBundle\Entity\FoodItem $foodItem
     *
     * @return FoodBankList
     */
    public function setFoodItem(\AppBundle\Entity\FoodItem $foodItem = null)
    {
        $this->food_item = $foodItem;

        return $this;
    }

    /**
     * Get foodItem
     *
     * @return \AppBundle\Entity\FoodItem
     */
    public function getFoodItem()
    {
        return $this->food_item;
    }

    /**
     * Set unit
     *
     * @param \AppBundle\Entity\Unit $unit
     *
     * @return FoodBankList
     */
    public function setUnit(\AppBundle\Entity\Unit $unit = null)
    {
        $this->unit = $unit;

        return $this;
    }

    /**
     * Get unit
     *
     * @return \AppBundle\Entity\Unit
     */
    public function getUnit()
    {
        return $this->unit;
    }
}
