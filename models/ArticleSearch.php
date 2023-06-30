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
		return 'db_article';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, content, id_author, id_status, id_category_article', 'required'),
			array('id_author, id_status, id_category_article', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('dates_temp', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, content, id_author, dates_temp, id_status, id_category_article', 'safe', 'on'=>'search'),
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
			'idCategoryArticle' => array(self::BELONGS_TO, 'Category', 'id_category_article'),
			'idAuthor' => array(self::BELONGS_TO, 'Users', 'id_author'),
			'idStatus' => array(self::BELONGS_TO, 'StatusArticle', 'id_status'),
			'Moderations' => array(self::HAS_MANY, 'Moderation', 'id_article'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => 'Title',
			'content' => 'Content',
			'id_author' => 'Id Author',
			'dates_temp' => 'Dates Temp',
			'id_status' => 'Id Status',
			'id_category_article' => 'Id Category Article',
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
		$criteria->compare('title',$this->title);
		$criteria->compare('content',$this->content);
		$criteria->compare('id_author',$this->id_author,true);
		$criteria->compare('dates_temp',$this->dates_temp,true);
		$criteria->compare('id_status',$this->id_status);
		$criteria->compare('id_category_article',$this->id_category_article,true);
		$criteria->compare('type',$this->type,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return ArticleSearch the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
