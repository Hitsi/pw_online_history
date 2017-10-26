<?php
/* @var $this ClansController */
/* @var $model Clans */
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
        <?php echo $form->label($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 128)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'master'); ?>
        <?php echo $form->textField($model, 'master', array('size' => 60, 'maxlength' => 128)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'marshal'); ?>
        <?php echo $form->textField($model, 'marshal', array('size' => 60, 'maxlength' => 128)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'kh'); ?>
        <?php echo $form->textField($model, 'kh'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'site'); ?>
        <?php echo $form->textField($model, 'site', array('size' => 60, 'maxlength' => 128)); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'type'); ?>
        <?php echo $form->textField($model, 'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'academ'); ?>
        <?php echo $form->textField($model, 'academ'); ?>
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