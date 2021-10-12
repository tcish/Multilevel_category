<?php require_once "inc/header.php"; ?>
<form method="post" autocomplete="off">
  <div class="row mt-5">
    <div class="col-12 col-sm-8 col-md-6 col-lg-5 offset-sm-2 offset-md-3 offset-lg-3">
      <div class="form-group">
        <label>Parent Category</label>
        <select name="parentCat" class="form-control">
          <option value="">Select Parent Category</option>
          <?php
            foreach ($all as $show_cat) {
              if ($show_cat["id"] == $pId) {
                echo "<option selected value='".$show_cat['id']."'>".$show_cat['name']."</option>";
              } else {
                echo "<option value='".$show_cat['id']."'>".$show_cat['name']."</option>";
              }
            }
          ?>
        </select>
      </div>
      <?php foreach ($editGet as $key) { ?>
        <div class="form-group">
          <label>Category Name</label>
          <input type="text" class="form-control" name="cat" placeholder="Enter Category Name" value="<?= $key['name']; ?>">
          <?= form_error("cat", "<span class='text-danger font-weight-bold'>", "</span>"); ?>
        </div>
      <?php } ?>
      <button type="submit" name="add" class="btn btn-primary">Update</button>
      <a href='<?= base_url() ?>category/del/<?= $key["id"] ?>' class="btn btn-danger">Delete</a>
      <a href="<?= base_url() ?>category/" class="btn btn-info">Go back</a>
    </div>
  </div>
</form>
<?php require_once "inc/footer.php"; ?>