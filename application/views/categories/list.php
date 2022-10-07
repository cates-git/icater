
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header p-t-10 p-b-10">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="./create" class="btn btn-success waves-effect pull-right">
                            <i class="material-icons">add</i>
                            <span>ADD CATEGORY</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Category Name</th>
                                <th>Category Image</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $value) { ?>
                            <tr id="account-<?=$value->id?>">
                                <td><?=$value->id?></td>
                                <td><?=$value->name?></td>
                                <td>
                                <?php if ($value->image && file_exists('./uploads/'. $value->image)) { ?>

                                    <img style="width: 128px" src="<?=base_url('./uploads/'.$value->image)?>" alt="">
                                <?php }  ?>

                                </td>
                                <td>
                                    <button 
                                        onclick="editCategory(<?=$value->id?>, '<?=$value->name?>')"
                                        type="button" 
                                        class="btn btn-warning btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Edit">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <button 
                                        onclick="deleteCategory(<?=$value->id?>)"
                                        type="button" 
                                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Delete">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal fade in" data-backdrop="static" id="editModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-orange p-t-15 p-b-15">
                                <h4 class="modal-title" id="defaultModalLabel">EDIT CATEGORY</h4>
                            </div>
                            <form class="form-horizontal" enctype="multipart/form-data">
                                <input type="hidden" name="id" class="hide" id="category_id">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-md-12">Category Name</label>
                                        <div class="col-md-12">
                                            <div class="form-line">
                                                <input name="name" type="text" value="" class="form-control" id="category_name">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Select file</label>
                                        <div class="col-md-12">
                                            <div class="form-line" id="input-file-upload">
                                                <input type="file" name="file" class="form-control" accept="image/*" onchange="showImage(this)">
                                                <div class="preloader pl-size-xs hide" style="position: absolute;top: 0;right: 0;">
                                                    <div class="spinner-layer pl-red-grey">
                                                        <div class="circle-clipper left">
                                                            <div class="circle"></div>
                                                        </div>
                                                        <div class="circle-clipper right">
                                                            <div class="circle"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 picture-preview hide m-b-0">
                                            <div id="picture"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#uploadModal').modal('hide')">CANCEL</button>
                                    <button type="submit" class="btn btn-success waves-effect">SAVE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>