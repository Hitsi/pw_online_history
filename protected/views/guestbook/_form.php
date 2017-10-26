<?php
/* @var $this GuestbookController */
/* @var $model Guestbook */
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
        'id' => 'guestbook-form',
        'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    ));
?>

    <p class="note">Поля помечнные <span class="required">*</span> являются обязательными.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'author'); ?>
        <?php if (Yii::app()->user->id > 0 and $model->isNewRecord):?>
		<?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>128,'value' =>Yii::app()->user->nick ,'readonly'=>true)); ?>
        <?php elseif (Yii::app()->user->id > 0):?>
        <?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>128,'value' =>$model->author ,'readonly'=>true)); ?>
        <?php else:?>
        <?php echo $form->textField($model,'author',array('size'=>60,'maxlength'=>128)); ?>
        <?php endif;?>
		<?php echo $form->error($model,'author'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content', array('rows' => 6, 'class' => 'redactor')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

    <?php if (Yii::app()->user->id==0): ?>
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