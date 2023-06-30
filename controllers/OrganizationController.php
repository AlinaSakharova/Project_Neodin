<?php

class OrganizationController extends Controller
{
	
	public function actionOrganization()
	{
	
		$id_author=Users::model()->findAll();
        $organization=Organization::model()->findAll();
		//var_export($type);
		//exit();
		$psy_org= Yii::app()->db->createCommand()
			->select('a.id, a.name, a.info, a.phone, a.address, a.date_edit, a.site, a.type')
       		->from('db_organization a')
			->where('type = "1"')
			->leftJoin('db_users s', ' s.id = a.id_author')
       		->queryAll();

		$leg_org= Yii::app()->db->createCommand()
		->select('a.id, a.name, a.info, a.phone, a.address, a.date_edit, a.site, a.type')
		->from('db_organization a')
		->where('type = "2"')
		->leftJoin('db_users s', ' s.id = a.id_author')
		->queryAll();
		//var_export($psy_org);
		//exit();

		$this->render('/organization/organization',array('id' => $id_author, 'organization'=> $organization, 'psy_org'=> $psy_org, 'leg_org'=> $leg_org));
		
	}
}