<?php
class UserIdentity extends CUserIdentity
{
    private $_id;
 
    public function authenticate()
    {
        $record = Users::model()->findByAttributes(array('mail' => $this->username));
        //var_export($record->firstName);
        //exit();
        if ($record === null) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        } else if ($record->password !== sha1($this->password.$record->salt)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        } else {
            $session = Yii::app()->session;
            $session->add('__name', $record->mail);
            //$this->setState('title', $record->firstName.' '.$record->lastName);
            //$this->setState('__name', $record->mail);
            //$this->setState('role', $record->role);
            //$this->setState('uid', $record->id);
            //$this->setState("__id", $record->id);
            $this->errorCode=self::ERROR_NONE;
        }
        /**
         * Передала email в сессию, которая хранится в таблице sessions
         * Добавила заглушку, так как авторизация пока не работает (раскомментируй ниже)
         * upd: Уже не нужно, исправила выше
         **/
         
        /*
        $session = Yii::app()->session;            // Обязательно получить текущую сессию
        $session->add('__name', $record->mail);    // add(), не setState()
        $this->setState('uid', $record->id);
        $this->setState("__id", $record->id);
        $this->errorCode=self::ERROR_NONE;
        */
        
        return !$this->errorCode;
    }
 
    public function getId()
    {
        return $this->_id;
    }
}