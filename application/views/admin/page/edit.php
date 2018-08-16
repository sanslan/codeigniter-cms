<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
        <h2 class="text-center text-success">Edit page</h2>
        <form method="post" action="/admin/page/edit/<?php echo $page->slug; ?>">
            <div class="form-group">
                <label for="heading">Page title</label>
                <input type="text" value="<?php echo $page->title; ?>"  name="title" class="form-control" id="heading"  placeholder="Enter header">
            </div>
            <?php echo form_error('title'); ?>
            <div class="form-group">
                <label for="body">Page body</label>
                <textarea class="form-control" name="body" id="body" rows="3"><?php echo $page->body; ?></textarea>
            </div>
            <?php echo form_error('body'); ?>
            <button type="submit" class="btn btn-primary pull-left">Update page</button>
            <a href="/admin/page/list" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>List pages</a>
        </form>

        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->