<?php

namespace Jeka\CategoryBundle\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * @MongoDB\Document
 */
class Category{

    /**
     * @MongoDB\Id
     */
    private $id;

    /**
     * @MongoDB\String
     */
    private $name;

    /**
     * @MongoDB\String
     * @MongoDB\UniqueIndex
     */
    private $slug;

    /**
     * @MongoDB\String
     */
    private $type;

    /**
     * @MongoDB\ReferenceMany(targetDocument="Category")
     * @MongoDB\Index
     */
    private $ancestors =array();

    /**
     * @MongoDb\ReferenceOne(targetDocument="Category")
     * @MongoDb\Index
     */
    private $parent;

    /**
     * @MongoDb\Int
     */
    private $position;


    public function __construct()
    {
        $this->ancestors = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return id $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add ancestors
     *
     * @param Jeka\CategoryBundle\Document\Category $ancestors
     */
    public function addAncestors(\Jeka\CategoryBundle\Document\Category $ancestors)
    {
        $this->ancestors[] = $ancestors;
    }

    /**
     * Get ancestors
     *
     * @return Doctrine\Common\Collections\Collection $ancestors
     */
    public function getAncestors()
    {
        return $this->ancestors;
    }

    /**
     * Set parent
     *
     * @param Jeka\CategoryBundle\Document\Category $parent
     */
    public function setParent(\Jeka\CategoryBundle\Document\Category $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get parent
     *
     * @return Jeka\CategoryBundle\Document\Category $parent
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set position
     *
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * Get position
     *
     * @return int $position
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * Get slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    public function hasChildren()
    {

    }

    public function getChildren()
    {

    }

}
