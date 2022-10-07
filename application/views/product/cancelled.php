
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th><?=get_user_type() == 2 ? 'Type' : 'Customer' ?></th>
                                <th>Event</th>
                                <th>Date ordered</th>
                                <th>Date cancelled</th>
                                <?php if (get_user_type() == 2) {?>
                                <th>Actions</th>
                                <?php } ?>
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
                                        <?=$categories[$value->type]->name?>
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
                                    <br>
                                    <span class="font-bold">Address: </span><?=$value->event_address?>
                                </td>
                                <td><?=date('Y-m-d H:i', strtotime($value->create_time))?></td>
                                <td><?=date('Y-m-d H:i', strtotime($value->cancel_time))?></td>
                                <?php if (get_user_type() == 2) {?>
                                <td>

                                    <a href="<?=base_url()?>products/Info/index/<?=$value->product_id?>"
                                        type="button" 
                                        class="btn btn-info btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="View product">
                                        <i class="material-icons">info_outline</i>
                                    </a>
                                    <button onclick="setStatus(<?=$value->id?>, 0)"
                                        type="button" 
                                        class="btn btn-success btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Re Order">
                                        <i class="material-icons">done</i>
                                    </button>
                                    <button 
                                        onclick="deleteOrder(<?=$value->id?>)"
                                        type="button" 
                                        class="btn btn-danger btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Delete order">
                                        <i class="material-icons">delete</i>
                                    </button>
                                </td>
                                <?php } ?>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>