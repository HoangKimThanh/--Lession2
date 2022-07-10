<?php

require 'models/Product.php';
require 'dao/ProductDAO.php';
require 'dao/ProductDAOImpl.php';

class ProductController
{
  private ProductDAOImpl $productDAO;

  public function __construct()
  {
    $this->productDAO = new ProductDAOImpl();
  }

  // Display listing of all products or search results
  public function index(): void
  {
    $page = 1;
    if (isset($_GET['page'])) {
      $page = $_GET["page"];
    }

    $search = "";
    if (isset($_GET['search'])) {
      $search = $_GET['search'];
    }

    $limit = 10;
    $offset = ($page - 1) * $limit;
    $categories = (new CategoryDAOImpl())->getAll();
    $products = $this->productDAO->getAll($limit, $offset, $search);

    $total = ($search == "") ? count($this->productDAO->getAll()) : count($this->productDAO->getAll(0, 0, $search));
    $productsOnPage = count($products);
    $totalPages = ceil($total/$limit);
    require 'views/product/index.php';
  }

  // Store a new product
  public function store(): void
  {
    if ($_FILES != []) {
      $image = $_FILES['image'];
      $folder = './assets/img/uploads/';
      $imageName = explode('.', $image['name'])[0] . '-' . time();
      $imagePath = $folder .  $imageName;
      move_uploaded_file($image['tmp_name'], $imagePath);
  
      $_POST['image'] = $imageName;
    }

    $product = new Product($_POST);
    $this->productDAO->store($product);
    header('Location: ?controller=product');
  }

  // Ajax
  public function ajax()
  {
    $id = $_POST['id'];
    $product = $this->productDAO->find($id);

    echo json_encode($product);
  }

  // Update product
  public function update(): void
  {
    if ($_FILES != []) {
      $image = $_FILES['image'];
      $folder = './assets/img/uploads/';
      $imageName = explode('.', $image['name'])[0] . '-' . time();
      $imagePath = $folder .  $imageName;
      move_uploaded_file($image['tmp_name'], $imagePath);
      $_POST['image'] = $imageName;
    }

    $product = new Product($_POST);
    $this->productDAO->update($product);
    header('Location: ?controller=product');
  }

  // Delete product
  public function delete(): void
  {
    $id = $_POST['id'];
    $this->productDAO->delete($id);
    header('Location: ?controller=product');
  }
}
