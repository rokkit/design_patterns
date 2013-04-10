<?php
class User {
	protected $id;
	protected $username;
	protected $avatar;
	
	public function loadUserProfile() {
		$api = ApiFactory::getApi();
		$api->getProfile($this);
		return $this;
	}
	
	public function _echo() {
		echo $this->id.' '.$this->username.' '.$this->avatar.'<br/>';
	}

	public function setavatar($avatar) {
		$this->avatar = $avatar;
	}

	public function getavatar() {
		return $this->avatar;
	}

	public function setid($id) {
		$this->id = $id;
	}

	public function getid() {
		return $this->id;
	}

	public function setusername($username) {
		$this->username = $username;
	}

	public function getusername() {
		return $this->username;
	}
}

interface APIadapter {
	function getProfile(User $user);
	function killUser($user_id);
}

class VKApi implements APIadapter {
	public function getProfile(User $user) {
		// Делаем обращение к API VK.COM и получаем массив с данными пользователя
		$data = array('id_vkontakte'		=> 123,
					 'nickname'	=> 'ivan',
					 'ava'	=> 'http://cs123.vkontakte.ru/asdas/asdas.jpg',
					 );
		$user->setavatar($data['ava']);
		$user->setid($data['id_vkontakte']);
		$user->setusername($data['nickname']);
	}

	public function killUser($user_id) {
		return file_get_contents('http://vk.com/api/?method=killuser&id_vkontakte='.$user_id);
	}
	
	private static $_instance = null;
	
	public static function getSingletonInstanse() {
		if (empty(self::$_instance)) {
			self::$_instance = new VKApi();
		}
		return self::$_instance;
	}
}

class OKApi implements APIadapter {
	public function getProfile(User $user) {
		$data = array('ID'		=> 123123123,
					 'username'	=> 'ivan',
					 'avatar_big'	=> 'http://c1.odnoklassniki.ru/asdas/asdas.jpg',
					 );
		$user->setavatar($data['avatar_big']);
		$user->setid($data['ID']);
		$user->setusername($data['username']);
	}
	
	private static $_instance = null;

	public function killUser($user_id) {
		return file_get_contents('http://ok.com/rest/api/?method=kill&uid='.$user_id);
	}
	
	public static function getSingletonInstanse() {
		if (empty(self::$_instance)) {
			self::$_instance = new OKApi();
		}
		return self::$_instance;
	}
}

abstract class ApiFactory {
	public static function getApi() {
		$suffix = isset($_REQUEST['fx']) ? $_REQUEST['fx'] : '';
		switch ($suffix) {
			case 'ok' : return OKApi::getSingletonInstanse();
			case 'vk' : return VKApi::getSingletonInstanse();
		}
		die('NO SUFFIX');
	}
}


$u = new User();
$u->loadUserProfile();
$u->_echo();










