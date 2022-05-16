<?php
  require_once("../database/dbContext.php");
  require_once("../database/utility.php");

  

  if(!empty($_POST)) {
    $name = getPost('product_name');
    $brand = getPost('product_brand');
    $category = getPost('product_category');
    $desc = getPost('product_desc');
    $price = getPost('product_price');
    $oldPrice = getPost('product_oldPrice');
    $resolution = getPost('product_resolution');
    $image = getPost('product_image');
    $discount = getPost('product_discount');
    $status = getPost('product_status');
    $storage = getPost('product_storage');
    $Camera = getPost('product_ocamera');
    $Chip = getPost('product_chip');
    $Battery = getPost('product_battery');

    $add = "insert into products(title, brand_id, category_id, description, price, old_price, resolution)";
  }

  //get number of products
  $countSQL = "SELECT COUNT(*) FROM products";
  $countResult = executeResult($countSQL, true);

  //get product list
  $select = "SELECT products.*, brands.name AS brand_name, categories.name AS cate_name FROM products, brands, categories WHERE products.cate_id = categories.id AND products.brand_id = brands.id;";
  $productList = executeResult($select);
  
  //get brand list
  $select = "SELECT * FROM brands";
  $brandList = executeResult($select);

  //get categories list
  $select = "SELECT * FROM categories";
  $cateList = executeResult($select);
?>
<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
    <div class="row">

        <?php include "./templates/sidebar.php"; ?>

        <div class="row">
            <div class="col-10">
                <h2>Product List (<?=$countResult['COUNT(*)']?>)</h2>
            </div>
            <div class="col-2">
                <a href="#" data-toggle="modal" data-target="#add_product_modal" class="btn btn-primary btn-sm">Add
                    Product</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Brand</th>

                    </tr>
                </thead>
                <tbody id="product_list">
                    <?php
                      $index = 0;
                      foreach($productList as $item) {
                        echo '<tr>
                                <td>'. ++$index .'</td>
                                <td>'. $item['title'] .'</td>
                                <td><img style="width: 100px" src="'. $item['image'] .'"></td>
                                <td>'. $item['price'] .'</td>
                                <td>'. $item['cate_name'] .'</td>
                                <td>'. $item['brand_name'] .'</td>
                                <td><a style="cursor: pointer" class="btn btn-sm btn-warning"><ion-icon name="brush-outline"></ion-icon></a><a style="cursor: pointer" class="mx-2 btn btn-sm text-light btn-danger"><ion-icon name="trash-outline"></ion-icon></a></td>
                              </tr>';
                      }
                    ?>
                </tbody>
            </table>
        </div>
        </main>
    </div>
</div>



<!-- Add Product Modal start -->
<div class="modal fade" id="add_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" id="add-product-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="product_name" class="form-control"
                                    placeholder="Enter Product Name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Brand Name</label>
                                <select class="form-control brand_list" name="brand_id">
                                    <option value="">Select Brand</option>
                                    <?php
                                      foreach($brandList as $item) {
                                        echo '<option value="'. $item['id'] .'">'. $item['name'] .'</option>';
                                      }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <select class="form-control category_list" name="category_id">
                                    <option value="">Select Category</option>
                                    <?php
                                      foreach($cateList as $item) {
                                        echo '<option value="'. $item['id'] .'">'. $item['name'] .'</option>';
                                      }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea class="form-control" name="product_desc"
                                    placeholder="Enter product desc"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Price</label>
                                <input min="1" type="number" name="product_price" class="form-control"
                                    placeholder="Enter Product Price">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Oldprice</label>
                                <input type="number" name="product_oldPrice" class="form-control"
                                    placeholder="Enter Product OldPrice">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Resolution</label>
                                <input type="text" name="product_resolution" class="form-control"
                                    placeholder="Enter Product Resolution">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Image</label>
                                <input type="text" name="product_image" class="form-control"
                                    placeholder="Enter Product Image URL">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product discount</label>
                                <input type="number" name="product_discount" class="form-control"
                                    placeholder="Enter Product discount">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product status</label>
                                <input type="text" name="product_status" class="form-control"
                                    placeholder="Enter Product status">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product storage</label>
                                <input type="text" name="product_Storage" class="form-control"
                                    placeholder="Enter Product Storage">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product camera</label>
                                <input type="number" name="product_Camera" class="form-control"
                                    placeholder="Enter Product Camera">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product chip</label>
                                <input type="text" name="product_chip" class="form-control"
                                    placeholder="Enter Product Chip">
                            </div>
                        </div>-->
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Battery</label>
                                <input type="text" name="product_Battery" class="form-control"
                                    placeholder="Enter Product Image URL">
                            </div>
                            <input type="hidden" name="add_product" value="1">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary add-product">Add Product</button>
                            </div>
                        </div>

                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Product Modal end -->

<!-- Edit Product Modal start -->
<div class="modal fade" id="edit_product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-product-form" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" name="e_product_name" class="form-control"
                                    placeholder="Enter Product Name">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Brand Name</label>
                                <select class="form-control brand_list" name="e_brand_id">
                                    <option value="">Select Brand</option>
                                    <?php
                                      foreach($brandList as $item) {
                                        echo '<option value="'. $item['id'] .'">'. $item['name'] .'</option>';
                                      }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Category Name</label>
                                <select class="form-control category_list" name="e_category_id">
                                    <option value="">Select Category</option>
                                    <?php
                                      foreach($cateList as $item) {
                                        echo '<option value="'. $item['id'] .'">'. $item['name'] .'</option>';
                                      }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Description</label>
                                <textarea class="form-control" name="e_product_desc"
                                    placeholder="Enter product desc"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Product Price</label>
                                <input min="1" type="number" name="e_product_price" class="form-control"
                                    placeholder="Enter Product Price">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label>Product Old price </label>
                            <input type="text" name="e_product_oldPrice" class="form-control"
                                placeholder="Enter Product oldprice">
                        </div>
                    </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Product Resolution </label>
                    <input type="text" name="e_product_resolution" class="form-control"
                        placeholder="Enter Product Resolution">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label>Product Image</label>
                    <input type="text" name="e_product_image" placeholder="Enter Product Image URL"
                        class="form-control">
                    <img src="../product_images/1.0x0.jpg" class="img-fluid" width="50">
                </div>
            </div>

            <input type="hidden" name="pid">
            <input type="hidden" name="edit_product" value="1">
            <div class="col-12">
                <button type="button" class="btn btn-primary submit-edit-product">Add Product</button>
            </div>
        </div>

        </form>
    </div>
</div>
</div>
</div>
<!-- Edit Product Modal end -->

<?php include_once("./templates/footer.php"); ?>



<script type="text/javascript" src="./js/products.js"></script>