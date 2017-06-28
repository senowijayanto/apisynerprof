<div class="box box-info">
  <div class="box-body">
    <table id="syner_table" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>Sponsor ID</th>
        <th>Member ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
      </thead>
      <tbody>
        <?php if ($users): foreach ($users as $user): ?>
          <?php
            $sponsor = "";
            if ( $user->sponsor_id ) {
              $sponsor = $users_model->get_by('id', $user->sponsor_id)->member_id;
            }
          ?>
          <tr>
            <td><?php echo $sponsor;?></td>
            <td><?php echo $user->member_id;?></td>
            <td><?php echo $user->name;?></td>
            <td><?php echo $user->email;?></td>
            <td><?php echo $user->phone;?></td>
            <td><?php echo ($user->status == 1 ? 'Paid' : 'Not Paid');?></td>
            <td><?php echo $user->created_at;?></td>
            <td>
              &nbsp;
            </td>
          </tr>
        <?php endforeach; endif; ?>
      </tbody>
      <tfoot>
      <tr>
        <th>Sponsor ID</th>
        <th>Member ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Actions</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>
<!-- /.box -->
