
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Event</th>
                                <th>Date ordered</th>
                                <?php if (get_user_type() != 1) {?>
                                    
                                <th>Actions</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($list as $value) { 
                            if ($value->name) { ?>
                            <tr>
                                <td>
                                    <span class="font-bold">Name: </span>
                                        <a href="<?=base_url()?>products/Info/index/<?=$value->product_id?>"
                                            data-toggle="tooltip" 
                                            data-placement="top" 
                                            title="" 
                                            data-original-title="View product"
                                        ><?=$value->name?></a>                                        
                                    <br>
                                    <span class="font-bold">Type: </span><?=isset($categories[$value->type]) ? $categories[$value->type]->name : ''?>

                                    <?php if (get_user_type() != 1) { ?>

                                    <br>
                                    <span class="font-bold">Seller: </span>
                                        <a href="<?=base_url()?>account/view/<?=$value->user_id?>"
                                            data-toggle="tooltip" 
                                            data-placement="top" 
                                            title="" 
                                            data-original-title="View seller">
                                            <?=$value->seller_name?>
                                        </a>

                                    <?php } ?>
                                </td>
                                <td>
                                    <span class="font-bold">Name: </span>
                                        <a href="<?=base_url()?>account/view/<?=$value->customer_id?>"
                                            data-toggle="tooltip" 
                                            data-placement="top" 
                                            title="" 
                                            data-original-title="View profile"
                                        ><?=$value->customer_name?></a>
                                    <br>
                                    <span class="font-bold">Email: </span><?=$value->email?>
                                </td>
                                <td>
                                    <span class="font-bold">Date: </span><?=date('Y-m-d', strtotime($value->event_date))?>
                                    <br>
                                    <span class="font-bold">Address: </span><?=$value->event_address?>
                                </td>
                                <td><?=date('Y-m-d H:i', strtotime($value->create_time))?></td>

                                <?php if (get_user_type() != 1) {?>

                                <td>
                                    <?php if ($value->book_id) {?>
                                    
                                    <span class="col-green">
                                        <i class="material-icons" style="vertical-align: middle;">done</i>
                                        Seller was notified on <?=date('Y-m-d H:i', strtotime($value->date_notified))?>
                                    </span>
                                    <?php } else { ?>

                                    <button onclick="notifySeller(<?=$value->id?>)"
                                        type="button" 
                                        class="btn btn-primary btn-circle waves-effect waves-circle waves-float"
                                        data-toggle="tooltip" 
                                        data-placement="top" 
                                        title="" 
                                        data-original-title="Notify Seller">
                                        <i class="material-icons">notifications_active</i>
                                    </button>
                                    <?php } ?>

                                </td>
                                <?php } ?>

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