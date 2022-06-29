<?php

namespace App\Dto;

class TodosId
{
    private array $ids = array();
    
    /**
     * Get the value of ids
     */
    public function getIds(): array
    {
        return $this->ids;
    }

    /**
     * Set the value of ids
     *
     * @return  self
     */
    public function setIds(array $ids)
    {
        $this->ids = $ids;

        return $this;
    }
}
