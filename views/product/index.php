<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <div class="container-xl mt-5">
    <div class="table-responsive">
      <div class="table-wrapper">
        <div class="table-title">
          <div class="row">
            <div class="col-sm-8 mb-4">
              <a href="/test-intern-php" class="btn btn-primary">
                Products
              </a>
              <div class="btn btn-light">
                Categories
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <!-- Input search -->
              <div class="search-box">
                <form>
                  <input name="search" type="text" class="form-control text-center" placeholder="Search" value="<?= $search ?>">
                </form>
              </div>
            </div>
            <div class="col-sm-12 d-flex justify-content-between mt-4 mb-4">
              <!-- Result of entries or search -->
              <div class="hint-text">
                Showing <b><?= $productsOnPage ?></b> out of <b><?= $total ?></b> <?php if(isset($search) && $search !== "") echo 'search results'; else echo 'entries'; ?>
              </div>
              <!-- Button add -->
              <a href="#addProductModal" data-toggle="modal">
                <i class="fa fa-plus-circle" style="font-size: 30px"></i>
              </a>
            </div>
          </div>
        </div>
        <!-- Table product -->
        <table class="table table-striped table-hover table-bordered text-center">
          <thead>
            <tr>
              <th>#</th>
              <th>Product Name</th>
              <th>Category</th>
              <th>Image</th>
              <th>Operations</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $i = 1;
              foreach ($products as $product) :
            ?>
              <tr>
                <td><?= $i ?></td>
                <td><?= $product->getName() ?></td>
                <td><?= $product->getCategoryName() ?></td>
                <td><img width="50px" src="./assets/img/uploads/<?= $product->getImage() ?>" alt=""></td>
                <td>
                  <a href="#editProductModal" data-id="<?= $product->getId() ?>" data-toggle="modal" class="edit" title="Edit"><i class="fa fa-edit"></i></a>
                  <a href="#deleteProductModal" data-id="<?= $product->getId() ?>" data-toggle="modal" class="delete" title="Delete"><i class="fa fa-minus-circle"></i></a>
                  <a href="#copyProductModal" data-id="<?= $product->getId() ?>" data-toggle="modal" class="copy" title="Create from this product"><i class="fa fa-clipboard"></i></a>
                  <a href="#viewProductModal" data-id="<?= $product->getId() ?>" data-toggle="modal" class="view" title="View"><i class="fa fa-eye"></i></a>
                </td>
              </tr>
            <?php
              $i++;
              endforeach;
            ?>
          </tbody>
        </table>
        <!-- Pagination -->
        <div class="clearfix d-flex">
          <ul class="pagination mx-auto">
            <li class="page-item <?php if ($page == 1) echo 'disabled' ?>">
              <a 
                href="<?php 
                  if ($page == 1) 
                    echo '#';
                  else {
                    echo '?page=' . ($page - 1);
                    if (isset($search)) {
                      echo '&search=' . $search;
                    }
                  }
                  
                ?>" 
                class="page-link">
                Previous
              </a>
            </li>
            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
              <li class="page-item <?php if ($page == $i) echo 'active' ?>">
                <a 
                  href="?page=<?= $i ?> <?php if (isset($search)) echo '&search=' . $search; ?>" 
                  class="page-link"
                >
                  <?= $i ?>
                </a>
              </li>
            <?php endfor; ?>
            <li class="page-item <?php if ($page == $totalPages) echo 'disabled' ?>">
              <a 
                href="<?php 
                  if ($page == $totalPages) 
                    echo '#';
                  else {
                    echo '?page=' . ($page + 1);
                    if (isset($search)) {
                      echo '&search=' . $search;
                    }
                  }
                ?>" 
                class="page-link">
                Next
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- Add product modal -->
  <div id="addProductModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="?controller=product&action=store" enctype="multipart/form-data">
          <div class="modal-header">
            <h4 class="modal-title">Add new product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Product name</label>
              <input type="text" name="name" class="form-control" required>
              <span class="text-danger"><i>(Note: Product name is unique)</i></span>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select name="categoryId" id="" class="form-control">
                <?php foreach ($categories as $category) : ?>
                  <option value="<?= $category->getId() ?>"> <?= $category->getName() ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Product image</label>
              <input type="file" class="form-control" name="image" id="">
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-info" value="Create">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Edit product modal -->
  <div id="editProductModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="?controller=product&action=update">
          <input type="hidden" name="id" value="" class="id">
          <div class="modal-header">
            <h4 class="modal-title">Edit product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Product name</label>
              <input type="text" class="form-control name" name="name" required>
              <span class="text-danger"><i>(Note: Product name is unique)</i></span>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select name="categoryId" class="form-control categoryId" required>
                <?php foreach ($categories as $category) : ?>
                  <option value="<?= $category->getId() ?>"> <?= $category->getName() ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Product image</label>
              <img src="" alt="" width="100px" class="img">
              <input type="file" class="form-control" name="image">
              <input type="hidden" name="image" value="" class="image" />
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-info" value="Save">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Copy product modal -->
  <div id="copyProductModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="?controller=product&action=store">
          <div class="modal-header">
            <h4 class="modal-title">Create new product from exist product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Product name</label>
              <input type="text" class="form-control name" name="name" required>
              <span class="text-danger"><i>(Note: Product name is unique)</i></span>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select name="categoryId" class="form-control categoryId" required>
                <?php foreach ($categories as $category) : ?>
                  <option value="<?= $category->getId() ?>"> <?= $category->getName() ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Product image</label>
              <img src="" alt="" width="100px" class="img">
              <input type="file" class="form-control" name="image">
              <input type="hidden" name="image" value="" class="image" />
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-info" value="Create">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Delete product modal -->
  <div id="deleteProductModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form method="post" action="?controller=product&action=delete">
          <input type="hidden" name="id" value="" class="id">
          <div class="modal-header">
            <h4 class="modal-title">Delete Product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <p>Are you sure you want to delete this record?</p>
            <p class="text-warning"><small>This action cannot be undone.</small></p>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
            <input type="submit" class="btn btn-danger" value="Delete">
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- View product modal -->
  <div id="viewProductModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <form>
          <div class="modal-header">
            <h4 class="modal-title">View product</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Product name</label>
              <input type="text" class="form-control name" name="name" disabled>
            </div>
            <div class="form-group">
              <label>Category</label>
              <select name="categoryId" class="form-control categoryId" disabled>
                <?php foreach ($categories as $category) : ?>
                  <option value="<?= $category->getId() ?>"> <?= $category->getName() ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label>Product image</label>
              <img src="" alt="" width="100px" class="img">
            </div>
          </div>
          <div class="modal-footer">
            <input type="button" class="btn btn-primary" data-dismiss="modal" value="OK">
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      // Event edit
      let editBtns = $('.edit');
      $.each(editBtns, function() {
        $(this).click(function() {
          let id = $(this).data('id');

          $.ajax({
            url: '?controller=product&action=ajax',
            type: 'POST',
            data: {
              id,
              action: 'edit',
            },
            success: function(data) {
              let product = $.parseJSON(data);
              $("#editProductModal .id").val(product['id']);
              $("#editProductModal .name").val(product['name']);
              $("#editProductModal .categoryId").val(product['categoryId']);
              $("#editProductModal .img").attr("src", `./assets/img/uploads/${product['image']}`);
              $("#editProductModal .image").val(product['image']);
            }
          })
        })
      })

      // Event delete
      let deleteBtns = $('.delete');
      $.each(deleteBtns, function() {
        $(this).click(function() {
          let id = $(this).data('id');

          $("#deleteProductModal .id").val(id);
        })
      })

      // Event copy
      let copyBtns = $('.copy');
      $.each(copyBtns, function() {
        $(this).click(function() {
          let id = $(this).data('id');

          $.ajax({
            url: '?controller=product&action=ajax',
            type: 'POST',
            data: {
              id,
            },
            success: function(data) {
              let product = $.parseJSON(data);
              $("#copyProductModal .name").val(product['name']);
              $("#copyProductModal .categoryId").val(product['categoryId']);
              $("#copyProductModal .img").attr("src", `./assets/img/uploads/${product['image']}`);
              $("#copyProductModal .image").val(product['image']);
            }

          })
        })
      })

      // Event view
      let viewBtns = $('.view');
      $.each(viewBtns, function() {
        $(this).click(function() {
          let id = $(this).data('id');

          $.ajax({
            url: '?controller=product&action=ajax',
            type: 'POST',
            data: {
              id,
            },
            success: function(data) {
              let product = $.parseJSON(data);
              $("#viewProductModal .name").val(product['name']);
              $("#viewProductModal .categoryId").val(product['categoryId']);
              $("#viewProductModal .img").attr("src", `./assets/img/uploads/${product['image']}`);
            }

          })
        })
      })
    })
  </script>
</body>

</html>