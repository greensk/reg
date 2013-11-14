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
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		return array(
			// Обязательные для заполнения поля
			array('last_name, first_name, phone, email, conference_id', 'required',
				'message' => 'Не забудьте заполнить поле'),
			// Проверить, что есть конференция с соответствующим id
			array('conference_id', 'exist', 
					'className' => 'Conference', //
					'attributeName' => 'id', // Конференцию ищем по id
					'allowEmpty' => false, // Поле не должно быть пустым
				),
			// Ограничение на максимальную длину текстового поля
			array('last_name, first_name, phone, email', 'length', 'max'=>45),
			// Поля, используемые для поиска
			array('id, last_name, first_name, phone, email, conference_id, reg_date', 
				'safe', 'on'=>'search'),
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
			'phone' => 'Номер телефона',
			'email' => 'E-mail',
			'conference_id' => 'Конференция',
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
