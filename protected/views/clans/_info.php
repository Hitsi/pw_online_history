
<?php

$this->widget('zii.widgets.CDetailView', array(
    'data' => $model,
    'attributes' => array(
        array(
            'type' => 'raw',
            'name' => 'name',
            'value' => Clans::getIcon($model->id, $model->name, $model->image) . "&nbsp;" . $model->name,
        ),
        'master',
        'marshal',
        array(
            'type' => 'raw',
            'name' => 'kh',
            'value' => Lookup::item('KhExist', $model->kh),
        ),
        array(
            'type' => 'raw',
            'name' => 'site',
            'value' => CHtml::link(CHtml::encode($model->site), $model->site, array('target' => '_blank')),
        ),
        array(
            'type' => 'raw',
            'name' => 'type',
            'value' => Lookup::item('ClanType', $model->type),
        ),
        array(
            'type' => 'raw',
            'name' => 'academ',
            'value' => $model->academ_info == null ? "Без второго состава" : CHtml::link(CHtml::encode($model->academ_info->name), Clans::getUrl($model->academ_info->id, $model->academ_info->name)),
        ),
        array(
            'type' => 'raw',
            'name' => 'video',
            'value' => CHtml::link(CHtml::encode($model->video), $model->video, array('target' => '_blank')),
        ),
    ),
));
?>
