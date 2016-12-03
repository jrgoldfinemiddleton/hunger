<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserList
 *
 * @ORM\Table(name="user_list")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserListRepository")
 */
class UserList
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

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
     * UserList constructor.
     * @param $id
     * @param $user
     * @param $food_item
     * @param $unit
     * @param $quantity
     */
    public function __construct($id = null, $user =  null, $food_item = null, $unit = null, $quantity = null)
    {
        $this->id = $id;
        $this->user = $user;
        $this->food_item = $food_item;
        $this->unit = $unit;
        $this->quantity = $quantity;
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
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return UserList
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return UserList
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set foodItem
     *
     * @param \AppBundle\Entity\FoodItem $foodItem
     *
     * @return UserList
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
     * @return UserList
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
