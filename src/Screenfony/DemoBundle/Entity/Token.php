<?php

namespace Screenfony\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Token
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Token
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="apiKey", type="string", length=32)
     */
    private $apiKey;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_added", type="datetime")
     */
    private $dateAdded;


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
     * Set apiKey
     *
     * @param string $apiKey
     * @return Token
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get apiKey
     *
     * @return string 
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Set dateAdded
     *
     * @param \DateTime $dateAdded
     * @return Token
     */
    public function setDateAdded($dateAdded)
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * Get dateAdded
     *
     * @return \DateTime 
     */
    public function getDateAdded()
    {
        return $this->dateAdded;
    }
}
