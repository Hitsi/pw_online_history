<?php
/* @var $this GvgController */
/* @var $model Gvg */

$this->breadcrumbs = array(
    'ГВГ' => array('index'),
    Yii::app()->dateFormatter->format("dd-MM-y ",$model->datestart),
);

    $this->menu = array(
        array('label' => 'Список гвг', 'url' => array('index')),
        array('label' => 'Создать гвг', 'url' => array('create'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Gvg.create",Yii::app()->user->id)),
        array('label' => 'Обновить гвг', 'url' => array('update', 'datestart' => $model->datestart), 'visible' => Yii::app()->getAuthManager()->checkAccess("Gvg.update",Yii::app()->user->id)),
        array('label' => 'Удалить гвг', 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'datestart' => $model->datestart), 'confirm' => 'Вы уверены что хотите удалить?'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Gvg.delete",Yii::app()->user->id)),
        array('label' => 'Управление гвг', 'url' => array('admin'), 'visible' => Yii::app()->getAuthManager()->checkAccess("Gvg.admin",Yii::app()->user->id)),
        array('label' => 'Добавить сражение', 'url' => array('battle/create', 'battleid' => $model->id), 'visible' => Yii::app()->getAuthManager()->checkAccess("Battle.create",Yii::app()->user->id)),
        array('label' => 'Управление комментариями', 'url' => array('comment/admin', 'gvgid' => $model->id), 'visible' => Yii::app()->getAuthManager()->checkAccess("Comment.admin",Yii::app()->user->id)),
    );
?>

<h1>ГВГ с <?php echo Yii::app()->dateFormatter->format("dd-MM-y ",$model->datestart); ?> по <?php echo Yii::app()->dateFormatter->format("dd-MM-y ",$model->dateend); ?></h1>


<?php
$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array (
            'type'=>'raw',
            'name'=>'datestart',
            'value'=>Yii::app()->dateFormatter->format("dd-MM-y ",$model->datestart),
        ),
        array (
            'type'=>'raw',
            'name'=>'dateend',
            'value'=>Yii::app()->dateFormatter->format("dd-MM-y ",$model->dateend),
        ),
        'battleCount',
        'importantBattleCount',
        array(
            'type'=>'raw',
            'name'=>'next_gvg',
            'value'=>$next_gvg==''?'':CHtml::link(Yii::app()->dateFormatter->format("dd-MM-y ",$next_gvg),Gvg::getUrl($next_gvg)),
        ),
        array(
            'type'=>'raw',
            'name'=>'prev_gvg',
            'value'=>$prev_gvg==''?'':CHtml::link(Yii::app()->dateFormatter->format("dd-MM-y ",$prev_gvg),Gvg::getUrl($prev_gvg)),
        ),
    ),
));
?>
<br />
<div id="battles">
    <?php if ($model->battleCount >= 1): ?>
        <h3>
            <?php echo 'Сражения (' . $model->battleCount . ')'; ?>
        </h3>
        * - отмечены важные сражения
        <?php
        $dataProvider = new CActiveDataProvider('Battle', array(
                    'criteria' => array(
                        'condition' => 'gvgid=' . $model->id,
                        'order' => 'territory'
                    ),
            'pagination'=>array(
        'pageSize'=>20,
    ),
                ));
        $this->widget('zii.widgets.grid.CGridView', array(
            'id' => 'battle-grid',
            'dataProvider' => $dataProvider,
            'columns' => array(
                array(
                    'type' => 'html',
                    'name' => 'territory',
                    'value' => '$data->important==1?CHtml::encode($data->territory)."*":CHtml::encode($data->territory)',
                ),
                array(
                    'type' => 'html',
                    'name' => 'datestart',
                    'value' => 'CHtml::link(CHtml::encode(Yii::app()->dateFormatter->format("EEEE d MMMM yyyy HH:mm", $data->datestart." ".$data->timestart)), Battle::geturl($data->id,$data->datestart,$data->clan_defend->name,$data->clan_atack->name))',
                ),
                array(
                    'type' => 'html',
                    'name' => 'defend',
                    'value' => 'Clans::getIcon($data->clan_defend->id, $data->clan_defend->name, $data->clan_defend->image).CHtml::link(CHtml::encode($data->clan_defend->name), Clans::getGvgurl($data->clan_defend->id,$data->clan_defend->name))',
                ),
                array(
                    'type' => 'html',
                    'name' => 'atack',
                    'value' => 'Clans::getIcon($data->clan_atack->id, $data->clan_atack->name, $data->clan_atack->image).CHtml::link(CHtml::encode($data->clan_atack->name), Clans::getGvgurl($data->clan_atack->id,$data->clan_atack->name))',
                ),
                array(
                    'type' => 'html',
                    'name' => 'winner',
                    'value' => '$data->clan_winner==null?"":Clans::getIcon($data->clan_winner->id, $data->clan_winner->name, $data->clan_winner->image).CHtml::link(CHtml::encode($data->clan_winner->name), Clans::getGvgurl($data->clan_winner->id,$data->clan_winner->name))',
                ),
                array(
                    'type' => 'html',
                    'name' => 'videos',
                    'value' => 'Video::videoname($data->id)',
                ),
            ),
        ));
        ?>

    <?php endif; ?>
    <?php
    $this->widget('ext.SliderPopImage.SliderPopImage', array(
        'selectorImgPop' => '.thumbsgen',
        'popupwithpaginate' => true,
        'maxpopuwidth' => '$(window).width()*0.8',
        //'postfixThumb' => '',
        'relPathThumbs' => 'thumbs',
        //'relPathThumbs' => array('thumbsTiny', 'thumbsMedium') //only version 1.1
    ));
    ?>

</div><!-- battles -->
<div id="maps">

    <div class="img-desc">

        <?php 
        if (isset($model->image_before) && !empty($model->image_before) && Yii::app()->request->baseUrl . '/images/gvg/thumbs/'.$model->image_before) {
        echo CHtml::image(Yii::app()->request->baseUrl . '/images/gvg/thumbs/'.$model->image_before, 'до гвг',array('class'=>'thumbsgen'));
        }
        else echo CHtml::image(Yii::app()->request->baseUrl . '/images/gvg/thumbs/noimage.png', 'до гвг',array('class'=>'thumbsgen'));
        ?>
        <cite>Карта до гвг</cite>

    </div>
    <div class="img-desc">

        <?php 
        if (isset($model->image_after) && !empty($model->image_after) && file_exists(Yii::app()->basePath . '/../images/gvg/' . $model->image_after)) {
        echo CHtml::image(Yii::app()->request->baseUrl . '/images/gvg/thumbs/'.$model->image_after, 'до гвг',array('class'=>'thumbsgen'));
        }
        else echo CHtml::image(Yii::app()->request->baseUrl . '/images/gvg/thumbs/noimage.png', 'до гвг',array('class'=>'thumbsgen')); ?>
        <cite>Карта после гвг</cite>
    </div>
</div>


<div id="comments">

    <?php if ($model->commentCount >= 1): ?>
        <h3>
            <?php echo 'Комментариев: '.$model->commentCount ; ?>
        </h3>

        <?php
        $this->renderPartial('_comments', array(
            'gvg' => $model,
            'comments' => $model->comments,
        ));
        ?>
    <?php endif; ?>
    
    <h3>Оставить комментарий</h3>

    <?php if (Yii::app()->user->hasFlash('commentSubmitted')): ?>
        <div class="flash-success">
            <?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
        </div>
    <?php else: ?>
        <?php
        $this->renderPartial('/comment/_form', array(
            'model' => $comment,
        ));
        ?>
    <?php endif; ?>
</div>