<?php
/* @var $this BattleController */
/* @var $model Battle */
/* @var $form CActiveForm */
?>
<style> select { width: 200px } </style>
<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'battle-form',
        'enableAjaxValidation' => false,
            ));
    Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
    $this->widget('ext.EChosen.EChosen', array(
        'target' => 'select'));
    ?>

    <p class="note">Поля помечнные <span class="required">*</span> являются обязательными.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'datestart'); ?>
        <?php
        $this->widget('CJuiDateTimePicker', array(
            'model' => $model, //Model object
            'attribute' => 'datestart', //attribute name
            'mode' => 'date', //use "time","date" or "datetime" (default)
            'options' => array('dateFormat' => "yy-mm-dd",) // jquery plugin options
        ));
        ?>
        <?php echo $form->error($model, 'datestart'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'timestart'); ?>
        <?php
        $this->widget('CJuiDateTimePicker', array(
            'model' => $model, //Model object
            'attribute' => 'timestart', //attribute name
            'mode' => 'time', //use "time","date" or "datetime" (default)
            'options' => array('timeFormat' => "hh:mm:ss",) // jquery plugin options
        ));
        ?>
        <?php echo $form->error($model, 'timestart'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'defend'); ?>
        <?php echo $form->dropDownList($model, 'defend', Clans::droplist()); ?>
        <?php echo $form->error($model, 'defend'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'atack'); ?>
        <?php echo $form->dropDownList($model, 'atack', Clans::droplist()); ?>
        <?php echo $form->error($model, 'atack'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'winner'); ?>
        <?php echo $form->dropDownList($model, 'winner', Clans::droplist(), array('empty' => 'Пусто')); ?>
        <?php echo $form->error($model, 'winner'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'gvgid'); ?>
        <?php echo $form->dropDownList($model, 'gvgid', Gvg::droplist(), array('options' => array(Yii::app()->getRequest()->getQuery("battleid") => array('selected' => true)))); ?>
        <?php echo $form->error($model, 'gvgid'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'territory'); ?>
        <?php echo $form->textField($model, 'territory'); ?>
        <?php echo $form->error($model, 'territory'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'important'); ?>
        <?php echo $form->dropDownList($model, 'important', Lookup::items('Important')); ?>
        <?php echo $form->error($model, 'important'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>
</div><!-- form -->