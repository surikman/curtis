<?php
namespace Curtis\AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Theme
 *
 * @package Curtis\AppBundle\Entity
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Theme
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true)
     */
    private $photo;

    /**
     * @var Tag[]|ArrayCollection
     * @ORM\ManyToMany(targetEntity="Curtis\AppBundle\Entity\Tag")
     */
    private $tags;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=false)
     */
    private $text;

    /**
     * @var Theme[]|ArrayCollection
     * @ORM\ManyToMany(targetEntity="Curtis\AppBundle\Entity\Theme")
     */
    private $relatedThemes;

    /**
     * @var LocalityPlace[]|ArrayCollection
     * @ORM\ManyToMany(targetEntity="Curtis\AppBundle\Entity\LocalityPlace", mappedBy="relatedThemes")
     */
    private $relatedLocalities;

    /**
     * @var ThemeCategory
     * @ORM\ManyToOne(targetEntity="Curtis\AppBundle\Entity\ThemeCategory", inversedBy="themes")
     */
    private $category;

    /**
     * @var boolean
     * @ORM\Column(type="boolean")
     */
    private $isLocked;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new ArrayCollection();
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
     * @return Theme
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Theme
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get text
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param string $text
     *
     * @return Theme
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Theme
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
     * @return Theme
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
     * Add tag
     *
     * @param Tag $tag
     *
     * @return Theme
     */
    public function addTag(Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param Tag $tag
     */
    public function removeTag(Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
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
     * @return Theme
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Add relatedTheme
     *
     * @param Theme $relatedTheme
     *
     * @return Theme
     */
    public function addRelatedTheme(Theme $relatedTheme)
    {
        $this->relatedThemes[] = $relatedTheme;

        return $this;
    }

    /**
     * Remove relatedTheme
     *
     * @param Theme $relatedTheme
     */
    public function removeRelatedTheme(Theme $relatedTheme)
    {
        $this->relatedThemes->removeElement($relatedTheme);
    }

    /**
     * Get relatedThemes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRelatedThemes()
    {
        return $this->relatedThemes;
    }

    /**
     * Get category
     *
     * @return ThemeCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set category
     *
     * @param ThemeCategory $category
     *
     * @return Theme
     */
    public function setCategory(ThemeCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Add relatedLocality
     *
     * @param \Curtis\AppBundle\Entity\LocalityPlace $relatedLocality
     *
     * @return Theme
     */
    public function addRelatedLocality(\Curtis\AppBundle\Entity\LocalityPlace $relatedLocality)
    {
        $this->relatedLocalities[] = $relatedLocality;

        return $this;
    }

    /**
     * Remove relatedLocality
     *
     * @param \Curtis\AppBundle\Entity\LocalityPlace $relatedLocality
     */
    public function removeRelatedLocality(\Curtis\AppBundle\Entity\LocalityPlace $relatedLocality)
    {
        $this->relatedLocalities->removeElement($relatedLocality);
    }

    /**
     * Get relatedLocalities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRelatedLocalities()
    {
        return $this->relatedLocalities;
    }

    /**
     * Set isLocked
     *
     * @param boolean $isLocked
     *
     * @return Theme
     */
    public function setIsLocked($isLocked)
    {
        $this->isLocked = $isLocked;

        return $this;
    }

    /**
     * Get isLocked
     *
     * @return boolean
     */
    public function getIsLocked()
    {
        return $this->isLocked;
    }
}
