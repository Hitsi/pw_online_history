<?php
/* @var $this VideoController */
/* @var $model Video */
/* @var $form CActiveForm */
?>

<div class="wide form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'action' => Yii::app()->createUrl($this->route),
        'method' => 'get',
            ));
    ?>

    <div class="row">
        <?php echo $form->label($model, 'id'); ?>
        <?php echo $form->textField($model, 'id'); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 120)); ?>
    </div>
    <div class="row">
        <?php echo $form->label($model, 'create_time'); ?>
        <?php echo $form->textField($model, 'create_time'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'frapserid'); ?>
        <?php echo $form->textField($model, 'frapserid'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'clan'); ?>
        <?php echo $form->textField($model, 'clan'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'type'); ?>
        <?php echo $form->textField($model, 'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'linktype'); ?>
        <?php echo $form->textField($model, 'linktype'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'link'); ?>
        <?php echo $form->textField($model, 'link', array('size' => 60, 'maxlength' => 120)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'class'); ?>
        <?php echo $form->textField($model, 'class'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'battleid'); ?>
        <?php echo $form->textField($model, 'battleid'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->