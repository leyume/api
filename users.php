<?php  


namespace Models {
	
	class User {
		
		public $name = 'Chux';

		function __construct() {
			$user = (object) array();
			$user->name = 'L eye';
			$user->email = 'li@one.com';
			return $user;
		}
	}
	
	class APIKey {
		// public $user;
		function __construct() {
			return 1;
		}

		public static function verifyKey($val, $origin) {
			if( $val == '100' ) {
				return 1;
			} else { 
				return 0;
			}
		}
	}
}


?>