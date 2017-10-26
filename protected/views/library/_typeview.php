<?php
/* @var $this LibraryController */
/* @var $data Library */
?>


<li>
    <?php echo CHtml::link(CHtml::encode($data->name), array('view', 'type' => Lookup::item('LibraryType', $data->type), 'name' => $data->name)); ?>
