<?php

/**
 * This is the model class for table "db_user_request".
 *
 * The followings are the available columns in table 'db_user_request':
 * @property integer $id
 * @property integer $IDuser
 * @property integer $IDrequest
 * @property string $comment
 * @property string $dateOfComment
 *
 * The followings are the available model relations:
 * @property Request $iDrequest
 * @property Users $iDuser
 */
class UserRequest extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'db_user_request';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('IDuser, IDrequest, comment, dateOfComment', 'required'),
			array('IDuser, IDrequest', 'numerical', 'integerOnly'=>true),
			array('comment', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, IDuser, IDrequest, comment, dateOfComment', 'safe', 'on'=>'search'),
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
			'iDrequest' => array(self::BELONGS_TO, 'Request', 'IDrequest'),
			'iDuser' => array(self::BELONGS_TO, 'Users', 'IDuser'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'IDuser' => 'Iduser',
			'IDrequest' => 'Idrequest',
			'comment' => 'Comment',
			'dateOfComment' => 'Date Of Comment',
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
		$criteria->compare('IDuser',$this->IDuser);
		$criteria->compare('IDrequest',$this->IDrequest);
		$criteria->compare('comment',$this->comment,true);
		$criteria->compare('dateOfComment',$this->dateOfComment,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return UserRequest the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
