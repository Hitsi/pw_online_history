<?php
/* @var $this LibraryController */
/* @var $data Library */
?>

<div class="library">

    <li>
        <?php echo CHtml::link(CHtml::encode($data->name), array('view', 'type' => Lookup::item('LibraryType', $data->type), 'name' => $data->name)); ?>
    </li>

</div>