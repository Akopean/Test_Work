<?php

require(__DIR__.'/User.php');
require(__DIR__.'/View.php');

/**
* Route
*/
class Route
{
	/*
	/ request Routing
	/ $config - configuration app
	/ return void
	*/
	static function Run($config)
	{
		$error = [];
		$user = new User($config['db']);
		if(isset($_SESSION['user']))
		{
			if($_POST['action']==='update')
			{
				if(isset($_POST['u_name']) && isset($_POST['u_email']) &&
                                  		      isset($_POST['u_gender']))
			 	{
				 $name = $user->Validate( $_POST['u_name']);
				 $email = $user->Validate($_POST['u_email']);
				 $file = isset($_FILES['u_file']) ? $_FILES['u_file'] : '';
				 $gender = $_POST['u_gender'] === 'M' ? 'M' : 'W';

			 	if(!preg_match('/^[a-zA-Z]{3,20}$/u',$name) || mb_strlen($name)<3 ||
			                                                    mb_strlen($name)>20)
			    {
			        $error[] = 13;
			    }
				if(!filter_var($email, FILTER_VALIDATE_EMAIL))
				{
					$error[] = 4;
				}
				if(empty($file))
				{
					$error[] = $user->ValidateFile($file);
				}
			    if(count($error) === 0)
			    {
			        if(!$user->UpdateProfile($name, $email, $gender, $file))
			        {
			          echo json_encode(['error' => 1]);
			        }
			        else
			        {
			          echo json_encode(['sucess' => 2]);
			        }
			    }
			    else
			    {
			        echo json_encode($error);
			    }
			 }
			}
			elseif($_POST['action'] === 'exit')
			{
			 	session_unset('user');
			}
			else
			{
				View::Render($config['language'], 'profile');

			}
		}
		// JSON Request
		elseif($_POST['action']==='auth')
		{
		    if(isset($_POST['l_login']) && isset($_POST['l_password']))
			{
			    $login = $user->Validate($_POST['l_login']);
			    $pass = $_POST['l_password'];

			    if( !preg_match('/^[a-zA-Z]{3,20}$/u',$login) ||
			                                        mb_strlen($login)<3 ||
			                                        mb_strlen($login)>20 ||
			                                        mb_strlen($pass)<6 ||
			                                        mb_strlen($pass)>25)
			    {
			       echo json_encode(['error' => 2]);
			       exit;
			    }
			    if(!$user->Auth($login,$pass))
			    {
			       echo json_encode(['error' => 1]);
			    }
			    else
			    {
			     echo json_encode(['sucess' => 1]);
			    }
			}
		}
		// JSON request
		elseif($_POST['action']==='register')
		{	
			$error = [];
		    if(isset($_POST['r_name']) && isset($_POST['r_login']) &&
                                  isset($_POST['r_password']) &&
                                  isset($_POST['re_password']) &&
                                  isset($_POST['r_email']) &&
                                  isset($_POST['r_gender']))
			 {
			    $login = $user->Validate($_POST['r_login']);
			    $pass = $_POST['r_password'];
			    $r_pass = $_POST['re_password'];
			    $name = $user->Validate( $_POST['r_name']);
			    $email = $user->Validate($_POST['r_email']);
			    $file = isset($_FILES['r_file']) ? $_FILES['r_file'] : '';
			    $gender = $_POST['r_gender'] === 'M' ? 'M' : 'W';
			
			    if( !preg_match('/^[a-zA-Z]{3,20}$/u',$login) || mb_strlen($login)<3 ||
			                                                    mb_strlen($login)>20)
			    {
			        $error[] = 10;
			    }
			    if( !preg_match('/^[a-zA-Z]{3,20}$/u',$name) || mb_strlen($name)<3 ||
			                                                    mb_strlen($name)>20)
			    {
			        $error[] = 13;
			    }
			    if(mb_strlen($pass)<6 || mb_strlen($pass)>25)
			    {
			       $error[] = 11;
			    }
			    if($pass !== $r_pass)
			    {
			       $error[] = 6;
			    }
			    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			    {
			        $error[] = 4;
			    }
			    if(!empty($file) && $file['size'] > 0)
			    {
			    	$val = $user->ValidateFile($file);
					if($val !== true)
					{
						$error[] = $val;
					}
			    }  
			    if(count($error) === 0)
			    {
			        if(!$user->Registration($login, $pass, $name, $email, $gender, $file))
			        {
			          echo json_encode(['error' => 1]);
			        }
			        else
			        {
			          echo json_encode(['sucess' => 2]);
			        }
			    }
			    else
			    {
			        echo json_encode($error);
			    }
			}
		}
		// Rendering  Main Page
		else
		{
			View::Render($config['language']);
		}

	}
}
