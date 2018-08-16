<!-- MAIN -->
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <!--Add category-->
                <div class="col-md-6">
                    <h4 class="text-center text-success">Add Category</h4>

                    <?php if($this->session->flashdata('success')){  ?>
                        <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button> 
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>

                    <form method="post" action="/admin/category/add">
                        <div class="form-group">
                            <label for="heading">Category name</label>
                            <input type="text" value="<?=set_value('name')?>"  name="name" class="form-control" id="heading"  placeholder="Enter category">
                        </div>
                        <div class="form-group">
                            <label for="heading">Parent category</label>
                            <select class="form-control" name="parent">
                                <option value="0">None</option>
                                <?php foreach($all_categories as $category): ?>
                                    <option value="<?=$category->id?>"><?=$category->name?></option>
                                <?php endforeach ; ?>
                            </select>
                        </div>
                        <?php //echo form_error('name'); ?>
                        <?php echo $this->session->flashdata('error'); ?>
                        <button type="submit" class="btn btn-primary">Add category</button>
                    </form>

                </div>
                <div class="col-md-6">
                    <h4 class="text-center text-success">List categories</h4>

                     <table class="table table-striped table-categories">
                            <thead>
                            <tr>
                                <th>N 
                                    <a href="?order_by=id&order=ASC"><span class="glyphicon order-by glyphicon-arrow-up text-success"></span></a>
                                    <a href="?order_by=id&order=DESC"><span class="glyphicon order-by glyphicon-arrow-down text-success"></span></a>
                                </th>
                                <th>Name
                                    <a href="?order_by=name&order=ASC"><span class="glyphicon order-by glyphicon-arrow-up text-success"></span></a>
                                    <a href="?order_by=name&order=DESC"><span class="glyphicon order-by glyphicon-arrow-down text-success"></span></a>
                                </th>
                                <th>Parent category
                                    <a href="?order_by=parent&order=ASC"><span class="glyphicon order-by glyphicon-arrow-up text-success"></span></a>
                                    <a href="?order_by=parent&order=DESC"><span class="glyphicon order-by glyphicon-arrow-down text-success"></span></a>
                                </th>
                                <th>Delete</th>
                                <th>Select</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $pagination_id = $this->uri->segment(4) ? $this->uri->segment(4) : 1 ;
                            $i=($pagination_id - 1) * $per_page; 
                            ?>
                            <?php 
                                if(is_single_entry( $pagination_id, $total_rows, $per_page ))
                                    $to_page = $pagination_id - 1;
                                else
                                    $to_page = $pagination_id;
                            ?>
                            <?php foreach($categories as $category): ?>
                                <?php echo "<tr>"; ?>
                                <?php $i++; ?>
                                <td><?php echo $i; ?></td>
                                <td><a href="/admin/category/edit/<?php echo $category->slug;?>"><?php echo $category->name; ?></a></td>
                                <td><?php echo $category->parent; ?></td>
                                <td><a href="/admin/category/delete/<?=$category->id.'/'.$to_page?>" class="text-danger">delete</a></td>
                                <td><input class="categories-to-delete" type="checkbox" value="<?php echo $category->id; ?>"></td>
                                <?php echo "</tr>"; ?>

                            <?php endforeach;?>
                            </tbody>
                        </table>
                        <button id="delete_categories" type="submit" class="btn btn-danger pull-right">Delete selected categories</button>
                        <div class="text-center"><?php echo $this->pagination->create_links(); ?></div>
                        
                </div>
            </div>

        </div>
    </div>
    <!-- END MAIN CONTENT -->
</div>
<!-- END MAIN -->