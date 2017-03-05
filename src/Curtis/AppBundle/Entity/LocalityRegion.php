<?php
namespace Curtis\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Locality
 *
 * @package Curtis\AppBundle\Entity
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class LocalityRegion
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
     * @var LocalityStateArea
     * @ORM\ManyToOne(targetEntity="Curtis\AppBundle\Entity\LocalityStateArea", inversedBy="regions")
     */
    private $stateArea;

    /**
     * @var LocalityPlace
     * @ORM\OneToMany(targetEntity="Curtis\AppBundle\Entity\LocalityPlace", mappedBy="region")
     */
    private $places;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->places = new ArrayCollection();
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUnlockedPlaces()
    {
        $criteria = Criteria::create();
        $criteria->andWhere(Criteria::expr()->eq('isLocked', false));
        return $this->places->matching($criteria);
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
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return LocalityRegion
     */
    public function setName($name)
    {
        $this->name = $name;

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
     * Set photo
     *
     * @param string $photo
     *
     * @return LocalityRegion
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return LocalityRegion
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
     * @return LocalityRegion
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
     * Get stateArea
     *
     * @return LocalityStateArea
     */
    public function getStateArea()
    {
        return $this->stateArea;
    }

    /**
     * Set stateArea
     *
     * @param LocalityStateArea $stateArea
     *
     * @return LocalityRegion
     */
    public function setStateArea(LocalityStateArea $stateArea = null)
    {
        $this->stateArea = $stateArea;

        return $this;
    }

    /**
     * Add place
     *
     * @param LocalityPlace $place
     *
     * @return LocalityRegion
     */
    public function addPlace(LocalityPlace $place)
    {
        $this->places[] = $place;

        return $this;
    }

    /**
     * Remove place
     *
     * @param LocalityPlace $place
     */
    public function removePlace(LocalityPlace $place)
    {
        $this->places->removeElement($place);
    }

    /**
     * Get places
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlaces()
    {
        return $this->places;
    }
}
