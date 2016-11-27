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
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User")
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
     * Set foodItemId
     *
     * @param \AppBundle\Entity\FoodItem $foodItemId
     *
     * @return UserList
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
     * @return UserList
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
     * Set userId
     *
     * @param \AppBundle\Entity\User $userId
     *
     * @return UserList
     */
    public function setUserId(\AppBundle\Entity\User $userId = null)
    {
        $this->user_id = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return \AppBundle\Entity\User
     */
    public function getUserId()
    {
        return $this->user_id;
    }
}
