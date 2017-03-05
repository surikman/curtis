<?php
namespace Curtis\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Locality
 *
 * @package Curtis\AppBundle\Entity
 * @ORM\Entity(repositoryClass="LocalityStateAreaRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class LocalityStateArea
{
    use DateCreateUpdateTrait;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=80, nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $photo;

    /**
     * @var string
     * @ORM\Column(type="string", length=80, nullable=false)
     */
    private $urlKey;

    /**
     * @var LocalityRegion[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="Curtis\AppBundle\Entity\LocalityRegion", mappedBy="stateArea")
     */
    private $regions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->regions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return LocalityStateArea
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
     * Set photo
     *
     * @param string $photo
     *
     * @return LocalityStateArea
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set urlKey
     *
     * @param string $urlKey
     *
     * @return LocalityStateArea
     */
    public function setUrlKey($urlKey)
    {
        $this->urlKey = $urlKey;

        return $this;
    }

    /**
     * Get urlKey
     *
     * @return string
     */
    public function getUrlKey()
    {
        return $this->urlKey;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return LocalityStateArea
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return LocalityStateArea
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Add region
     *
     * @param \Curtis\AppBundle\Entity\LocalityRegion $region
     *
     * @return LocalityStateArea
     */
    public function addRegion(\Curtis\AppBundle\Entity\LocalityRegion $region)
    {
        $this->regions[] = $region;

        return $this;
    }

    /**
     * Remove region
     *
     * @param \Curtis\AppBundle\Entity\LocalityRegion $region
     */
    public function removeRegion(\Curtis\AppBundle\Entity\LocalityRegion $region)
    {
        $this->regions->removeElement($region);
    }

    /**
     * Get regions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRegions()
    {
        return $this->regions;
    }
}
