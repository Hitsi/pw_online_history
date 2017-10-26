<?php
/* @var $this CommentController */
/* @var $model Comment */
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
            'height' => 400,
        ),
    ));
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'comment-form',
        'enableAjaxValidation' => true,
            ));
    ?>

    <p class="note">Поля помечнные <span class="required">*</span> являются обязательными.</p>

    <?php echo $form->errorSummary($model); ?>
<!--
    <div class="row">
        <?php echo $form->labelEx($model, 'authorId'); ?>
        <?php echo $form->dropDownList($model, 'authorId', User::droplist(), array('options' => array(Yii::app()->getRequest()->getQuery("authorId") => array('selected' => true)))); ?>
        <?php echo $form->error($model, 'authorId'); ?>
    </div>
-->
    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php echo $form->textArea($model, 'content', array('rows' => 6, 'class' => 'redactor')); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>
    <?php if (CCaptcha::checkRequirements() and !Yii::app()->user->id): ?>
        <div class="row">
            <?php echo $form->labelEx($model, 'verifyCode'); ?>
            <div>
                <?php $this->widget('CCaptcha'); ?>
                <?php echo $form->textField($model, 'verifyCode'); ?>
            </div>
            <div class="hint">Пожалуйста введите символы которые указаны на картинке.
                <br/>Символы регистронезависимые.</div>
            <?php echo $form->error($model, 'verifyCode'); ?>
        </div>
    <?php endif; ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Написать' : 'Сохранить'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->