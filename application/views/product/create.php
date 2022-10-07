
<div class="row clearfix">
    <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="body">
                <form class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="col-md-12">Name</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="name" required type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Desciption</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <textarea name="description" rows="10" class="form-control no-resize"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Price</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="price" required type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Good for # of persons</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <input name="total_person" required type="number" min="1" value="0" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Type</label>
                        <div class="col-md-12">
                            <div class="form-line">
                                <select name="type" class="form-control show-tick" name="type" data-live-search="true">
                                    <?php foreach($categories as $type => $label) {?>

                                    <option value="<?=$type?>"><?=$label->name?></option>
                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Product Images</label>
                        <div class="col-md-12">
                            <div id="product-images" class="list-unstyled row clearfix"></div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-line" id="input-file-upload">
                                <input type="file" name="file" class="form-control" accept="image/*" multiple onchange="showImage(this)">
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
                    </div>
                    
                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-success waves-effect pull-right">
                                <i class="material-icons">save</i>
                                <span>SAVE</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>