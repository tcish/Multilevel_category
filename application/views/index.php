<?php 
  require_once "inc/header.php";

  $arr=[];
  $html = "";
  foreach ($tree_fetch as $key) {
    $arr[$key["id"]]["name"] = $key["name"];
    $arr[$key["id"]]["parent_id"] = $key["parent_id"];
  }

  function buildTreeView($arr, $parent, $level = 0, $preLevel = -1){
    global $html;
    foreach ($arr as $id => $data) {
      if ($parent == $data["parent_id"]) {
        if ($level > $preLevel) {
          if ($html == "") {
            $html .= "<ul>";
          }else {
            $html .= "<ul class='mb-3'>";
          }
        }
        if ($level == $preLevel) {
          $html .= "</li>";
        }
        $html .= "<li><div><a href='".base_url() ."category/edit/$id/".$data['parent_id']."' style='font-size: 1.4rem;'>".$data['name']."</a></div>";

        if ($level > $preLevel) {
          $preLevel = $level;
        }
        $level++;
        buildTreeView($arr, $id, $level, $preLevel);
        $level--;
      }
    }
    if ($level == $preLevel) {
      $html .= "</li></ul>";
    }
    return $html;
  }
?>
<div class="border border-secondary mx-4 my-4 vh-100">
  <div class="navbar bg-info">
    <h2 class="pt-3 pl-3 float-left">Categories</h2>
      <a href="<?= base_url() ?>category/insert" class="btn btn-success float-right mt-3 mr-3">Add Category</a>
  </div>
  <hr>
  <?php
    echo buildTreeView($arr, 0); 
  ?>
</div>
<?php require_once "inc/footer.php"; ?>
