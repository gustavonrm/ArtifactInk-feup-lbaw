<?php
include_once("../templates/tpl_admin.php");

draw_header();
draw_navbar();
?>

<div class="container-fluid">
  <div class="row">

    <?php draw_sidebar("sales") ?>

    <main class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="container">

        <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap border-bottom mt-2">
          <h1>Add Sale</h1>
          <button type="button" class="btn button" data-toggle="modal" data-target="#addQuestionModal">
            Submit
          </button>
        </div>

        <form>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="inputTitle">Title</label>
              <input type="text" class="form-control" id="inputTitle" placeholder="Write sale title...">
            </div>
            <div class="form-group col-md-3">
              <label for="inputStartDate">Start Date</label>
              <input type="date" class="form-control" id="inputStartDate">
            </div>
            <div class="form-group col-md-3">
              <label for="inputEndDate">End Date</label>
              <input type="date" class="form-control" min="0" id="inputEndDate">
            </div>
          </div>
        </form>

        <div class="mx-auto mt-2">
          <div class="row">
            <div class="col-md-6 col-sm-12">
              <div class="mt-2">
                <h3>Add Items</h3>
              </div>
              <div class="input-group my-3 mr-sm-2">
                <input class="form-control" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="collapse" data-target="#collapseFilterLeft" aria-expanded="false" aria-controls="collapseFilter">
                    Filter
                  </button>
                </div>
              </div>

              <div class="collapse" id="collapseFilterLeft">
                <div class="row align-items-center justify-content-around">
                  <div class="col-md-6 col-sm-12">
                    <label for="categories">Categories</label>
                    <div id="categories" class="rounded border p-2 search-box-category">
                      <?php for ($i = 1; $i < 6; $i++) { ?>

                        <div class="custom-control custom-checkbox mb-3">
                          <input type="checkbox" class="custom-control-input" id="category<?= $i ?>">
                          <label class="custom-control-label" for="category<?= $i ?>">Category <?= $i ?></label>
                        </div>
                      <?php } ?>
                    </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                    <label for="brands">Brands</label>
                    <div id="brands" class="rounded border p-2 search-box-category">
                      <?php for ($i = 1; $i < 6; $i++) { ?>

                        <div class="custom-control custom-checkbox mb-3">
                          <input type="checkbox" class="custom-control-input" id="brand<?= $i ?>">
                          <label class="custom-control-label" for="brand<?= $i ?>">Brand <?= $i ?></label>
                        </div>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="col-3 text-center">
                    <div class="custom-control custom-switch my-3">
                      <input type="checkbox" class="custom-control-input" id="stockSwitch">
                      <label class="custom-control-label" for="stockSwitch">In-Stock</label>
                    </div>
                  </div>

                  <div class="col-9">
                    <div class="range-slider my-3">
                      <label for="price">Price:
                        <span class="rangeValues"></span>
                      </label>
                      <input type="range" class="custom-range price-slider" name="minprice" value="0" min="0" max="200" step="1">
                      <input type="range" class="custom-range price-slider" name="maxprice" value="200" min="0" max="200" step="1">
                    </div>
                  </div>

                </div>

              </div>

              <table class="table table-striped text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $product = array(
                    "id" => 1,
                    "name" => "Dynamic Black Ink 100ml",
                    "price" => 17.99,
                    "img" => "https://media.killerinktattoo.pt/media/catalog/product/cache/12/image/2495a9b687712b856acb717d0b834074/d/y/dynamic-tattoo-ink-black.jpg"
                  );

                  for ($i = 0; $i < 7; $i++) {
                    draw_product_add_sale_row($product);
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="mt-2">
                <h3>Item List</h3>
              </div>
              <div class="input-group my-3 mr-sm-2">
                <input class="form-control" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="collapse" data-target="#collapseFilterRight" aria-expanded="false" aria-controls="collapseFilter">
                    Filter
                  </button>
                </div>
              </div>

              <div class="collapse" id="collapseFilterRight">
                <div class="row align-items-center justify-content-around">

                  <div class="col-md-6 col-sm-12">
                    <label for="categories">Categories</label>
                    <div id="categories" class="rounded border p-2 search-box-category">
                      <?php for ($i = 1; $i < 6; $i++) { ?>

                        <div class="custom-control custom-checkbox mb-3">
                          <input type="checkbox" class="custom-control-input" id="category<?= $i ?>">
                          <label class="custom-control-label" for="category<?= $i ?>">Category <?= $i ?></label>
                        </div>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="col-md-6 col-sm-12">
                    <label for="brands">Brands</label>
                    <div id="brands" class="rounded border p-2 search-box-category">
                      <?php for ($i = 1; $i < 6; $i++) { ?>

                        <div class="custom-control custom-checkbox mb-3">
                          <input type="checkbox" class="custom-control-input" id="brand<?= $i ?>">
                          <label class="custom-control-label" for="brand<?= $i ?>">Brand <?= $i ?></label>
                        </div>
                      <?php } ?>
                    </div>
                  </div>

                  <div class="col-3 text-center">
                    <div class="custom-control custom-switch my-3">
                      <input type="checkbox" class="custom-control-input" id="stockSwitch">
                      <label class="custom-control-label" for="stockSwitch">In-Stock</label>
                    </div>
                  </div>

                  <div class="col-9">
                    <div class="range-slider my-3">
                      <label for="price">Price:
                        <span class="rangeValues"></span>
                      </label>
                      <input type="range" class="custom-range price-slider" name="minprice" value="0" min="0" max="200" step="1">
                      <input type="range" class="custom-range price-slider" name="maxprice" value="200" min="0" max="200" step="1">
                    </div>
                  </div>

                </div>
              </div>

              <table class="table table-striped text-center">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Photo</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  for ($i = 0; $i < 3; $i++) {
                    draw_product_remove_sale_row($product);
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </main>

  </div>
</div>

<?php
draw_footer();
?>