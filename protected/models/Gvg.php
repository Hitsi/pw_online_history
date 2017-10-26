<?php

/**
 * This is the model class for table "{{gvg}}".
 *
 * The followings are the available columns in table '{{gvg}}':
 * @property integer $id
 * @property string $datestart
 * @property string $dateend
 * @property integer $status
 */
class Gvg extends CActiveRecord {

    public $icon_before; // атрибут для хранения загружаемой картинки статьи
    public $del_img_before; // атрибут для удаления уже загруженной картинки
    public $icon_after; // атрибут для хранения загружаемой картинки статьи
    public $del_img_after; // атрибут для удаления уже загруженной картинки
    public $next_date;
    public $prev_date;
    public $verifyCode;

    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Gvg the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return '{{gvg}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('datestart, dateend', 'required'),
            array('datestart, dateend', 'type', 'type' => 'date', 'dateFormat' => 'yyyy-MM-dd'),
            array('datestart, dateend', 'unique'),
            array('del_img_before,del_img_after', 'boolean'),
            array('image_before, image_after', 'length', 'max' => 128),
            array('icon_before, icon_after', 'file',
                'types' => 'jpg, gif, png',
                'maxSize' => 800 * 800 * 3, // 5 MB
                'allowEmpty' => 'true',
                'tooLarge' => 'Файл весит больше 5 MB. Пожалуйста, загрузите файл меньшего размера.',
            ),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, datestart, dateend,battles,battleCount', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'battleCount' => array(self::STAT, 'Battle', 'gvgid'),
            'importantBattleCount' => array(self::STAT, 'Battle', 'gvgid',
                'condition' => 'important=' . Battle::IMPORTANT),
            'battles' => array(self::HAS_MANY, 'Battle', 'gvgid',
                'order' => 'territory'),
            'commentCount' => array(self::STAT, 'Comment', 'gvg_id'),
            'comments' => array(self::HAS_MANY, 'Comment', 'gvg_id',
                'order' => 'comments.create_time'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'datestart' => 'Начало',
            'dateend' => 'Конец',
            'battleCount' => 'Сражений',
            'importantBattleCount' => 'Важных сражений',
            'icon_before' => 'Карта до гвг',
            'del_img_before' => 'Удалить картинку?',
            'icon_after' => 'Карта после гвг',
            'del_img_after' => 'Удалить картинку?',
            'next_gvg' => 'Следующее гвг',
            'prev_gvg' => 'Предыдущее гвг',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search() {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('datestart', $this->datestart, true);
        $criteria->compare('dateend', $this->dateend, true);

        return new CActiveDataProvider($this, array(
                    'criteria' => $criteria,
                    'sort' => array(
                        'defaultOrder' => 'datestart DESC',
                    )
                ));
    }

    public function getUrl($datestart = "") {
        if (!empty($datestart)) {
            return Yii::app()->createUrl('gvg/view', array(
                        'datestart' => $datestart,
                    ));
        } else
            return Yii::app()->createUrl('gvg/view', array(
                        'datestart' => $this->datestart,
                    ));
    }

    private static $_items = array();

    public function droplist() {
        $models = self::model()->findAll(array(
            'order' => 'datestart DESC',
                ));
        foreach ($models as $model)
            self::$_items[$model->id] = $model->datestart;
        return self::$_items;
    }

    public function findRecentGvg($limit = 5) {
        return $this->findAll(array(
                    'order' => 'datestart DESC',
                    'limit' => $limit,
                ));
    }

    public function addComment($comment) {
        $comment->gvg_id = $this->id;
        return $comment->save();
    }

    protected function afterSave() {
        parent::afterSave();
        if (!empty($this->image_before)) {
            $fileName_before = $this->image_before;
            $file = Yii::app()->basePath . '/../images/gvg/' . $fileName_before;
            $image = new EasyImage($file);
            $image->resize(150, 150);
            $file_thumb = Yii::app()->basePath . '/../images/gvg/thumbs/' . $fileName_before;
            $image->save($file_thumb);
        }
        if (!empty($this->image_after)) {
            $fileName_after = $this->image_after;
            $file = Yii::app()->basePath . '/../images/gvg/' . $fileName_after;
            $image = new EasyImage($file);
            $image->resize(150, 150);
            $file_thumb = Yii::app()->basePath . '/../images/gvg/thumbs/' . $fileName_after;
            $image->save($file_thumb);
        }
    }

    public function getNextGvg($datestart) {
        $criteria = new CDbCriteria;
        $criteria->select = 'datestart';  // выбираем только поле 'title'
        $criteria->condition = 'datestart>:datestart';
        $criteria->order = 'datestart';
        $criteria->params = array(':datestart' => $datestart);
        if ($next_date = Gvg::model()->find($criteria))
            return $next_date->datestart;
        else
            return '';
    }

    public function getPrevGvg($datestart) {
        $criteria = new CDbCriteria;
        $criteria->select = 'datestart';  // выбираем только поле 'title'
        $criteria->condition = 'datestart<:datestart';
        $criteria->order = 'datestart DESC';
        $criteria->params = array(':datestart' => $datestart);
        if ($prev_date = Gvg::model()->find($criteria))
            return $prev_date->datestart;
        else
            return '';
    }

}