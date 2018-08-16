<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <!--Add category-->
                <div class="col-md-6">
                    <h4 class="text-center text-success">Edit Category</h4>

                    <?php if($this->session->flashdata('success')){  ?>
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button> 
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>

                    <form method="post" action="/admin/category/update">
                        <input type="hidden" name="slug" value="<?=$cur_category->slug?>">
                        <div class="form-group">
                            <label for="heading">Category name</label>
                            <input type="text" value="<?=$cur_category->name?>"  name="name" class="form-control" id="heading"  placeholder="Enter category">
                        </div>
                        <div class="form-group">
                            <label for="heading">Parent category</label>
                            <select class="form-control" name="parent">
                                <option value="0">None</option>
                                <?php foreach($all_categories as $category): ?>
                                    <option <?php if($category->id == $cur_category->parent_id) echo "selected"; ?> value="<?=$category->id?>"><?=$category->name?></option>
                                <?php endforeach ; ?>
                            </select>
                        </div>
                        <?php //echo form_error('name'); ?>
                        <?php echo $this->session->flashdata('error'); ?>
                        <button type="submit" class="btn btn-success pull-left">Update category</button>
                        <a href="/admin/category/list" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>List categories</a>
                    </form>

                </div>
            </div>

        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->