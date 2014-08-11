<?php $this->Js->JqueryEngine->jQueryObject = 'jQuery'; ?>
    <?php
    $this->Paginator->options(array(
        'update' => $update,
        'evalScripts' => true,
        'before' => $this->Js->get('#busy-indicator')->effect(
                'fadeIn', array('buffer' => false)
        ),
        'complete' => $this->Js->get('#busy-indicator')->effect(
                'fadeOut', array('buffer' => false)
        ),
    ));