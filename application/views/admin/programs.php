<a href="<?php echo site_url('admin/programs/add');?>" class="btn btn-primary btn-flat">
  <i class="fa fa-plus"></i>
  Add Program
</a>
<br>
<span>&nbsp;</span>
<div class="box box-info">
  <div class="box-body">
    <table id="syner_table" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Image</th>
      </tr>
      </thead>
      <tbody>
        <?php if($programs): foreach($programs as $program): ?>
          <tr>
            <td>
              <div class="">
                <?php echo $program->name ;?>
              </div>
              <div class="">
                <a href="<?php echo site_url('admin/programs/edit/'.$program->id);?>">Edit</a> |
                <a href="<?php echo site_url('admin/programs/delete/'.$program->id);?>" class="delete">Delete</a>
              </div>
            </td>
            <td><?php echo number_format($program->price, 0, ',', '.');?></td>
            <td><img src="<?php echo base_url().'uploads/programs/' . $program->thumbnail;?>" alt="" /></td>
          </tr>
        <?php endforeach; endif; ?>
      </tbody>
      <tfoot>
      <tr>
        <th>Name</th>
        <th>Price</th>
        <th>Image</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
