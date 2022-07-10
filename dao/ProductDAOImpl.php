<?php

require_once 'database/database.php';

class ProductDAOImpl implements ProductDAO
{
    private string $table = 'product';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // function get all products or search results
    public function getAll($limit = 0, $offset = 0, $search = ""): array
    {
        if ($limit == 0) {
            $query = "SELECT 
            product.*, 
            category.name AS categoryName 
            FROM $this->table, category
            WHERE product.categoryId = category.id
            AND (product.name LIKE '%$search%'
            OR category.name LIKE '%$search%')
            ";
        } else {
            $query = "SELECT 
            product.*, 
            category.name AS categoryName 
            FROM $this->table, category
            WHERE product.categoryId = category.id
            AND (product.name LIKE '%$search%'
            OR category.name LIKE '%$search%')
            LIMIT $limit
            OFFSET $offset
            ";
        }

        $result = $this->db->select($query);

        $arrProducts = [];
        foreach ($result as $row) {
            $product = new Product($row);
            $arrProducts[] = $product;
        }

        return $arrProducts;
    }

    // function store product
    public function store(Product $product): void
    {
        $query = "INSERT INTO $this->table (name, categoryId, image) 
        VALUES ('{$product->getName()}', '{$product->getCategoryId()}', '{$product->getImage()}')";
        
        $this->db->execute($query);
    }

    // function find product
    public function find(int $id)
    {
        $query = "SELECT * FROM $this->table WHERE id = '$id'";
        $result = $this->db->select($query);

        $product = $result->fetch_assoc();

        return $product;
    }

    // function update product
    public function update(Product $product): void
    {
        $query = "UPDATE $this->table 
        SET name = '{$product->getName()}',
        categoryId = '{$product->getCategoryId()}',
        image = '{$product->getImage()}' 
        WHERE id = '{$product->getId()}'";

        $this->db->execute($query);
    }

    // function delete product
    public function delete(int $id): void
    {
        $query = "DELETE FROM $this->table WHERE id = '$id'";
        $this->db->execute($query);
    }
}
