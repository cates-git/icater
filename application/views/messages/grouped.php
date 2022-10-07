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
</style>
<div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="body">
                <?php 
                $user_id = get_user_data()['id'];
                $shown_users = [];
                $has_message = FALSE;
                foreach($list as $message) {
                    // received 
                    if (isset($users[$message->sender]) && ($message->sender != $user_id || $message->receiver == 0) && ! in_array($message->sender, $shown_users)) {
                        $shown_users[] = $message->sender;
                        if ( ! $has_message)
                        {
                            $has_message = TRUE;
                        }
                        
                        if ($users[$message->sender]->avatar && file_exists('./uploads/'. $users[$message->sender]->avatar)) 
                        {
                            $avatar = base_url('./uploads/'. $users[$message->sender]->avatar);
                        } 
                        else 
                        {
                            $avatar = get_default_avatar();
                        }
                ?>

                <div class="media">
                    <div class="media-left">
                        <a href="<?=base_url('messages/view/'.$message->sender);?>">
                            <img class="media-object img-circle" src="<?=$avatar?>" width="64" height="64">
                        </a>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading"><a href="<?=base_url('messages/view/'.$message->sender);?>" class="btn media-heading m-b-0 font-weight-light btn-link padding-0"><?=$users[$message->sender]->name?></a></h5> 
                        <span class="time"><?=date('h:i A M j, Y', strtotime($message->create_time))?></span>
                        <p><?=$message->message?></p>
                    </div>
                </div>
                <?php 
                // sent 
                } elseif (isset($users[$message->receiver]) && $message->sender == $user_id && ! in_array($message->receiver, $shown_users)) {
                        $shown_users[] = $message->receiver;
                        
                        if ( ! $has_message)
                        {
                            $has_message = TRUE;
                        }
                        if ($users[$message->sender]->avatar && file_exists('./uploads/'. $users[$message->sender]->avatar)) 
                        {
                            $avatar = base_url('./uploads/'. $users[$message->sender]->avatar);
                        } 
                        else 
                        {
                            $avatar = get_default_avatar();
                        }
                ?>

                <div class="media">
                    <div class="media-left">
                        <a href="<?=base_url('messages/view/'.$message->receiver);?>">
                            <img class="media-object img-circle" src="<?=$avatar?>" width="64" height="64">
                        </a>
                    </div>
                    <div class="media-body">
                        <h5 class="media-heading">
                            <a href="<?=base_url('messages/view/'.$message->receiver);?>" class="btn media-heading m-b-0 font-weight-light btn-link padding-0">me, <?=$users[$message->receiver]->name?></a>
                        </h5> 
                        <span class="time"><?=date('h:i A M j, Y', strtotime($message->create_time))?></span>
                        <p><?=$message->message?></p>
                    </div>
                </div>
                <?php } ?>
                <?php } 
                if ( ! $has_message) 
                {
                    echo '<p class="text-center">No messages.</p>';
                }
                ?>
            </div>
        </div>
    </div>
</div>