<?php

require 'models/Category.php';
require 'dao/CategoryDAO.php';
require 'dao/CategoryDAOImpl.php';

class CategoryController
{
    private Category $category;
    private CategoryDAOImpl $categoryDAO;

    public function __construct()
    {
        $this->category = new Category([]);
        $this->categoryDAO = new CategoryDAOImpl();
    }
}
