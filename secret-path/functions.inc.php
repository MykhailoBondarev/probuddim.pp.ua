<?php 
 function LogOut()
 {
	unset($_SESSION['id']);
	unset($_SESSION['login']);
	unset($_SESSION['name']);
	unset($_SESSION['ip']);		       
	unset($_SESSION['role']);	   	        	
	// setcookie('PHPSESSID','',time() - 3600, '/');
	session_destroy();	
 }

 function Login($login, $password, $cookie_session)
 {
 	$passwordHash = md5($password);
 	try
 	{
 		$Login_sql_str='SELECT * FROM users WHERE login=:login AND password=:passwordHash';
        $LoginExpSql = $GLOBALS['pdo'] -> prepare($Login_sql_str);
		$LoginExpSql -> bindValue(':login', $login);
		$LoginExpSql -> bindValue(':passwordHash', $passwordHash);
		$LoginExpSql -> execute();
		$LoginResultArr = $LoginExpSql -> fetch();
		if ($LoginResultArr[0]!='')
		{
			session_start();			
			$_SESSION['id'] = md5($_COOKIE['PHPSESSID'].$LoginResultArr['login']);
			$_SESSION['login'] = $LoginResultArr['login'];
			$_SESSION['name'] = $LoginResultArr['name'];
			$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];		
			$_SESSION['role'] = $LoginResultArr['role'];
			$_SESSION['user-id'] = $LoginResultArr[0];
			session_write_close();
			try
			{
				$Login_update_sql='UPDATE users SET last_login=NOW(), last_ip=:last_ip, last_session_id=:session_id WHERE id=:user_id';
				$Login_update_exp= $GLOBALS['pdo'] -> prepare($Login_update_sql);				
				$Login_update_exp -> bindValue(':last_ip', $_SESSION['ip']);
				$Login_update_exp -> bindValue(':session_id', $_SESSION['id']);
				$Login_update_exp -> bindValue(':user_id', $LoginResultArr[0]);
				$Login_update_exp -> execute();
			}
			catch(PDOException $e)
			{
				$_SESSION['loginError'] = 'Сталася помилка при виконанні запиту '. $e -> getMessage();
			}
		}
		    elseif ($LoginResultArr[0]=='')
		    {			        	
		        if(isset($_SESSION)) 
		        {       	
		        	LogOut();
		        }
		            $_SESSION['loginError'] = 'Невірний логін або пароль';		         
		            return $_SESSION['loginError'];
		            exit;	            	   		        	       
		    }		
 	}
 	catch(PDOException $e)
 	{
 		$_SESSION['loginError'] = 'Сталася помилка при виконанні запиту '. $e -> getMessage();
 	}
 }

 function ObjectList($objectType)
 {
 	try 
 	{
 		$ObjectList_sql_str = 'SELECT * FROM '.$objectType;
 		$ObjectList_select_exp = $GLOBALS['pdo'] -> prepare($ObjectList_sql_str);
 		$ObjectList_select_exp -> execute();
 		$ObjectListResultArr = $ObjectList_select_exp -> fetchAll();
 		return $ObjectListResultArr;
 	}
 	catch (PDOException $e)
 	{
 		$_SESSION['loginError'] = 'Сталася помилка при виконанні запиту '. $e -> getMessage();
 		return $_SESSION['loginError'];
 		exit;
 	}
 }

 ?>