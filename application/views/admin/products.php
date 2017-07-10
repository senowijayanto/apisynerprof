<a href="<?php echo site_url('admin/products/add');?>" class="btn btn-primary btn-flat">
  <i class="fa fa-plus"></i>
  Add Product
</a>
<br>
<span>&nbsp;</span>
<div class="box box-info">
  <div class="box-body">
    <table id="syner_table" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Image</th>
      </tr>
      </thead>
      <tbody>
        <?php if($products): foreach($products as $product): ?>
          <?php
            $category = "";
            switch ($product->category) {
              case '1':
                $category = "Nutrition";
                break;
              case '2':
                $category = "Body Care";
              default:
                break;
            }
          ?>
          <tr>
            <td>
              <div class="">
                <?php echo $product->name ;?>
              </div>
              <div class="">
                <a href="<?php echo site_url('admin/products/edit/'.$product->id);?>">Edit</a> |
                <a href="<?php echo site_url('admin/products/delete/'.$product->id);?>" class="delete">Delete</a>
              </div>
            </td>
            <td><?php echo $category ;?></td>
            <td><img src="<?php echo base_url().'uploads/products/' . $product->image;?>" alt="" width="100" height="100" /></td>
          </tr>
        <?php endforeach; endif; ?>
      </tbody>
      <tfoot>
      <tr>
        <th>Name</th>
        <th>Category</th>
        <th>Image</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
