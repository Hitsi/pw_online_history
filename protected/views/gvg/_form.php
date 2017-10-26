<?php
/* @var $this GvgController */
/* @var $model Gvg */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'gvg-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
    Yii::import('application.extensions.CJuiDateTimePicker.CJuiDateTimePicker');
    $this->widget('ext.SliderPopImage.SliderPopImage', array(
        'selectorImgPop' => '.thumbsgen',
        'popupwithpaginate' => true,
        'maxpopuwidth' => '$(window).width()*0.8',
        //'postfixThumb' => '',
        'relPathThumbs' => 'thumbs',
        //'relPathThumbs' => array('thumbsTiny', 'thumbsMedium') //only version 1.1
    ));
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
        <?php echo $form->labelEx($model, 'dateend'); ?>
        <?php
        $this->widget('CJuiDateTimePicker', array(
            'model' => $model, //Model object
            'attribute' => 'dateend', //attribute name
            'mode' => 'date', //use "time","date" or "datetime" (default)
            'options' => array(
                'dateFormat' => "yy-mm-dd",
            ) // jquery plugin options
        ));
        ?>
        <?php echo $form->error($model, 'dateend'); ?>
    </div>

    <div class="row ">
        <?php echo $form->labelEx($model, 'icon_before'); ?>
        <?php
        // Вывод уже загруженной картинки или изображения No_photo
        if (isset($model->image_before) && !empty($model->image_after) && file_exists(Yii::app()->basePath . '/../images/gvg/' . $model->image_before)) {
        echo CHtml::image(Yii::app()->request->baseUrl . '/images/gvg/thumbs/'.$model->image_before, 'до гвг',array('class'=>'thumbsgen'));
        }
        else echo CHtml::image(Yii::app()->request->baseUrl . '/images/gvg/thumbs/noimage.png', 'до гвг',array('class'=>'thumbsgen'));
        ?>
        <br clear="all">
        <?php
        //Если картинка для данного товара загружена, предложить её удалить, отметив чекбокс
        if (isset($model->image_before) && !empty($model->image_after) && file_exists(Yii::app()->basePath . '/../images/gvg/' . $model->image_before)) {
            echo $form->checkBox($model, 'del_img_before', array('class' => 'span-1'));
            echo $form->labelEx($model, 'del_img_before', array('class' => 'span-2'));
        }
        ?> 
        <br />
        <?php
        //Поле загрузки файла
        echo CHtml::activeFileField($model, 'icon_before');
        ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'icon_after'); ?>
        <?php
        // Вывод уже загруженной картинки или изображения No_photo
        if (isset($model->image_after) && !empty($model->image_after) && file_exists(Yii::app()->basePath . '/../images/gvg/' . $model->image_after)) {
        echo CHtml::image(Yii::app()->request->baseUrl . '/images/gvg/thumbs/'.$model->image_after, 'до гвг',array('class'=>'thumbsgen'));
        }
        else echo CHtml::image(Yii::app()->request->baseUrl . '/images/gvg/thumbs/noimage.png', 'до гвг',array('class'=>'thumbsgen'));
        ?>
        <br clear="all">
        <?php
        //Если картинка для данного товара загружена, предложить её удалить, отметив чекбокс
        if (isset($model->image_after) && !empty($model->image_after) && file_exists(Yii::app()->basePath . '/../images/gvg/' . $model->image_after)) {
            echo $form->checkBox($model, 'del_img_after', array('class' => 'span-1'));
            echo $form->labelEx($model, 'del_img_after', array('class' => 'span-2'));
        }
        ?> 
        <br />
<?php
//Поле загрузки файла
echo CHtml::activeFileField($model, 'icon_after');
?>
    </div>

    <div class="row buttons">
<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->