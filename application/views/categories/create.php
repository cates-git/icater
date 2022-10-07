
<div class="row clearfix">
    <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="header p-t-10 p-b-10">
                <div class="row">
                    <div class="col-xs-12">
                        <a href="<?=base_url()?>Categories/alist" class="btn btn-default text-uppercase waves-effect pull-right">
                            <i class="material-icons">close</i>
                            <span>Cancel</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-12">Category Name</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="name" required type="text" value="" class="form-control" autofocus>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Category Picture</label>
                        <div class="col-md-12">
                            <div class="form-line" id="input-file-upload">
                                <input type="file" required name="file" class="form-control" accept="image/*" onchange="showImage(this)">
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