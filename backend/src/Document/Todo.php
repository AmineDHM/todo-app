<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/** @ODM\Document */
class Todo
{
    /** @ODM\Id */
    private $id;

    /** @ODM\Field(type="string")
     * @Assert\NotBlank(message = "Name is required")
     */
    private $name;

    /** @ODM\Field(type="string")
     * @Assert\NotBlank(message = "Description is required")
     */
    private $description;

    /** @ODM\Field(type="boolean") */
    private $done = false;

    /** @ODM\Field(type="string")
     * @Assert\NotBlank(message = "Priority is required")
     * @Assert\Choice({"low", "meduim", "high"})
     */
    private $priority;

    /** @ODM\Field(type="string")
     * @Assert\NotBlank(message = "Description is required")
     */
    private $color;

    public function __construct()
    {
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of done
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set the value of done
     *
     * @return  self
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get the value of priority
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set the value of priority
     *
     * @return  self
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get the value of color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }
}
