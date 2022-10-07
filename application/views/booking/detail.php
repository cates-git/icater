
<section class="content m-l-15">
    <div class="container">
        <div class="row clearfix">
            <div class="col-sm-6">
                <div class="card card-no-border overflow-hidden h-100">
                    <img class="card-img-top" id="image-preview" src="<?=base_url()?>uploads/<?=$images[0]->image_url?>" alt="">
                    <div class="m-t-20 row">
                        <?php foreach ($images as $image) { ?>

                        <div class="col-sm-3 col-md-2 m-b-10 p-r-5 p-l-5">
                            <img onclick="viewImage('<?=base_url()?>uploads/<?=$image->image_url?>')" class="w-100" src="<?=base_url()?>uploads/<?=$image->image_url?>" alt="" style="cursor: pointer">
                        </div>
                        <?php } ?>

                    </div>

                </div>
            </div>
            <div class="col-sm-6">
                <div class="card card-no-border h-100">
                    <div class="header">
                        <h2>
                            <?=$product->name?> <small><?=isset($categories[$product->type]) ? $categories[$product->type]->name : ''?></small>
                        </h2>
                    </div>
                    <div class="body">
                        <h3 class="font-bold"><?=$product->price?></h3>
                        <p class="font-bold">Good for <?=(int) $product->total_person?> person/s</p>
                    </div>
                    <div class="body">
                        <p class="font-bold">Description</p>
                        <?=nl2br($product->description)?>
                    </div>
                    
                    <?php if (not_logged_in() || get_user_type() == 2) { ?>
                    <div class="body">
                        <button onclick="orderService()" type="button" class="btn btn-lg bg-red btn-round waves-effect">ORDER SERVICE</button>
                    </div>
                    <?php } ?>
                    <hr class="m-t-0 m-b-0">
                    <div class="body">
                        <p class="font-bold">Reviews (<?=count($reviews)?>)</p>
                        <?php foreach ($reviews as $review) { ?>

                        <p>"<?=$review->comment?>" - <span class="col-blue"><?=$review->email?></span></p>
                        <?php } ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="modal fade" data-backdrop="static" id="customer-register">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue p-t-15 p-b-15">
                <h4 class="modal-title text-center">REGISTER TO CONTINUE</h4>
            </div>
            <form class="form-horizontal" action="<?=base_url()?>Login/register">
                <!-- Modal body -->
                <div class="modal-body">
                    
                    <div class="row">
                        <div class="col-md-6 m-b-0">
                            <div class="form-group form-float m-b-15">
                                <div class="form-line">
                                    <input name="first_name" type="text" value="" class="form-control" required autocomplete="off">
                                    <label class="form-label">First Name</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-0">
                            <div class="form-group form-float m-b-15">
                                <div class="form-line">
                                    <input name="last_name" type="text" value="" class="form-control" required autocomplete="off">
                                    <label class="form-label">Last Name</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-float m-b-15">
                        <div class="form-line">
                            <input name="address" type="text" value="" class="form-control" required autocomplete="off">
                            <label class="form-label">Address</label>
                        </div>
                    </div>
                    <div class="form-group form-float m-b-15">
                        <div class="form-line">
                            <input name="contact_number" type="text" value="" class="form-control" required autocomplete="off">
                            <label class="form-label">Contact Number</label>
                        </div>
                    </div>
                    <div class="form-group form-float m-b-15">
                        <div class="form-line">
                            <input name="email" type="email" value="" class="form-control" required autocomplete="off">
                            <label class="form-label">Email</label>
                        </div>
                    </div>
                    <div class="form-group form-float m-b-15">
                        <div class="form-line">
                            <input name="username" type="text" value="" class="form-control" required autocomplete="off">
                            <label class="form-label">Username</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 m-b-0">
                            <div class="form-group form-float m-b-15">
                                <div class="form-line">
                                    <input name="password" type="password" value="" class="form-control" required autocomplete="off">
                                    <label class="form-label">Password</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-0">
                            <div class="form-group form-float m-b-15">
                                <div class="form-line">
                                    <input name="confirm" type="password" value="" class="form-control" required autocomplete="off">
                                    <label class="form-label">Retype password</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect pull-left col-blue" data-dismiss="modal" onclick="$('#customer-register').modal('hide');$('#customer-signin').modal('show')">Sign in instead</button>
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#customer-register').modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-lg btn-success waves-effect">REGISTER</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" data-backdrop="static" id="customer-signin">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue p-t-15 p-b-15">
                <h4 class="modal-title text-center">SIGN IN</h4>
            </div>
            <form class="form-horizontal" action="<?=base_url()?>Login/sign_in/true">
                <div class="modal-body">            
                    <div class="row">
                        <div class="col-md-6 m-b-0">        
                            <div class="form-group form-float m-b-15">
                                <div class="form-line">
                                    <input name="username" type="text" value="" class="form-control" required autocomplete="off">
                                    <label class="form-label">Username</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-0">  
                            <div class="form-group form-float m-b-15">
                                <div class="form-line">
                                    <input name="password" type="password" value="" class="form-control" required autocomplete="off">
                                    <label class="form-label">Password</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#customer-register').modal('hide')">CANCEL</button>
                    <button type="submit" class="btn btn-lg btn-success waves-effect">SIGN IN</button>
                    <button type="button" class="btn btn-link waves-effect pull-left col-blue" data-dismiss="modal" onclick="$('#customer-signin').modal('hide');$('#customer-register').modal('show')">Register an account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" data-backdrop="static" id="customer-book">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-blue p-t-15 p-b-15">
                <h4 class="modal-title text-center">ORDER DETAILS</h4>
            </div>
            <!-- <form class="form-horizontal" action="<?=base_url()?>Booking/order_service/<?=$product->id?>"> -->
                <div class="modal-body">            
                    <div class="row">
                        <div class="form-group form-float m-b-15">
                            <label class="form-label">Event Date</label>
                            <div class="form-line">
                                <input name="event_date" type="date" value="" class="form-control" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group form-float m-b-15">
                            <label class="form-label">Event Time</label>
                            <div class="form-line">
                                <input name="event_time" type="time" value="" class="form-control" required autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group m-b-15">
                            <label class="form-label">Event Address</label>
                            <div class="form-line">
                                <input name="event_address" type="text" value="" class="form-control" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal" onclick="$('#customer-book').modal('hide')">CANCEL</button>
                    <button type="button" onclick="bookService()" class="btn btn-lg btn-success waves-effect">ORDER</button>
                </div>
            <!-- </form> -->
        </div>
    </div>
</div>

<script>
product_id = "<?=$product->id?>";
</script>

<style>
.modal form .form-group {
    margin-left: 0!important;
}
.modal .modal-footer {
    padding: 15px 25px!important;
}

</style>
