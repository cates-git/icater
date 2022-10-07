
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header p-t-10 p-b-10">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="<?=base_url()?>products/Create" class="btn btn-success waves-effect pull-right">
                            <i class="material-icons">add</i>
                            <span>ADD PRODUCT</span>
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
                                <th>Name</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Status</th>
                                <?php if (get_user_type() == 1) {?>

                                <th>Request Status</th>
                                <?php } else { ?>

                                <th>Seller</th>
                                <?php } ?>

                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $value) { ?>
                            <tr>
                                <td><?=$value->id?></td>
                                <td>
                                    <?=$value->name?>

                                </td>
                                <td><?=nl2br(substr($value->description, 0, 50))?><?=strlen($value->description) > 50 ? '...' : ''?></td>
                                <td><?=isset($categories[$value->type]) ? $categories[$value->type]->name : ''?></td>
                                <td class="status-<?=$value->id?>"><?=$value->status ? 'Available' : 'Unavailable';?></td>
                                <?php if (get_user_type() == 1) {?>
                                <td>
                                    <?php if ($value->request_status == 1) { ?>
                                        Pending
                                    <?php } elseif ($value->request_status == 2) { ?>
                                        Approved
                                    <?php } ?>
                                    <?php if ($value->request_status == 3) { ?>
                                        Disapproved
                                    <?php } ?>
                                </td>

                                <?php } else { ?>

                                <td>
                                    <span class="font-bold">Seller: </span>
                                    <a href="<?=base_url()?>account/view/<?=$value->user_id?>"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="View seller"
                                    ><?=$value->seller?></a>
                                    <br>
                                    <span class="font-bold">Email: </span><?=$value->email?>
                                </td>
                                <?php } ?>

                                <td>
                                    <a href="<?=base_url()?>products/Info/index/<?=$value->id?>"
                                        type="button" 
                                        class="btn btn-info btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="View product">
                                        <i class="material-icons">info_outline</i>
                                    </a>
                                    <button 
                                        onclick="setStatus(<?=$value->id?>, <?=$value->status?>)"
                                        type="button" 
                                        class="btn btn-warning btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Edit Status">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <?php if (get_user_type() != 0) {?>

                                    <button 
                                        onclick="deleteProduct(<?=$value->id?>)"
                                        type="button" 
                                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Delete">
                                        <i class="material-icons">delete</i>
                                    </button>
                                    <?php } ?>

                                </td>
                            </tr>
                            <?php } ?>
                            
                        </tbody>
                    </table>
                </div>
                <div class="modal fade in" data-backdrop="static" id="editModal">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-orange p-t-15 p-b-15">
                                <h4 class="modal-title" id="defaultModalLabel">EDIT PRODUCT STATUS</h4>
                                
                            </div>
                            <form class="form-horizontal" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="hidden" name="id" class="hidden" id="product_id">
                                        <label class="col-md-12">Set Status</label>
                                        <div class="col-md-12">
                                            <div class="form-line">
                                                <select name="status" class="form-control" name="type">
                                                    <option  value="1">Available</option>
                                                    <option  value="0">Unavailable</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#editModal').modal('hide')">CANCEL</button>
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