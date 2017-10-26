<?php
/* @var $this ResponceController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs = array(
    'Обратная связь',
);

$this->menu = array(
    array('label' => 'Написать сообщение', 'url' => array('index')),
    array('label' => 'Управление сообщениями', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Responce.admin",Yii::app()->user->id)),
);
?>

<h1>Обратная связь</h1>

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
            'width' => 600,
            'height' => 400,),
    ));
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'responce-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
            ));
    ?>
    <?php if (Yii::app()->user->hasFlash('responceSubmitted')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('responceSubmitted'); ?>
        </div>
    <?php else: ?>
    <p class="note">Поля помечнные <span class="required">*</span> являются обязательными.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'title'); ?>
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'nick'); ?>
        <?php echo $form->textField($model, 'nick', array('size' => 60, 'maxlength' => 128, 'value'=> Yii::app()->user->nick, 'readonly'=>true)); ?>
        <?php echo $form->error($model, 'nick'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'info'); ?>
        <?php echo $form->textArea($model, 'info', array('rows' => 6, 'cols' => 50, 'class' => 'redactor')); ?>
        <?php echo $form->error($model, 'info'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Написать'); ?>
    </div>
<?php endif;?>
    <?php $this->endWidget(); ?>

</div><!-- form -->
