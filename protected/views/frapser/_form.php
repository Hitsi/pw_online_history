<?php
/* @var $this FrapserController */
/* @var $model Frapser */
/* @var $form CActiveForm */
?>
<style> select { width: 400px } </style>
<div class="form">

    <?php
    Yii::import('ext.imperavi-redactor-widget.ImperaviRedactorWidget');
    $this->widget('ImperaviRedactorWidget', array(
        // Селектор для textarea
        'selector' => '.redactor',
        // Немного опций, см. http://imperavi.com/redactor/docs/
        'plugins' => array(
            'fullscreen' => array(
                'js' => array('fullscreen.js',),
            ),
        ),
        'options' => array('lang' => 'ru',
            'fullpage' => true,
            'paragraphy'=> false,
            'linebreaks'=> true,
            'width' => 600,
            'height' => 400,),
    ));
    $this->widget('ext.EChosen.EChosen', array(
        'target' => 'select'));
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'frapser-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Поля помечнные <span class="required">*</span> являются обязательными.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'nick'); ?>
        <?php echo $form->textField($model, 'nick', array('size' => 60, 'maxlength' => 120)); ?>
        <?php echo $form->error($model, 'nick'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'class'); ?>
        <?php echo $form->dropDownList($model, 'class', Lookup::items('PlayerClassName')); ?>
        <?php echo $form->error($model, 'class'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'calc'); ?>
        <?php echo $form->textField($model, 'calc', array('size' => 60, 'maxlength' => 120)); ?>
        <?php echo $form->error($model, 'calc'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'owner'); ?>
        <?php echo $form->dropDownList($model, 'owner', User::droplist(), array('options' => array(Yii::app()->getRequest()->getQuery("owner") => array('selected' => true)))); ?>
        <?php echo $form->error($model, 'owner'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'info'); ?>
        <?php echo $form->textArea($model, 'info', array('rows' => 6, 'cols' => 50, 'class' => 'redactor')); ?>
        <?php echo $form->error($model, 'info'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->