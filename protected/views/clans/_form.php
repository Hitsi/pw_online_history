<?php
/* @var $this ClansController */
/* @var $model Clans */
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
            'height' => 400,
            'imageUpload' => $this->createUrl('imgUpload'),
            'imageUploadErrorCallback' => 'js:function(obj, json){ alert(json.error); }', // function to show upload error to user

            'fileUpload' => $this->createUrl('fileUpload'),
            'fileUploadErrorCallback' => 'js:function(obj, json){ alert(json.error); }',
        ),
    ));
    $this->widget('ext.EChosen.EChosen', array(
        'target' => 'select'));
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'clans-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    ?>

    <p class="note">Поля помечнные <span class="required">*</span> являются обязательными.</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'icon'); ?>
        <?php
        // Вывод уже загруженной картинки или изображения No_photo
        echo Clans::getIcon($model->id, $model->name, $model->image);
        ?>
        <br clear="all">
        <?php
        //Если картинка для данного товара загружена, предложить её удалить, отметив чекбокс
        if (isset($model->image) && file_exists(Yii::app()->basePath . '/../images/clans/' . $model->image)) {
            echo $form->checkBox($model, 'del_img', array('class' => 'span-1'));
            echo $form->labelEx($model, 'del_img', array('class' => 'span-2'));
        }
        ?> 
        <?php echo CHtml::activeFileField($model, 'icon'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'master'); ?>
        <?php echo $form->textField($model, 'master', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'master'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'marshal'); ?>
        <?php echo $form->textField($model, 'marshal', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'marshal'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'kh'); ?>
        <?php echo $form->dropDownList($model, 'kh', Lookup::items('KhExist')); ?>
        <?php echo $form->error($model, 'kh'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'site'); ?>
        <?php echo $form->textField($model, 'site', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'site'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'type'); ?>
        <?php echo $form->dropDownList($model, 'type', Lookup::items('ClanType')); ?>
        <?php echo $form->error($model, 'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'academ'); ?>
        <?php echo $form->dropDownList($model, 'academ', Clans::droplist(), array('empty' => 'Пусто')); ?>
        <?php echo $form->error($model, 'academ'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'videotype'); ?>
        <?php echo $form->dropDownList($model, 'videotype', Lookup::items('VideoLinkType'), array('empty' => 'Пусто')); ?>
        <?php echo $form->error($model, 'videotype'); ?>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model, 'video'); ?>
        <?php echo $form->textField($model, 'video', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'video'); ?>
    </div>
    <?php if(Yii::app()->authManager->isAssigned('admin',Yii::app()->user->id) or Yii::app()->authManager->isAssigned('moderator',Yii::app()->user->id)): ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'owner'); ?>
        <?php echo $form->dropDownList($model, 'owner', User::droplist(), array('options' => array(Yii::app()->getRequest()->getQuery("owner") => array('selected' => true)))); ?>
        <?php echo $form->error($model, 'owner'); ?>
    </div>
    <?php endif;?>
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