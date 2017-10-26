<?php

Yii::import('zii.widgets.CPortlet');

class RecentVideo extends CPortlet {

    public $title = 'Последние видео';
    public $maxVideos = 5;

    public function getRecentVideo() {
        return Video::model()->findRecentVideo($this->maxVideos);
    }

    protected function renderContent() {
        $this->render('recentVideo');
    }

}

?>