<?php
declare(strict_types=1);

namespace App\Document;

use DateTime;
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Symfony\Component\Validator\Constraints as Assert;

/** @ODM\Document(repositoryClass="App\Repository\TodoRepository")
 * @ODM\HasLifecycleCallbacks
 */
class Todo
{
    /** @ODM\Id */
    private string $id;

    /** @ODM\Field(type="string")
     * @Assert\NotBlank(message = "Name is required")
     */
    private string $name;

    /** @ODM\Field(type="string")
     * @Assert\NotBlank(message = "Description is required")
     */
    private string $description;

    /** @ODM\Field(type="string") 
     * @Assert\Choice({"todo", "in-progress", "done"}, message="Choose a valid status.")
    */
    private string $status = 'todo';

    /** @ODM\Field(type="string")
     * @Assert\NotBlank(message = "Priority is required")
     * @Assert\Choice({"low", "meduim", "high"}, message="Choose a valid status.")
     */
    private string $priority;

    /** @ODM\Field(type="string")
     * @Assert\NotBlank(message = "Description is required")
     */
    private string $color;

    /** @ODM\Field(type="date") */
    private DateTime $createdAt;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of description
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */
    public function setDescription(string $description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of status
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */
    public function setStatus(string $status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of priority
     */
    public function getPriority(): string
    {
        return $this->priority;
    }

    /**
     * Set the value of priority
     *
     * @return  self
     */
    public function setPriority(string $priority)
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * Get the value of color
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Set the value of color
     *
     * @return  self
     */
    public function setColor(string $color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get the value of createdAt
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set the value of createdAt
     *
     * @return  self
     */
    public function setCreatedAt(DateTime $createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /** @ODM\PrePersist */
    public function PrePersist(): void
    {
        $this->createdAt = new DateTime();
    }
}
