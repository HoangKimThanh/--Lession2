<?php

class Category
{
    private int $id;
    private string $name;

    public function __construct(Array $row = [])
    {
        $this->id = $row['id'] ?? 0;
        $this->name = $row['name'] ?? '';
    }

    // Get id of category
    public function getId()
    {
        return $this->id;
    }

    // Set id of category
    public function setId($id)
    {
        $this->id = $id;
    }

    // Get name of category
    public function getName()
    {
        return $this->name;
    }

    // Set name of category
    public function setName($name)
    {
        $this->name = $name;
    }
}
