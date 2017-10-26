<?php
/* @var $this BattleController */
/* @var $data Battle */
?>

<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('datestart')); ?>:</b>
    <?php echo CHtml::encode($data->datestart); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('timestart')); ?>:</b>
    <?php echo CHtml::encode($data->timestart); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('defend')); ?>:</b>
    <?php echo CHtml::encode($data->defend); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('atack')); ?>:</b>
    <?php echo CHtml::encode($data->atack); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('winner')); ?>:</b>
    <?php echo CHtml::encode($data->winner); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('gvgid')); ?>:</b>
    <?php echo CHtml::encode($data->gvgid); ?>
    <br />

    <?php /*
      <b><?php echo CHtml::encode($data->getAttributeLabel('territory')); ?>:</b>
      <?php echo CHtml::encode($data->territory); ?>
      <br />

      <b><?php echo CHtml::encode($data->getAttributeLabel('important')); ?>:</b>
      <?php echo CHtml::encode($data->important); ?>
      <br />

     */ ?>

</div>