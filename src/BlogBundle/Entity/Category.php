<?php
/**
 * Created by PhpStorm.
 * User: Лисица
 * Date: 07.12.2017
 * Time: 8:45
 */

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Category
 * @package BlogBundle\Entity
 * @ORM\Table(name="category")
 * @ORM\Entity
 */
class Category
{

    /**
     * @ORM\OneToMany(targetEntity="BlogBundle\Entity\Product", mappedBy="category")
     */
    private $blog;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    public function __construct()
    {
        $this->blog = new ArrayCollection();
    }

    /**
     * @return Collection|Product[]
     */
    public function getBlog()
    {
        return $this->blog;
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
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Для вывода на форме.
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
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
     * Add blog
     *
     * @param \BlogBundle\Entity\Product $blog
     *
     * @return Category
     */
    public function addBlog(\BlogBundle\Entity\Product $blog)
    {
        $this->blog[] = $blog;

        return $this;
    }

    /**
     * Remove blog
     *
     * @param \BlogBundle\Entity\Product $blog
     */
    public function removeBlog(\BlogBundle\Entity\Product $blog)
    {
        $this->blog->removeElement($blog);
    }
}
