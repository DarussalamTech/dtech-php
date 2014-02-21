<h2>Send Email Invitation to Users Who has imported from joomla site</h2>
<?php
$panel = array();
$counter = 1;
foreach($users as $user){
    $content = "<div id='sender_".$counter."' style='border:1px solid black;padding-left:5px;margin-bottom:10px;'>";
    $content.= "<h2><a href='javascript:void(0);' onclick='dtech.checkAllGroupBox(this)' >Check/Uncheck </a>Group ".$counter."</h2>";
    foreach($user as $s){
        $content.= "<span><input type='checkbox' class='user_".$counter."' value='".$s['user_email']."' />".$s['user_email']."</span>";
        $content.= "<span class='hidden' style='display:none'>".$s['user_id']."</span>";
        $content.= "<br/>";
        $content.= "<br/>";
    }
   $content.= CHtml::button("Send",
           array(
               "class"=>"btn",
               "style"=>"margin-bottom:10px;margin-top:10px",
               "onclick"=>"dtech.sendInvitation(this,'".$this->createUrl("/user/sendEmailinvitation")."')"
               )); 
   $content.= "<div style='font-weight:bold;margin-top:10px;margin-bottom:10px'></div>";
   echo $content."</div>";
            
    $counter++;        
}
?>
