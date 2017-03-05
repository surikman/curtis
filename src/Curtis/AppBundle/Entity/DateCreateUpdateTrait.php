<?php
namespace Curtis\AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


trait DateCreateUpdateTrait
{

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $updatedAt;


    /**
     * @ORM\PrePersist()
     */
    public function updateCreatedAt()
    {
        if (empty($this->createdAt)) {
            $this->createdAt = new \DateTime('now');
            $this->updateUpdatedAt();
        }


    }

    /**
     * @ORM\PreUpdate()
     */
    public function updateUpdatedAt()
    {
        $this->updatedAt = new \DateTime('now');
    }
}
