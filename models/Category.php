<?php

/**
 * This is the model class for table "db_category".
 *
 * The followings are the available columns in table 'db_category':
 * @property integer $id
 * @property string $priority
 * @property string $category_name
 * @property integer $id_author
 * @property string $date_edit
 *
 * The followings are the available model relations:
 * @property Article[] $Articles
 * @property Users $idAuthor
 * @property Request[] $Requests
 */
class Category extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'db_category';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('priority, category_name', 'required'),
			array('id_author', 'numerical', 'integerOnly'=>true),
			array('priority', 'length', 'max'=>14),
			array('category_name', 'length', 'max'=>30),
			array('date_edit', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, priority, category_name, id_author, date_edit', 'safe', 'on'=>'search'),
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
			'Articles' => array(self::HAS_MANY, 'Article', 'id_category_article'),
			'idAuthor' => array(self::BELONGS_TO, 'Users', 'id_author'),
			'Requests' => array(self::HAS_MANY, 'Request', 'id_category'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'priority' => 'Priority',
			'category_name' => 'Category Name',
			'id_author' => 'Id Author',
			'date_edit' => 'Date Edit',
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
		$criteria->compare('priority',$this->priority,true);
		$criteria->compare('category_name',$this->category_name,true);
		$criteria->compare('id_author',$this->id_author);
		$criteria->compare('date_edit',$this->date_edit,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Category the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
