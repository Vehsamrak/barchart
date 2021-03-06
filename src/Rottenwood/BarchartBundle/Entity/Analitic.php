<?php

namespace Rottenwood\BarchartBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * Аналитики (юзеры)
 * @ORM\Table(name="analitics")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 */
class Analitic extends BaseUser {

    /**
     * @var integer
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="Strategy", mappedBy="author")
     **/
    protected $strategies;

    /**
     * @var \DateTime
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;

    /**
     * @ORM\PrePersist
     */
    public function prePersistCallback() {
        $this->setCreationDate(new \Datetime());
    }

    /**
     * Get id
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set email
     * @param string $email
     * @return Analitic
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set strategies
     * @param Strategy[] $strategies
     * @return Analitic
     */
    public function setStrategies($strategies) {
        $this->strategies = $strategies;

        return $this;
    }

    /**
     * Get strategies
     * @return Strategy[]
     */
    public function getStrategies() {
        return $this->strategies;
    }

    /**
     * @return \DateTime
     */
    public function getCreationDate() {
        return $this->creationDate;
    }

    /**
     * @param \DateTime $creationDate
     */
    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
    }
}
