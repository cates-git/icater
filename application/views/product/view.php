
<div class="row clearfix">
    <div class="col-md-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    <?php if (get_user_type() != 2) { ?>

                    <button type="button" class="btn btn-warning waves-effect pull-right" data-toggle="modal" data-target="#editModal">
                        <i class="material-icons">edit</i>
                        <span>EDIT</span>
                    </button>
                    
                    <?php  } ?>
                    <?=$info->name?> <small><?=isset($categories[$info->type]) ? $categories[$info->type]->name : ''?></small>
                    
                </h2>
                
                <?php if (get_user_type() != 2) { ?>

                <div class="modal fade in" id="editModal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-orange p-t-15 p-b-15">
                                <h4 class="modal-title" id="defaultModalLabel">EDIT PRODUCT</h4>
                            </div>
                            <form class="form-horizontal" enctype="multipart/form-data">
                                <div class="modal-body">
                                        <div class="form-group m-b-15">
                                            <label class="col-md-12">Name</label>
                                            <div class="col-md-12">
                                                <div class="form-line">
                                                    <input name="name" value="<?=$info->name?>" required type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-b-15">
                                            <label class="col-md-12">Desciption</label>
                                            <div class="col-md-12">
                                                <div class="form-line">
                                                    <textarea name="description" rows="10" class="form-control no-resize"><?=$info->description?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-b-15">
                                            <label class="col-md-12">Price</label>
                                            <div class="col-md-12">
                                                <div class="form-line">
                                                    <input name="price" value="<?=$info->price?>" required type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group m-b-15">
                                            <label class="col-md-12">Good for # of persons</label>
                                            <div class="col-md-12">
                                                <div class="form-line">
                                                    <input name="total_person" value="<?=$info->total_person?>" required type="number" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12">Type</label>
                                            <div class="col-md-12">
                                                <div class="form-line">
                                                    <select name="type" class="form-control show-tick" name="type" data-live-search="true">
                                                        <?php foreach($categories as $type => $label) {?>

                                                        <option <?php if ($type == $info->type) echo 'selected'; ?> value="<?=$type?>"><?=$label->name?></option>
                                                        <?php } ?>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</button>
                                    <button type="submit" class="btn btn-success waves-effect">SAVE CHANGES</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php  } ?>

            </div>
            <div class="body">
                <b>Description: </b><br/><?=nl2br($info->description)?><br>
                <b>Price: </b><?=$info->price?><br>
                <b>Good for <?=$info->total_person?> person/s</b>
                <hr>
                <div id="product-images" class="list-unstyled row clearfix">
                    <?php $total_images = count($images);
                    foreach ($images as $image) { ?>

                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 image-<?=$image->id?>">
                        <div class="card">
                            <?php if (get_user_type() != 2) { ?>
                            <?php if ($total_images > 5) { ?>

                            <button onclick="removeImage('.image-<?=$image->id?>', <?=$image->id?>)"
                                type="button" 
                                class="delete-image m-t--15 m-r--15 btn btn-danger btn-circle waves-effect waves-circle waves-float pull-right">
                                <i class="material-icons">clear</i>
                            </button>
                            <?php } ?>
                            <?php } ?>

                            <div class="body">
                                <a href="<?=base_url('uploads/'.$image->image_url)?>" data-sub-html="Demo Description">
                                    <img class="img-responsive thumbnail m-b-0 current" src="<?=base_url('uploads/'.$image->image_url)?>">
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>

                <?php if (get_user_type() != 2) { ?>

                <div class="list-unstyled row clearfix add-image-div <?php if ($total_images >= 10) echo 'hide'; ?>">
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                        <label class="add-label">Add Image</label>
                        <input placeholder="Add Image" type="file" name="file" class="form-control" accept="image/*" multiple onchange="showImage(this)">
                        <div class="preloader pl-size-xs hide" style="position: absolute;top: 30px;right: 25px;">
                            <div class="spinner-layer pl-red-grey">
                                <div class="circle-clipper left">
                                    <div class="circle"></div>
                                </div>
                                <div class="circle-clipper right">
                                    <div class="circle"></div>
                                </div>
                            </div>
                        </div>
                        <button onclick="saveImages()"
                            type="button" 
                            class="btn-save-images btn btn-danger waves-effect hide">
                            <i class="material-icons">add</i>
                            <span>SAVE ADDED IMAGES</span>
                        </button>
                    </div>
                </div>
                <?php } ?>
                
            </div>
        </div>
    </div>
</div>
<script>
    product_id = "<?=$info->id;?>";
</script>