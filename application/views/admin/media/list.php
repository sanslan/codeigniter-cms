<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content media-page">
        <div class="container-fluid">
        <div class="media-page-header">
            <span style="font-size:23px">Media library</span>
            <form action="/admin/upload/upload" method="post" enctype='multipart/form-data'>
                <div class="file-upload-button">
                    New file
                    <input type="file" name="files[]" onchange="this.form.submit()" multiple>
                </div>  
            </form>
        </div>
        <div class="media-sort-wrapper">
            <div class="media-sorters col-md-6">
                <div class="form-group col-md-4">
                    <select class="form-control" name="parent">
                        <option value="0">All media types</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <select class="form-control" name="parent">
                        <option value="0">All dates</option>
                    </select>
                </div>
            </div>
            <div class="media-search-box col-md-6">
                <div class="col-md-6 pull-right">
                    <input type="text" name="" class="form-control">
                </div>
            </div>
        </div>

        <div class="library-files-wrapper">
            <?php foreach($pages as $page): ?>
                <div class="media-wrapper" data-toggle="modal" data-target="#myModal<?php echo $page->id;?>">
                    <img src="http://ci-blog.loc/<?php echo $page->name ?>" alt="">
                </div>
                <div id="myModal<?php echo $page->id;?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">File details</h4>
                        </div>
                        <div class="modal-body">
                            <img src="http://ci-blog.loc/<?php echo $page->name ?>" alt="">
                            <hr>
                            <form action="/admin/media/delete" method="post">
                                <input type="hidden" name="file_to_delete" value="<?php echo $page->id;?>">
                                <input type="submit" value="Delete file">
                            </form>
                        </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>

        </div>
        <?php 
            if(!empty($this->session->flashdata('msg'))){
                foreach($this->session->flashdata('msg') as $msg){
                    echo $msg;
                }
            }

        ?>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->