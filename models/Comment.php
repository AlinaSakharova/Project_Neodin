<?php

/**
 * This is the model class for table "db_comment".
 *
 * The followings are the available columns in table 'db_comment':
 * @property integer $id
 * @property integer $id_topic
 * @property string $content
 * @property integer $id_author
 * @property string $public_date
 *
 * The followings are the available model relations:
 * @property Topic $idTopic
 * @property Users $idAuthor
 */
class Comment extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'db_comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id_topic, id_author', 'required'),
			array('id_topic, id_author', 'numerical', 'integerOnly'=>true),
			array('content', 'length', 'max'=>2000),
			array('public_date', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, id_topic, content, id_author, public_date', 'safe', 'on'=>'search'),
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
			'idTopic' => array(self::BELONGS_TO, 'Topic', 'id_topic'),
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
			'id_topic' => 'Id Topic',
			'content' => 'Content',
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
		$criteria->compare('id_topic',$this->id_topic);
		$criteria->compare('content',$this->content,true);
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
	 * @return Comment the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
