<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <h2 class="text-center text-success" style="margin-top:0">List pages</h2>
            <?php if($this->session->flashdata('success')){  ?>
                <div class="alert alert-success alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button> 
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>
            <table class="table table-striped table-pages">
                <thead>
                    <tr>
                        <th>N</th>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Delete</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $pagination_id = $this->uri->segment(4) ? $this->uri->segment(4) : 1 ;
                    $i=($pagination_id - 1) * $per_page; 
                    if(is_single_entry( $pagination_id, $total_rows, $per_page ))
                        $to_page = $pagination_id - 1;
                    else
                        $to_page = $pagination_id;
                    ?>
                    <?php foreach($pages as $page): ?>
                        <?php echo "<tr>"; ?>
                        <?php $i++; ?>
                        <td><?php echo $i; ?></td>
                        <td><a href="/admin/page/edit/<?php echo $page->slug;?>"><?php echo $page->title; ?></a></td>
                        <td><a href="/admin/page/edit/<?php echo $page->slug;?>"><?php echo $page->slug; ?></a></td>
                        <td><a href="/admin/page/delete/<?=$page->id.'/'.$to_page ?>" class="text-danger">delete</a></td>
                        <td><input class="pages-to-delete" type="checkbox" value="<?php echo $page->id; ?>"></td>
                        <?php echo "</tr>"; ?>

                    <?php endforeach;?>
                </tbody>
            </table>
            <a href="/admin/page/add" class="btn btn-success pull-left"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>New page</a>
            <button id="delete_pages" type="submit" class="btn btn-danger pull-right">Delete selected pages</button>
            <div class="text-center"><?php echo $this->pagination->create_links(); ?></div>
        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->
	