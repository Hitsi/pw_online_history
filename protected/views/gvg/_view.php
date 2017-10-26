<?php
/* @var $this GvgController */
/* @var $data Gvg */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'datestart' => $data->datestart)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('datestart')); ?>:</b>
    <?php echo CHtml::encode($data->datestart); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('dateend')); ?>:</b>
    <?php echo CHtml::encode($data->dateend); ?>
    <br />


</div>