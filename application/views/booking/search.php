<style>
.media-body .time {
    display: inline-block;
    font-size: 12px;
    color: #98a6ad;
}
.media-body .btn:hover {
    background: #fff;
    color: #e65540;
}
.search .btn {
    color: #000;
    background: #fff!important;
    padding: 10px 30px;
    border-radius: 50px!important;
}
.search .btn:hover {
    background-color: #e65540!important;
    color: #fff;
}

</style>       
<section class="content m-l-15">
    <div class="container">
        <div class="row clearfix category">
            <div class="col-sm-12 m-b-15 search">
                <form action="<?=base_url()?>booking/search" method="GET">
                    <input 
                        value="<?=$keyword?>"
                        name="keyword"
                        style="display: inline-block; width: 350px; padding: 17px 12px; vertical-align: bottom; font-size: 13px;" 
                        type="text" 
                        class="form-control p-t-18 p-b-18" 
                        placeholder="Type keyword..">
                    <button style="display: inline-block" type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">SEARCH</button>
                </form>
            </div>
            <!-- <div class="m-b-40">
                <h2 class="text-uppercase col-black">Search for "<?=$keyword?>"</h2>
            </div> -->

            <?php if (empty($list)) { ?>
            
            <div class="col-sm-12">
                <p class="font-italic col-black text-center">There are no search results.</p>
            </div>
            <?php } else { ?>
            
            <?php foreach ($list as $seller) { ?>
            <div class="col-xs-12">
                <div class="card h-100">
                    <div class="body">
                        <div class="media m-b-0">
                            <div class="media-left">
                                <img class="media-object img-circle" src="<?=$seller->avatar && file_exists('./uploads/'.$seller->avatar) ? base_url().'uploads/'.$seller->avatar : 'https://placehold.it/250x250&text=seller'?>" width="64" height="64">
                            </div>
                            <div class="media-body">
                                <a href="<?=base_url()?>booking/products/<?=$seller->id?>"><h5 class="media-heading"><?=$seller->name?></h5></a>
                                <p class="margin-0">
                                    <b>Shop : </b><?=$seller->shop_name?> <br>
                                    <b>Address : </b><?=$seller->address?> <br>
                                    <b>Contact # : </b><?=$seller->contact_number?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</section>