<?php

/**
 * This is the model class for table "member".
 *
 * The followings are the available columns in table 'member':
 * @property integer $id
 * @property string $last_name
 * @property string $first_name
 * @property string $phone
 * @property string $email
 * @property integer $conference_id
 * @property string $reg_date
 *
 * The followings are the available model relations:
 * @property Conference $conference
 */
class Member extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'member';
	}

	/**
	 * @return array правила валидации атрибутов
	 */
	public function rules()
	{
		/*
		 * Метод должен возвращать массив с правилами валидации
		 * данных об участнике конференции.
		 * 
		 * Массив должен состоять из элементов, каждый из которых
		 * соответствует одному правилу валилации. Каждый из них
		 * в свою очередь также явялется массивом. Первый элемент —
		 * название поля, валидация которого производится. Второй
		 * элемент — наименование правила валидации.
		 * Далее, в зависимости от правила, могут идти еще 
		 * дополнительные аргументы.
		 * 
		 * Обратите внимание: если нужно создать правило для нескольких
		 * полей, в качестве первого элемента указывается одна строка,
		 * в которой названия полей перечислены через запятую. 
		 */
		return array(
			/*
			 * Обязательные для заполнения поля.
			 * 
			 */
			array('last_name, first_name, email, conference_id', 'required', 
				'message' => 'Поле обязательно для заполнения'),
			
			/*
			 * Указываем, что поле conference_id должно указывать
			 * на существующую запись в таблице conference.
			 * className — имя класса той модели, на которую ссылаемся,
			 * attributeName — имя атрибута, значению которого должно
			 * соответствовать значение conference_id. В данном
			 * случае conference_id -> Conference.id.
			 */
			array('conference_id', 'exist', 'className' => 'Conference', 
				'attributeName' => 'id'),
				
			/*
			 * Ограничение на максимальную длину значений.
			 * 
			 */
			array('last_name, first_name, phone, email', 
				'length', 'max'=>45),
			
			/*
			 * Проверка, что значение является корректным e-mail адресом.
			 * 
			 */
			array('email', 'email'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'conference' => array(self::BELONGS_TO, 'Conference', 'conference_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'last_name' => 'Фамилия',
			'first_name' => 'Имя',
			'phone' => 'Телефон',
			'email' => 'E-mail',
			'conference_id' => 'Мероприятие',
			'reg_date' => 'Дата регистрации',
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
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('conference_id',$this->conference_id);
		$criteria->compare('reg_date',$this->reg_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Member the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
