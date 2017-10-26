<?php
/* @var $this FrapserController */
/* @var $data Frapser */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('nick')); ?>:</b>
    <?php echo CHtml::encode($data->nick); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('class')); ?>:</b>
    <?php echo CHtml::encode($data->class); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('calc')); ?>:</b>
    <?php echo CHtml::encode($data->calc); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('info')); ?>:</b>
    <?php echo CHtml::encode($data->info); ?>
    <br />


</div>