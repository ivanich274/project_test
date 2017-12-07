<?php
/**
 * Created by PhpStorm.
 * User: Лисица
 * Date: 07.12.2017
 * Time: 8:55
 */

namespace BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Class Product
 * @package BlogBundle\Entity
 * @ORM\Table(name="products")
 * @ORM\Entity
 */
class Product
{

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\Column(type="string")
     */
    protected $title;


    /**
     * @ORM\ManyToOne(targetEntity="BlogBundle\Entity\Category", inversedBy="products")
     * @ORM\JoinColumn(nullable=true)
     */
    public $category;


    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(Category $category)
    {
        $this->category = $category;
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
     * Set title
     *
     * @param string $title
     *
     * @return Product
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }
}
