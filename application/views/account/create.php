
<div class="row clearfix">
    <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="header p-t-10 p-b-10">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="<?=base_url()?>Account/alist" class="btn btn-default text-uppercase waves-effect pull-right">
                            <i class="material-icons">close</i>
                            <span>Cancel</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="body">
                <form class="form-horizontal">
                    <div class="row">
                        <div class="col-md-12 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Type</label>
                                <div class="col-md-12">
                                    <div class="demo-radio-button">
                                        <input name="type" type="radio" id="radio_admin" class="with-gap" value="0" checked>
                                        <label for="radio_admin">Admin</label>
                                        <input name="type" type="radio" id="radio_seller" class="with-gap" value="1">
                                        <label for="radio_seller">Seller</label>
                                        <input name="type" type="radio" id="radio_customer" class="with-gap" value="2">
                                        <label for="radio_customer">Customer</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">First Name</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="first_name" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Last Name</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="last_name" type="text" value="" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group type-seller hide">
                        <label class="col-md-12">Shop Name</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="shop_name" type="text" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group type-seller-customer hide">
                        <label class="col-md-12 type-seller hide">Caterer Address</label>
                        <label class="col-md-12 type-customer hide">Address</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="address" type="text" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Profile Picture</label>
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
                        <div class="col-md-12 picture-preview hide">
                            <div id="profile-picture" class="list-unstyled row clearfix"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Contact Number</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="contact_number" type="text" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Email</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="email" type="email" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Username</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="username" type="text" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Password</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="password" type="password" value="" class="form-control"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 m-b-0">
                            <div class="form-group">
                                <label class="col-md-12">Retype password</label>
                                <div class="col-md-12">
                                    <div class="form-line">
                                        <input name="confirm" type="password" value="" class="form-control"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" id="btn-save">
                        <div class="col-sm-12">
                            <button class="btn btn-success text-uppercase pull-right">
                                <i class="material-icons">save</i>
                                <span>Save</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>