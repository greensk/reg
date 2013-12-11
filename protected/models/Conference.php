<?php
// protected/models/Conference.php
/**
 * This is the model class for table "conference".
 *
 * The followings are the available columns in table 'conference':
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $created
 * @property integer $enabled
 * @property string $location
 * @property string $start_date
 * @property string $start_time
 *
 * The followings are the available model relations:
 * @property Member[] $members
 */
class Conference extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'conference';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('enabled', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('start_time', 'length', 'max'=>45),
			array('description, created, location, start_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, description, created, enabled, location, start_date, start_time', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * Связи между таблицами
	 * 
	 * @return array
	 */
	public function relations()
	{
		/*
		 * members — название связи (по нему мы будем обращаться к 
		 * связанным данным),
		 * self::HAS_MANY означает, что используется связь один ко 
		 * многим, одна сущность текущей модели соответствует множеству
		 * сущностей модели member,
		 * 'Member' — имя модели, на данные которой мы ссылаемся,
		 * 'conference_id' — поле в текущей модели, по которому осуществляется
		 * связывание
		 * 
		 */
		return array(
			'members' => array(self::HAS_MANY, 'Member', 'conference_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Название',
			'description' => 'Описание',
			'created' => 'Дата создания',
			'enabled' => 'Включено',
			'location' => 'Мето проведения',
			'start_date' => 'Дата начала',
			'start_time' => 'Время начала',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('created',$this->created,true);
		$criteria->compare('enabled',$this->enabled);
		$criteria->compare('location',$this->location,true);
		$criteria->compare('start_date',$this->start_date,true);
		$criteria->compare('start_time',$this->start_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Conference the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
