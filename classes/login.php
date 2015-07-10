<?php

class Login
{
	
	public function CheckLogin($username,$password,$remember)
	{
		
		$mdpass = md5($password);
		
		$check = mysql_query("SELECT * FROM `members` where `user_name`='$username' && `password`='$mdpass'") or die(mysql_error());
		
		//$check2 = mysql_query("SELECT * FROM `members` where `user_name`='$username' && `password`='$mdpass'") or die(mysql_error());
		
		$getinfor = mysql_fetch_array($check);
		
		//$getinfor2 = mysql_fetch_array($check);
		
		$activate = $getinfor['activated'];
		
		$role = $getinfor['designation'];
		
		$checkuser = mysql_num_rows($check);
		
			if(($checkuser>=1) && ($activate==1))
			{
				$loginok = TRUE;
				
			} 
			elseif(($checkuser>=1) && ($activate==0)) 
			{
				
				return "Your Account is not activated by Admin.";

			}
			else
			{
				
				return "The username or password you entered is incorrect.";
				
			}
		 
			if ($loginok == 1)
			{
				if ($remember == "yes")
				{
					session_start(); 
					
					$_SESSION['username']=$username;
					
					$_SESSION['designation'] = $getinfor['designation'];
					
					$server = $_SERVER['HTTP_HOST'];
					
					setcookie("username", $username, time()+7600, "/");
					
					switch($role)
					{
						case '1':
						header("Location:anesthesiologist");
						break;
						
						case '2':
						header("Location:attorney");
						break;
						
						case '3':
						header("Location:doctors");
						break;
						
						case '4':
						header("Location:medical-facility");
						break;
						
						case '5':
						header("Location:client");
						break;
						
						case '6':
						header("Location:underwriter");
						break;
						
						case '7':
						header("Location:case-manager");
						break;
						
						case '8':
						header("Location:mayo-admin/welcome");
						break;
						
						default:
						echo "Username/Password Combination is Incorrect";
					}
					
					exit();
				}
				else if($remember=="")
				{
					session_start(); 
					
					$_SESSION['username']=$username;
					
					$server = $_SERVER['HTTP_HOST'];
					
					setcookie("username", $username, time()+7600, "/");
					
					$_SESSION['designation'] = $getinfor['designation'];
					
					switch($role)
					{
						case '1':
						header("Location:anesthesiologist");
						break;
						
						case '2':
						header("Location:attorney");
						break;
						
						case '3':
						header("Location:doctors");
						break;
						
						case '4':
						header("Location:medical-facility");
						break;
						
						case '5':
						header("Location:client");
						break;
						
						case '6':
						header("Location:underwriter");
						break;
						
						case '7':
						header("Location:case-manager");
						break;
						
						case '8':
						header("Location:mayo-admin/welcome");
						break;
						
						default:
						echo "Username/Password Combination is Incorrect";
					}
								
				}
		}
	

}

}
?>
