<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use AppBundle\Entity\FoodBank as FoodBank;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * @ORM\Entity
 * @UniqueEntity(fields="email", message="This email address is already in use")
 */
class User implements UserInterface, AdvancedUserInterface, \Serializable
{
    /**
     * @ORM\Id;
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=40)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $role;

    /**
     * @Assert\Length(max=4096)
     */
    protected $plainPassword;

    /**
     * @ORM\Column(type="string", length=64)
     */
    protected $password;

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\FoodBank")
     * @ORM\JoinColumn(name="food_bank_id", referencedColumnName="id")
     */
    private $food_bank;  // for food bank reps, otherwise null


    public function eraseCredentials()
    {
        return null;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role = null)
    {
        $this->role = $role;
    }

    public function getRoles()
    {
        return [$this->getRole()];
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
    }

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;

    public function __construct()
    {
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
    }

    public function getSalt()
    {
        return null;
    }

    /**
     * Set foodBank
     *
     * @param \AppBundle\Entity\FoodBank $foodBank
     *
     * @return User
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


    // Implement AdvancedUserInterface, \Serializable

    public function isAccountNonExpired()
       {
           return true;
       }

       public function isAccountNonLocked()
       {
           return true;
       }

       public function isCredentialsNonExpired()
       {
           return true;
       }

       public function isEnabled()
       {
           return $this->isActive;
       }

       /** @see \Serializable::serialize() */
       public function serialize()
       {
           return serialize(array(
               $this->id,
               $this->email,
               $this->password,
               // see section on salt below
               // $this->salt,
           ));
       }

       /** @see \Serializable::unserialize() */
       public function unserialize($serialized)
       {
           list (
               $this->id,
               $this->email,
               $this->password,
               // see section on salt below
               // $this->salt
           ) = unserialize($serialized);
       }

}
