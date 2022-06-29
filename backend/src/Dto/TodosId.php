<?php

namespace App\Dto;

class TodosId
{
    private $ids = array();
    
    /**
     * Get the value of ids
     */
    public function getIds()
    {
        return $this->ids;
    }

    /**
     * Set the value of ids
     *
     * @return  self
     */
    public function setIds($ids)
    {
        $this->ids = $ids;

        return $this;
    }
}
