
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <?php if (get_user_type() == 2) { ?>

                <div class="alert alert-warning">
                    <strong>Note:</strong> Please pay the partial payment of 50% to the admin's <a href="javascript:void(0);"
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="" 
                        data-original-title="View bank account"
                        class="col-white"
                        onclick="viewAccount()"
                        style="text-decoration: underline"
                        >bank account</a>. The payment must be fully paid after 3 days to approve the booked services. When service is cancelled, you can only refund 50% of your downpayment.
                    <div id="bank_account_details" class="hide">
                        <strong>Account number:</strong> <?=$bank_account->account?><br>
                        <strong>Bank name:</strong> <?=$bank_account->bank?>   
                    </div>
                </div>
                <?php } ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th><?=get_user_type() == 2 ? 'Type' : 'Customer' ?></th>
                                <th>Event</th>
                                <th>Order Status</th>
                                <th>Date ordered</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $value) { ?>
                            <tr>
                                <td>
                                    <?php if (get_user_type() == 2) {?>
                                        <?=$value->name?>
                                    <?php } else { ?>

                                    <span class="font-bold">Name: </span>
                                        <a href="<?=base_url()?>products/Info/index/<?=$value->product_id?>"
                                            data-toggle="tooltip" 
                                            data-placement="top" 
                                            title="" 
                                            data-original-title="View product"
                                        ><?=$value->name?></a>                                        
                                    <br>
                                    <span class="font-bold">Type: </span><?=$categories[$value->type]->name?>
                                    <?php } ?>

                                </td>
                                <td>
                                    <?php if (get_user_type() == 2) {?>
                                        <?=isset($categories[$value->type]) ? $categories[$value->type]->name : ''?>
                                    <?php } else { ?>
                                    <span class="font-bold">Name: </span>
                                        <a href="<?=base_url()?>account/view/<?=$value->customer_id?>"
                                            data-toggle="tooltip" 
                                            data-placement="top" 
                                            title="" 
                                            data-original-title="View profile"
                                        ><?=$value->customer_name?></a>
                                    <br>
                                    <span class="font-bold">Email: </span><?=$value->email?>
                                    <?php } ?>
                                </td>
                                <td>
                                    <span class="font-bold">Date: </span><?=date('Y-m-d', strtotime($value->event_date))?>
                                    <span class="font-bold">Time: </span><?=date('h:i A', strtotime($value->event_time))?>
                                    <br>
                                    <span class="font-bold">Address: </span><?=$value->event_address?>
                                </td>
                                <td>
                                    <?php if ($value->status == 0) { ?>
                                        Pending
                                    <?php } elseif ($value->status == 1) { ?>
                                        Approved
                                    <?php } elseif ($value->status == 2) { ?>
                                        Disapproved
                                    <?php } elseif ($value->status == 3) { ?>
                                        Cancelled
                                    <?php } elseif ($value->status == 4) { ?>
                                        Done
                                    <?php } ?>
                                </td>
                                <td><?=date('Y-m-d H:i', strtotime($value->create_time))?></td>
                                <td>
                                    <?php if (get_user_type() == 2) { ?>
                                    <?php if ($value->receipt && file_exists('./uploads/'.$value->receipt)) { ?>

                                    <?php if ($value->status != 4) { ?>
                                    <button onclick="uploadReceipt(<?=$value->id?>)"
                                        type="button" 
                                        class="btn btn-warning btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Change receipt">
                                        <i class="material-icons">refresh</i>
                                    </button>
                                    <?php } ?>
                                    <button onclick="showReceipt('<?=base_url().'/uploads/'.$value->receipt?>')"
                                        type="button" 
                                        class="btn btn-info btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="View receipt">
                                        <i class="material-icons">description</i>
                                    </button>
                                    <?php } else { ?>

                                    <button onclick="uploadReceipt(<?=$value->id?>)"
                                        type="button" 
                                        class="btn btn-warning btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Upload picture of receipt of the 50% payment">
                                        <i class="material-icons">note_add</i>
                                    </button>
                                    <?php } ?>

                                    <a href="<?=base_url()?>products/Info/index/<?=$value->product_id?>"
                                        type="button" 
                                        class="btn btn-info btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="View product">
                                        <i class="material-icons">info_outline</i>
                                    </a>
                                    <?php if ( ! in_array($value->status, [1, 4])) { ?>
                                    <button onclick="setStatus(<?=$value->id?>, 3)"
                                        type="button" 
                                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Cancel Order">
                                        <i class="material-icons">clear</i>
                                    </button>
                                    <?php } ?>
                                    <?php if ($value->status == 4 && ! $value->comment) { ?>
                                    <button onclick="review(<?=$value->id?>)"
                                        type="button" 
                                        class="btn btn-warning btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Review/Comment">
                                        <i class="material-icons">star</i>
                                    </button>
                                    <?php } ?>
                                    <?php } else {?>
                                        
                                    <?php if ($value->receipt && file_exists('./uploads/'.$value->receipt)) { ?>
                                        
                                    <button onclick="showReceipt('<?=base_url().'/uploads/'.$value->receipt?>')"
                                        type="button" 
                                        class="btn btn-info btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="View receipt">
                                        <i class="material-icons">description</i>
                                    </button>
                                    <?php } ?>

                                    <?php if ($value->status == 0 || $value->status == 2) { ?>
                                    <button onclick="setStatus(<?=$value->id?>, 1)"
                                        type="button" 
                                        class="btn btn-success btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Approve Order">
                                        <i class="material-icons">done</i>
                                    </button>
                                    <?php } ?>
                                    <?php if ($value->status == 0 || $value->status == 1) { ?>
                                    <button onclick="setStatus(<?=$value->id?>, 2)"
                                        type="button" 
                                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Disapprove Order">
                                        <i class="material-icons">clear</i>
                                    </button>
                                    <?php } ?>
                                    <?php if ($value->status == 1) { ?>
                                    <button onclick="setStatus(<?=$value->id?>, 4)"
                                        type="button" 
                                        class="btn btn-primary btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Mark as done">
                                        <i class="material-icons">done_all</i>
                                    </button>
                                    <?php } ?>
                                    <?php } ?>
                                    <?php if ($value->status == 4 && $value->comment) { ?>
                                    <button onclick="viewComment('<?=$value->comment?>')"
                                        type="button" 
                                        class="btn btn-warning btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="View Review/Comment">
                                        <i class="material-icons">star</i>
                                    </button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="modal fade in" data-backdrop="static" id="uploadModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-orange p-t-15 p-b-15">
                                <h4 class="modal-title" id="defaultModalLabel">UPLOAD RECEIPT</h4>
                            </div>
                            <form class="form-horizontal" enctype="multipart/form-data">
                                <input type="hidden" name="id" class="hide" id="order_id">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-md-12">Select file</label>
                                        <div class="col-md-12">
                                            <div class="form-line" id="input-file-upload">
                                                <input type="file" name="file" class="form-control" accept="image/*" required onchange="showImage(this)">
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

                <div class="modal fade in" data-backdrop="static" id="receiptModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-green p-t-15 p-b-15">
                                <h4 class="modal-title">VIEW RECEIPT</h4>
                            </div>
                            
                            <div class="modal-body">
                                <img class="thumbnail w-100 m-b-0" src="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#receiptModal').modal('hide')">CLOSE</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade in" data-backdrop="static" id="reviewModal">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-orange p-t-15 p-b-15">
                                <h4 class="modal-title" id="defaultModalLabel">REVIEW/COMMENT SERVICE</h4>
                            </div>
                            <form class="form-horizontal" enctype="multipart/form-data">
                                <input type="hidden" name="order_id" class="hide">
                                <div class="modal-body">
                                    <div class="form-group form-float m-t-15 m-l-0">
                                        <div class="form-line">
                                            <textarea name="comment" type="text" value="" class="form-control" rows="4"></textarea>
                                            <label class="form-label">Comment</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#reviewModal').modal('hide')">CANCEL</button>
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