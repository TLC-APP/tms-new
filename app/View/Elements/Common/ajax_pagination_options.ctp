<?php $this->Js->JqueryEngine->jQueryObject = 'jQuery'; ?>
<?php

$before = "$('$update').parent().parent().append('<div class=".'"overlay"></div>'."<div class=".'"loading-img"></div>'."');";
$complete = "$('.overlay').remove();$('.loading-img').remove();";
$this->Paginator->options(array(
    'url' => $this->passedArgs,
    'update' => $update,
    'evalScripts' => true,
    'data' => http_build_query($this->request->data),
    'method' => 'POST',
    'before' => $before,
    'complete' => $complete
));
