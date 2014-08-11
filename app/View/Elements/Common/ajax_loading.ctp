<style>
    #busy-indicator { display:none; }
</style>
<li class="loader">
<?php
echo $this->Html->image(
        'loader_bw.gif', array('id' => 'busy-indicator')
);
?>
</li>