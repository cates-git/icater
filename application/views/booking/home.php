
<style>
.masthead {
    height: 90vh;
    min-height: 600px;
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    position: relative;
}
.masthead .align-items-center {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, 0%);
}

.masthead .btn {
    color: #000;
    background: #fff!important;
    padding: 10px 30px;
    border-radius: 50px!important;
}
.masthead .btn:hover {
    background-color: #e65540!important;
    color: #fff;
}

</style>
    
<section class="content">
    <header class="masthead" style="background-image: url('<?=base_url()?>assets/images/categories/header.jpg'); margin: -30px -15px;">
        <div class="container h-100" style="width: 100%;
        background: linear-gradient(to bottom,rgba(22,22,22,.1) 0,rgba(22,22,22,.5) 75%,#161616 100%);">
            <div class="row align-items-center">
                <div class="col-12 col- text-center">
                    <h1 class="font-50" style="font-weight: 900">i.Cater</h1>
                    <!-- <p class="lead font-weight-light">Manage your orders now</p> -->
                    <!-- <a href="<?=base_url()?>Booking/sign_in" type="button" class="btn btn-primary">SIGN IN</a> -->
                    <form action="<?=base_url()?>booking/search" method="GET">
                        <input 
                            name="keyword"
                            style="display: inline-block; width: 350px; padding: 17px 12px; vertical-align: bottom; font-size: 13px;" 
                            type="text" 
                            class="form-control p-t-18 p-b-18" 
                            placeholder="Type keyword..">
                        <button style="display: inline-block" type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">SEARCH</button>
                    </form>
                </div>
            </div>
        </div>
    </header>
        
    <section class="m-l-15 m-t-50 m-b-50">
        <div class="container-fluid">
            <div class="row clearfix text-center">
                <div class="m-b-40 m-t-50 col-black">
                    <h2>CATEGORIES</h2>
                    <hr class="m-t-0" style="border-top: 3px solid #000; width: 40px; border-radius: 25px">
                </div>
                <?php foreach(categories() as $id => $category) { ?>
                    
                <div class="col-sm-6 col-lg-3">
                    <div class="card h-100 card-no-border overflow-hidden">
                        

                        <?php if (isset($images[$category->id])) { ?>
                        <div class="owl-carousel owl-theme">
                        <?php foreach ($images[$category->id] as $image) { ?>
                            <div class="item item-img">
                                <img class="card-img-top" src="<?=base_url().'uploads/'.$image->image_url?>">
                            </div>
                        <?php } ?>                                
                        </div>

                        <?php } else { ?>
                            <img class="card-img-top " src="<?=file_exists('./uploads/'.$category->image) ? base_url().'uploads/'.$category->image : 'https://placehold.it/350x250&text=category'?>">
                        <?php } ?>
                        <div class="body card-img-btn">
                            <a href="<?=base_url()?>Booking/index/<?=$id?>" class="btn btn-lg btn-default waves-effect text-uppercase"><?=$category->name?></a>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>

        </div>
    </section>
</section>