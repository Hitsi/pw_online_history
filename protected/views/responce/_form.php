<?php
/* @var $this ResponceController */
/* @var $model Responce */
/* @var $form CActiveForm */
?>

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

    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'responce-form',
        'enableAjaxValidation' => false,
            ));
    ?>

    <p class="note">Поля помечнные <span class="required">*</span> являются обязательными.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'nick'); ?>
        <?php echo $form->textField($model, 'nick', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'nick'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'info'); ?>
        <?php echo $form->textArea($model, 'info', array('rows' => 6, 'cols' => 50, 'class' => 'redactor')); ?>
        <?php echo $form->error($model, 'info'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', Lookup::items('ResponceStatus')); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->