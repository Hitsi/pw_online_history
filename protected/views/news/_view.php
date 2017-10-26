<?php
/* @var $this NewsController */
/* @var $data News */
?>

<div class="news">
    <div class="title">
        <?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id' => $data->id, 'title' => $data->title)); ?>
    </div>
    <div class="author">
        размещено <?php echo Yii::app()->dateFormatter->format("EEEE d MMMM yyyy HH:mm", $data->date); ?>
    </div>
    <div class="content">
        <?php
        $this->beginWidget('CMarkdown', array('purifyOutput' => true));
        echo $data->info;
        $this->endWidget();
        ?>
    </div>
</div>