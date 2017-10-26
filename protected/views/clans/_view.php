<?php
/* @var $this ClansController */
/* @var $data Clans */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('master')); ?>:</b>
    <?php echo CHtml::encode($data->master); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('marshal')); ?>:</b>
    <?php echo CHtml::encode($data->marshal); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('kh')); ?>:</b>
    <?php echo CHtml::encode($data->kh); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('site')); ?>:</b>
    <?php echo CHtml::encode($data->site); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
    <?php echo CHtml::encode($data->type); ?>
    <br />

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('academ')); ?>:</b>
      <?php echo CHtml::encode($data->academ); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('info')); ?>:</b>
      <?php echo CHtml::encode($data->info); ?>
      <br />

     */ ?>

</div>