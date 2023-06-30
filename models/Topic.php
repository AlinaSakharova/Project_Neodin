<?php

/**
 * This is the model class for table "db_topic".
 *
 * The followings are the available columns in table 'db_topic':
 * @property integer $id
 * @property integer $id_forum
 * @property string $title
 * @property integer $id_category
 * @property integer $id_author
 * @property string $public_date
 *
 * The followings are the available model relations:
 * @property Comment[] $Comments
 * @property Forum $idForum
 * @property CategoryTop $idCategory
 * @property Users $idAuthor
 */
class Topic extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'db_topic';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_forum, id_author', 'required'),
			array('id_forum, id_category, id_author', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('public_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_forum, title, id_category, id_author, public_date', 'safe', 'on'=>'search'),
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
			'Comments' => array(self::HAS_MANY, 'Comment', 'id_topic'),
			'idForum' => array(self::BELONGS_TO, 'Forum', 'id_forum'),
			'idCategory' => array(self::BELONGS_TO, 'CategoryTop', 'id_category'),
			'idAuthor' => array(self::BELONGS_TO, 'Users', 'id_author'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'id_forum' => 'Id Forum',
			'title' => 'Title',
			'id_category' => 'Id Category',
			'id_author' => 'Id Author',
			'public_date' => 'Public Date',
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
		$criteria->compare('id_forum',$this->id_forum);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('id_category',$this->id_category);
		$criteria->compare('id_author',$this->id_author);
		$criteria->compare('public_date',$this->public_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Topic the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
