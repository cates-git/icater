        
<section class="content m-l-15">
    <div class="container">
        <div class="row clearfix category">
            <div class="m-b-40 text-center col-black">
                <h2 class="text-uppercase">Products</h2>
                <h4 class="media-heading"><?=$seller->name?></h4>
                <p class="margin-0">
                    <b>Shop : </b><?=$seller->shop_name?> <br>
                    <b>Address : </b><?=$seller->address?> <br>
                    <b>Contact # : </b><?=$seller->contact_number?>
                </p>
                <hr class="m-t-0" style="border-top: 3px solid #000; width: 40px; border-radius: 25px">
            </div>

            <?php if (empty($products)) { ?>

            <div class="col-sm-12">
                <p class="font-italic col-black text-center">There are no products.</p>
            </div>
            <?php } else { ?>
            
            <?php foreach ($products as $product) { ?>
            
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card h-100">
                    <div class="overflow-hidden">
                        <img class="card-img-top" src="<?=base_url()?>uploads/<?=$images[$product->id]->image_url?>" alt="">
                    </div>
                    <div class="body">
                        <a href="<?=base_url()?>Booking/detail/<?=$product->id?>" type="button" class="btn btn-link waves-effect" style="white-space: normal"><?=$product->name?></a>
                        <p><?=nl2br(substr($product->description, 0, 50))?><?=strlen($product->description) > 50 ? '...' : ''?></p>
                    </div>
                </div>
            </div>
            <?php } } ?>

        </div>
    </div>
</section>