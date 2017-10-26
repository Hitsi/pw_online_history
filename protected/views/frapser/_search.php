<?php
/* @var $this FrapserController */
/* @var $model Frapser */
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
        <?php echo $form->label($model, 'nick'); ?>
        <?php echo $form->textField($model, 'nick', array('size' => 60, 'maxlength' => 120)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'class'); ?>
        <?php echo $form->textField($model, 'class'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'calc'); ?>
        <?php echo $form->textField($model, 'calc', array('size' => 60, 'maxlength' => 120)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'info'); ?>
        <?php echo $form->textArea($model, 'info', array('rows' => 6, 'cols' => 50)); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->