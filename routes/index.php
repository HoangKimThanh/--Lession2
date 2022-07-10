<?php

require 'controllers/CategoryController.php';
require 'controllers/ProductController.php';

$controller = $_GET['controller'] ?? 'product';

// Select action in controller
switch ($controller) {
    case 'product':
        $productController = new ProductController();
        $action = $_GET['action'] ?? 'index';
        switch ($action) {
            case 'index':
            case 'ajax':
            case 'store':
            case 'update':
            case 'delete':
                $productController->$action();
                break;
            default:
                echo 'Invalid query';
        }
}
