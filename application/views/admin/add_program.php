<div class="row">
  <div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <!-- form start -->
      <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-4">
              <input type="text" name="name" class="form-control" placeholder="Program Name">
            </div>
          </div>
          <div class="form-group">
            <label for="inputDescription" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
              <textarea class="textarea" name="description" placeholder="Place some description here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputIngredients" class="col-sm-2 control-label">Items</label>
            <div class="col-sm-10">
              <textarea class="textarea" name="items" placeholder="Place some items here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputPrice" class="col-sm-2 control-label">Price</label>
            <div class="col-sm-4">
              <input type="number" name="price" class="form-control" placeholder="Program Price">
            </div>
          </div>
          <div class="form-group">
            <label for="inputImage" class="col-sm-2 control-label">Image</label>
            <div class="col-sm-10">
              <input type="file" name="image">
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-info">Submit</button>
              <button type="reset" class="btn btn-default">Cancel</button>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </form>
    </div>
    <!-- /.box -->
  </div>
</div>
