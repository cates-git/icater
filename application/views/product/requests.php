
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Seller</th>
                                <th>Type</th>
                                <th>Request Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $value) { 
                            if ($value->seller) { ?>
                            <tr>
                                <td>
                                    <span class="font-bold">Name: </span>
                                    <a href="<?=base_url()?>products/Info/index/<?=$value->id?>"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="View product">
                                        <?=$value->name?>
                                    </a>
                                    <br>
                                    <span class="font-bold">Description: </span><br/><?=nl2br(substr($value->description, 0, 50))?><?=strlen($value->description) > 50 ? '...' : ''?>
                                </td>
                                <td>
                                    <span class="font-bold">Name: </span>
                                    <a href="<?=base_url()?>account/view/<?=$value->user_id?>"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="View seller">
                                        <?=$value->seller?>
                                    </a>
                                    <br>
                                    <span class="font-bold">Email: </span><?=$value->email?>
                                </td>
                                <td><?=isset($categories[$value->type]) ? $categories[$value->type]->name : ''?></td>
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
                                <td>
                                    <button 
                                        onclick="actionRequest(<?=$value->id?>, 2)"
                                        type="button" 
                                        class="btn btn-success btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Approve Request">
                                        <i class="material-icons">done</i>
                                    </button>
                                    <?php if ($value->request_status != 3) { ?>
                                    <button 
                                        onclick="actionRequest(<?=$value->id?>, 3)"
                                        type="button" 
                                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Disapprove Request">
                                        <i class="material-icons">clear</i>
                                    </button>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>