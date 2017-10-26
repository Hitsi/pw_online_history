<?php
/* @var $this VideoController */
/* @var $data Video */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
    <?php echo CHtml::encode($data->title); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
    <?php echo CHtml::encode($data->create_time); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('frapserid')); ?>:</b>
    <?php echo CHtml::encode($data->frapserid); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('clan')); ?>:</b>
    <?php echo CHtml::encode($data->clan); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
    <?php echo CHtml::encode($data->type); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('linktype')); ?>:</b>
    <?php echo CHtml::encode($data->linktype); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
    <?php echo CHtml::encode($data->link); ?>
    <br />

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('class')); ?>:</b>
      <?php echo CHtml::encode($data->class); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('battleid')); ?>:</b>
      <?php echo CHtml::encode($data->battleid); ?>
      <br />

     */ ?>

</div>