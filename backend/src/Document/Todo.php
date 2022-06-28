<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/** @ODM\Document(repositoryClass="App\Repository\TodoRepository") */
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
     * @Assert\Choice({"Low", "Medium", "High"})
     */
    private $priority;

    public function __construct()
    {
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDone()
    {
        return $this->done;
    }

    public function getPriority()
    {
        return $this->priority;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setDone($done)
    {
        $this->done = $done;
    }

    public function setPriority($priority)
    {
        $this->priority = $priority;
    }
}
