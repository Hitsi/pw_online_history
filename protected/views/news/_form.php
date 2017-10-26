<?php
/* @var $this NewsController */
/* @var $model News */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'news-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
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
            'paragraphy'=> false,
            'linebreaks'=> true,
            'fullpage' => true,
            'width' => 600,
            'height' => 400,
            'imageUpload' => $this->createUrl('imgUpload'),
            'imageUploadErrorCallback' => 'js:function(obj, json){ alert(json.error); }', // function to show upload error to user

            'fileUpload' => $this->createUrl('fileUpload'),
            'fileUploadErrorCallback' => 'js:function(obj, json){ alert(json.error); }',
        ),
    ));
    ?>

    <p class="note">Поля помечнные <span class="required">*</span> являются обязательными.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title'); ?>
        <?php echo $form->error($model, 'title'); ?>
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