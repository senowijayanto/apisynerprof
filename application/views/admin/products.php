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
        <th>Category</th>
        <th>Name</th>
        <th>Image</th>
        <th>Created At</th>
        <th>Actions</th>
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
            <td><?php echo $category ;?></td>
            <td><?php echo $product->name ;?></td>
            <td><img src="<?php echo base_url().'uploads/products/' . $product->image;?>" alt="" width="100" height="100" /></td>
            <td><?php echo $product->created_at ;?></td>
            <td>&nbsp;</td>
          </tr>
        <?php endforeach; endif; ?>
      </tbody>
      <tfoot>
      <tr>
        <th>Category</th>
        <th>Name</th>
        <th>Image</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
