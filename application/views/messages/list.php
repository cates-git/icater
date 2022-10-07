<style>
.time {
    display: inline-block;
    font-size: 12px;
    color: #98a6ad;
}
.header img, .header h2 {
    display: inline-block;
}
.header h2 {
    vertical-align: middle;
}
</style>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            
            <?php if(get_user_type() != 2) { 
                
                if ($customer->avatar && file_exists('./uploads/'. $customer->avatar)) 
                {
                    $avatar = base_url('./uploads/'. $customer->avatar);
                } 
                else 
                {
                    $avatar = get_default_avatar();
                }
                ?>
            <div class="header">
            
                <img class="img-circle m-r-5" src="<?=$avatar?>" width="48" height="48">
                <h2><a href="<?=base_url()?>account/view/<?=$customer->id?>"
                        data-toggle="tooltip" 
                        data-placement="top" 
                        title="" 
                        data-original-title="View profile"
                        class="btn-hover btn btn-link padding-0"
                        style="font-size: 18px; font-weight: normal"
                    ><?=$customer->name?></a>
                    <small><?=$customer->email?></small>
                </h2>
            </div>
            <?php } ?>

            <div class="body">
                <div style="max-height: 335px;overflow: hidden auto;">
                <?php foreach($list as $message) { ?>

                <?php if($user_id != $message->sender) { ?>
                <div class="row">
                    <div class="col-sm-offset-6 col-sm-6 col-xs-12">
                        <div class="card m-b-5">
                            <div class="body bg-grey"><?=$message->message?></div>
                        </div>
                        <span class="time pull-right"><?=date('h:i A M j, Y', strtotime($message->create_time))?></span>
                    </div>
                </div>
                <?php } else { ?>
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div class="card m-b-5">
                            <div class="body bg-blue"><?=$message->message?></div>
                        </div>
                        <span class="time">me, <?=date('h:i A M j, Y', strtotime($message->create_time))?></span>
                    </div>
                </div>
                <?php } ?>
                <?php } ?>

                </div>

                <hr>

                <div class="row">
                    <div class="col-xs-12 m-b-0">
                        <input type="hidden" class="hide" name="receiver" value="<?=$receiver?>">
                        <div class="input-group">
                            <div class="form-line focused">
                                <textarea name="message" rows="2" class="form-control no-resize" placeholder="Type message"></textarea>
                            </div>
                            <span class="input-group-addon">
                                <a href="javascript:void(0);" onclick="sendMessage()">
                                <i class="material-icons">send</i>
                                </a>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>