<?php

interface ProductDAO
{
    // function get all products or search results
    public function getAll($limit = 0, $offset = 0, $search = ""): array;

    // function store product
    public function store(Product $product): void;

    // function find product
    public function find(int $id);

    // function update product
    public function update(Product $product): void;

    // function delete product
    public function delete(int $id): void;
}
