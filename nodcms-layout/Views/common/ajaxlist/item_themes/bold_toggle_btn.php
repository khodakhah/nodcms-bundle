<?php
echo button_toggle_action(array(
    'url'=>str_replace('$content', $content, $config['url']),
    'success'=>"function(){ $('#$row_id').toggleClass('bold'); }",
    'default'=>$data[$config['default']],
    'caption1'=>'<i class="icon-envelope-open"></i> '._l("Make read", $this),
    'caption2'=>'<i class="icon-envelope"></i> '._l("Make unread", $this),
    'class'=>"btn btn-link btn-sm",
));
