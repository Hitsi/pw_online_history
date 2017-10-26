<?php
/* @var $this BattleController */
/* @var $model Battle */
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
        <?php echo $form->label($model, 'datestart'); ?>
        <?php echo $form->textField($model, 'datestart'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'timestart'); ?>
        <?php echo $form->textField($model, 'timestart'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'defend'); ?>
        <?php echo $form->textField($model, 'defend'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'atack'); ?>
        <?php echo $form->textField($model, 'atack'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'winner'); ?>
        <?php echo $form->textField($model, 'winner'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'gvgid'); ?>
        <?php echo $form->textField($model, 'gvgid'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'territory'); ?>
        <?php echo $form->textField($model, 'territory'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model, 'important'); ?>
        <?php echo $form->textField($model, 'important'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Search'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- search-form -->