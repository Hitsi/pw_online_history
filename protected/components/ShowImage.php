<?

class ShowImage {

    public function clans_image($id, $name, $image, $width = "16") {
        
        if (isset($image) && !empty($image) && file_exists(Yii::app()->basePath . "/../images/clans/" . $image))
            return CHtml::image(Yii::app()->getBaseUrl(true) . "/images/clans/" . $image, $name, array(
                        "width" => $width,
                    ));
        else
            return CHtml::image(Yii::app()->getBaseUrl(true) . "/images/noclan.gif", "Нет картинки", array(
                        "width" => $width,
                    ));

    }

}

?>