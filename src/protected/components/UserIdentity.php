<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$model = Users::model()->find('uid=:uid AND passwd=PASSWORD(:passwd)', array(
			':uid'=>$this->username,
			':passwd'=>$this->password,
		));
		if (is_null($model)) {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		} else {
			$this->errorCode=self::ERROR_NONE;
			/* $model->tstamp = strftime('%F %T'); */
                        $model->tstamp = date('Y-m-d H:i:s');
			$model->save();
		}
		return !$this->errorCode;
	}
}
