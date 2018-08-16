<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
        <h2 class="text-center text-success">Add page</h2>

        <?php if($this->session->flashdata('success')){  ?>
            <div class="alert alert-success alert-dismissible fade in" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button> 
                <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php } ?>

        <form method="post" action="/admin/page/add">
            <div class="form-group">
                <label for="heading">Page title</label>
                <input type="text" value="<?=set_value('header')?>"  name="title" class="form-control" id="heading"  placeholder="Enter header">
            </div>
            <?php echo form_error('title'); ?>
            <div class="form-group">
                <label for="body">Page body</label>
                <textarea class="form-control" name="body" id="body" rows="3"><?=set_value('body')?></textarea>
            </div>
            <?php echo form_error('body'); ?>
            <button type="submit" class="btn btn-success pull-left"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Save page</button>
            <a href="/admin/page/list" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>List pages</a>
        </form>

        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->