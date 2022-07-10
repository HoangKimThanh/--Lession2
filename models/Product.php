<?php

class Product
{
  private int $id;
  private string $name;
  private string $categoryId;
  private string $categoryName;
  private string $image;

  public function __construct(array $row = [])
  {
    $this->id = $row['id'] ?? 0;
    $this->name = $row['name'];
    $this->categoryId = $row['categoryId'];
    $this->categoryName = $row['categoryName'] ?? '';
    $this->image = $row['image'];
  }

  // Get id of product
  public function getId()
  {
    return $this->id;
  }

  // Set id of product
  public function setId($id)
  {
    $this->id = $id;
  }

  // Get name of product
  public function getName()
  {
    return $this->name;
  }

  // Set name of product
  public function setName($name)
  {
    $this->name = $name;
  }

  // Get categoryId of product
  public function getCategoryId()
  {
    return $this->categoryId;
  }

  // Set categoryId of product
  public function setCategoryId($categoryId)
  {
    $this->categoryId = $categoryId;
  }

  // Get categoryName of product
  public function getCategoryName()
  {
    return $this->categoryName;
  }

  // Get image of product
  public function getImage()
  {
    return $this->image;
  }

  // Set image of product
  public function setImage($image)
  {
    return $this->image = $image;
  }
}
