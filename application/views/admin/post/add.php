<?php $this->load->view('admin/snippets/add_post_header'); ?>
<?php if($this->session->flashdata('success')){  ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button> 
        <?php echo $this->session->flashdata('success'); ?>
    </div>
 <?php } ?>
<form method="post" action="/admin/post/add" enctype="multipart/form-data">

    <div class="col-md-9"><!--Left column-->        
        <div class="form-group">
            <label for="heading">Post title</label>
            <input type="text" value="<?=set_value('title')?>"  name="title" class="form-control" id="heading"  placeholder="Enter header">
        </div>
        <?php echo form_error('title'); ?>
        <div class="form-group">
            <label for="body">Post body</label>
            <textarea class="form-control" name="body" id="body" rows="20"><?=set_value('body')?></textarea>
        </div>
        <?php echo form_error('body'); ?>
        <button type="submit" class="btn btn-success pull-left"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Save post</button>
            <a href="/admin/post/list" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>List posts</a>
        
    </div><!--end of lklleft column-->

    <div class="col-md-3"><!--Right column-->
        <div class="post-categories">
            <p><strong>Categories</strong></p>
            <ul class="list-categories list-unstyled">
                <?php foreach($categories as $category) : ?>
                    <li class="checkbox">
                        <label><input <?php echo set_checkbox('categories[]', $category->id); ?> name="categories[]" value="<?=$category->id?>" type="checkbox"><?=$category->name?></label>
                    </li>
                <?php endforeach ;?>
            </ul>

        </div>
        <div class="post-thumbnail form-group">
            <p><strong>Thumbnail picture</strong></p>
            <a id="select_thumbnail" class="btn btn-default btn-block" href="#">Select thumbnail</a>
            <input type="hidden" id="thumb_input" name="thumbnail" value="">
            <img id="thumb-image" src="<?php echo base_url().'/assets/img/no-image.png';?>"/>
            <a href="#" class="text-primary remove-thumbnail-button">Remove thumbnail</a>
        </div>
        <?php echo form_error('thumbnail'); ?>
        <div class="post-thumbnail form-group">
            <p><strong>Publish date</strong></p>
            <input id="my_dtp" class="my_dtp_c form-control" size="16" type="text" name="publish_date">
        </div>
    </div><!--end of right column-->
</form>

<?php $this->load->view('admin/snippets/add_post_footer'); ?>