<?php

namespace Forex\Bundle\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="accounts")
 */
class Account
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $accountNumber;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="accounts")
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="Broker", inversedBy="accounts")
     */
    protected $broker;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAccountNumber($accountNumber)
    {
        $this->accountNumber = $accountNumber;
    }

    public function getAccountNumber()
    {
        return $this->accountNumber;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setBroker(Broker $broker)
    {
        $this->broker = $broker;
    }

    public function getBroker()
    {
        return $this->broker;
    }
}
