<?php

require_once 'database/database.php';

class CategoryDAOImpl implements CategoryDAO
{
    private string $table = 'category';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // function get all categories
    public function getAll(): array
    {
        $query = "SELECT * FROM $this->table";
        $result = $this->db->select($query);

        $arrCategories = [];

        foreach ($result as $row) {
            $category = new Category($row);

            $arrCategories[] = $category;
        }

        return $arrCategories;
    }
}
