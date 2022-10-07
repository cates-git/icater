
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix m-t-30">
            <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4" id="user-signin">
                <div class="card">
                    <div class="body m-b-50">
                        <form method="POST" action="<?=base_url()?>Login/sign_in">
                            <div class="msg text-center m-b-10 font-bold col-green">SIGN IN</div>
                            <hr class="m-t-0" style="border-top: 2px solid #4caf50; width: 30px;">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">person</i>
                                </span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
                                </div>
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="material-icons">lock</i>
                                </span>
                                <div class="form-line">
                                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-lg btn-success waves-effect pull-right" type="submit">SIGN IN</button>
                                    <button type="button" class="btn btn-link waves-effect pull-left col-blue" onclick="$('#user-signin').addClass('hide');$('#user-register').removeClass('hide')">Register an account</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-sm-offset-3 hide" id="user-register">
                <div class="card">
                    <div class="body m-b-50">
                        <form method="POST" action="<?=base_url()?>Login/register/true">
                            <div class="msg text-center m-b-10 font-bold col-green">CREATE AN ACCOUNT</div>
                            <hr class="m-t-0" style="border-top: 2px solid #4caf50; width: 30px;">

                            <div class="form-group">
                                <label>I am a </label>
                                <div class="demo-radio-button">
                                    <input name="type" type="radio" id="radio_seller" class="with-gap" value="1" checked>
                                    <label for="radio_seller">Seller</label>
                                    <input name="type" type="radio" id="radio_customer" class="with-gap" value="2">
                                    <label for="radio_customer">Customer</label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 m-b-0">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="first_name" type="text" value="" class="form-control" required autocomplete="off">
                                            <label class="form-label">First Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 m-b-0">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="last_name" type="text" value="" class="form-control" required autocomplete="off">
                                            <label class="form-label">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group form-float type-seller">
                                <div class="form-line">
                                    <input name="shop_name" type="text" value="" class="form-control" autocomplete="off">
                                    <label class="form-label">Shop Name</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="address" type="text" value="" class="form-control" required>
                                    <label class="form-label type-seller">Caterer Address</label>
                                    <label class="form-label type-customer hide">Address</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="contact_number" type="text" value="" class="form-control" required autocomplete="off">
                                    <label class="form-label">Contact Number</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="email" type="email" value="" class="form-control" required autocomplete="off">
                                    <label class="form-label">Email</label>
                                </div>
                            </div>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input name="username" type="text" value="" class="form-control" required autocomplete="off">
                                    <label class="form-label">Username</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 m-b-0">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="password" type="password" value="" class="form-control" required autocomplete="off">
                                            <label class="form-label">Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 m-b-0">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input name="confirm" type="password" value="" class="form-control" required autocomplete="off">
                                            <label class="form-label">Retype password</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <button class="btn btn-lg btn-success waves-effect pull-right" type="submit">REGISTER</button>
                                    <button type="button" class="btn btn-link waves-effect pull-left col-blue" onclick="$('#user-signin').removeClass('hide');$('#user-register').addClass('hide')">Already have an account?</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
create = '<?=$create?>' != false;
</script>