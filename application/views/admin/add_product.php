<div class="row">
  <div class="col-md-12">
    <!-- Horizontal Form -->
    <div class="box box-info">
      <!-- form start -->
      <form class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="box-body">
          <div class="form-group">
            <label for="inputCategory" class="col-sm-2 control-label">Category</label>
            <div class="col-sm-4">
              <select class="form-control" name="category">
                <option value="option">Please Select Category</option>
                <option value="1">Nutrition</option>
                <option value="2">Body Care</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label for="inputName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-4">
              <input type="text" name="name" class="form-control" placeholder="Product Name">
            </div>
          </div>
          <div class="form-group">
            <label for="inputDescription" class="col-sm-2 control-label">Description</label>
            <div class="col-sm-10">
              <textarea class="textarea" name="description" placeholder="Place some description here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputBenefits" class="col-sm-2 control-label">Benefits</label>
            <div class="col-sm-10">
              <textarea class="textarea" name="benefits" placeholder="Place some benefits here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputRecomended" class="col-sm-2 control-label">Recommended</label>
            <div class="col-sm-10">
              <textarea class="textarea" name="recomended" placeholder="Place some recomended uses here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
            </div>
          </div>
          <div class="form-group">
            <label for="inputIngredients" class="col-sm-2 control-label">Ingredients</label>
            <div class="col-sm-10">
              <textarea class="textarea" name="ingredients" placeholder="Place some ingredients here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
