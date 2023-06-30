<?php
class ForgotModel extends CActiveRecord
{
    public function tableName()
	{
		return 'db_users_token';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(	
            array('mail', 'filter', 'filter' => 'trim'),
            array('token', 'length', 'max'=>150),
			array('mail', 'required'),
			array('mail', 'length', 'max'=>45),
			array('mail', 'unique'),
			array('mail', 'email'),
			array('mail', 'length', 'max'=>32),
			array('id,  token', 'safe', 'on'=>'search'),
		
		);
	
		
	}
	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'mail' => 'Электронная почта',
			'token' => 'Token',
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
		$criteria->compare('mail',$this->mail,true);
		$criteria->compare('token',$this->token,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Users the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
