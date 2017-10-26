<?php
/* @var $this VideoController */
/* @var $model Video */
/* @var $form CActiveForm */
?>
<style> select { width: 400px } </style>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'video-form',
        'enableAjaxValidation' => false,
            ));
    $this->widget('ext.EChosen.EChosen', array(
        'target' => 'select'));
    ?>

    <p class="note">Поля помечнные <span class="required">*</span> являются обязательными.</p>

    <?php echo $form->errorSummary($model); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 120)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'frapserid'); ?>
        <?php echo $form->dropDownList($model, 'frapserid', Frapser::droplist(true)); ?>
        <?php echo $form->error($model, 'frapserid'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'clan'); ?>
        <?php echo $form->dropDownList($model, 'clan', Clans::droplist()); ?>
        <?php echo $form->error($model, 'clan'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'type'); ?>
        <?php echo $form->dropDownList($model, 'type', Lookup::items('VideoType')); ?>
        <?php echo $form->error($model, 'type'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'linktype'); ?>
        <?php echo $form->dropDownList($model, 'linktype', Lookup::items('VideoLinkType')); ?>
        <?php echo $form->error($model, 'linktype'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'link'); ?>
        <?php echo $form->textField($model, 'link', array('size' => 60, 'maxlength' => 120)); ?>
        <?php echo $form->error($model, 'link'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'class'); ?>
        <?php echo $form->dropDownList($model, 'class', Lookup::items('PlayerClassName')); ?>
        <?php echo $form->error($model, 'class'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'battleid'); ?>
        <?php echo $form->dropDownList($model, 'battleid', Battle::droplist(), array('empty' => 'Пусто', 'options' => array(Yii::app()->getRequest()->getQuery("battleid") => array('selected' => true)))); ?>
        <?php echo $form->error($model, 'battleid'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->