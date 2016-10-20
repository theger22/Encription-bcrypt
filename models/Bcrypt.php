<?php

class Bcrypt
{

    /* ========================
	   ======== Ecrypt ========
       ========================

       enkripsi string  */
    public function Ecrypt($params)
    {
    	$password = password_hash($params, PASSWORD_DEFAULT, ['cost' => 11]);
    	return $password;
    }

    /* ========================
	   ======== verify ========
       ========================

       cek string dengan encrpsinya  */
    public function Verify($password, $username)
    {
    	$user = User::findFirst("username = '$username'");
    	if (password_verify($password, $user->password)) {
    		return $user;
    	}else{
    		$field = array('status' => 'gagal');
    		return $field;
    	}
    }

    /* ========================
	   ====== CEK STRING ======
       ========================

       nilai true didapat saat string yang di cek memiliki
       huruf besar, kecil, dan angka */
    public function ScanString($params)
    {
    	$string = str_split($params);

		$uppercase = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ');
		$lowercase = str_split('abcdefghijklmnopqrstuvwxyz');
		$number    = str_split('1234567890');

		for ($i = 0; $i < 26; $i++) { 
			for ($s = 0; $s < count($string) ; $s++) { 
				switch ($string[$s]) {
					case $uppercase[$i]:
						$data[0] = true;
						break;
				}
			}
		}

		for ($i = 0; $i < 26; $i++) { 
			for ($s = 0; $s < count($string) ; $s++) { 
				switch ($string[$s]) {
					case $lowercase[$i]:
						$data[1] = true;
						break;
				}
			}
		}

		for ($i = 0; $i < 10; $i++) { 
			for ($s = 0; $s < count($string) ; $s++) { 
				switch ($string[$s]) {
					case $number[$i]:
						$data[2] = true;
						break;
				}
			}
		} 

		if (isset($data[0]) and isset($data[1]) and isset($data[2])) {
			return 'true';
		}else{
			return 'false';
		}
    }

    /* =========================
	   ===== RANDOM STRING =====
       =========================

       menghasilkan string random dengan huruf besar dan kecil */
    public function RandomString()
    {
	    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $randstring = '';
	    $length 	= strlen($characters)-1;
	    for ($i = 0; $i < 10; $i++) {
	        $randstring[] = $characters[rand(0, $length)];
	    }
	    return implode('', $randstring);
    }

}
