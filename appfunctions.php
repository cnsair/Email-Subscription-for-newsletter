<?php 

/*
=====================================================================
START SESSION
=====================================================================
*/

if(!isset($_SESSION))
{
	session_start();
}

// spl_autoload_register(array('Manage', 'autoload'));
//============================================================================

spl_autoload_register(function($class) {
    include 'classes/' . $class . '.php';
});

/*
=====================================================================
SET DEFAULT TIMEZONE OFFSET
=====================================================================
*/

// $timezone_offset = +6;
// $add_timezone_diff = time() + ($timezone_offset * 3600);

date_default_timezone_set("Africa/Lagos");

/*
=====================================================================
INSTANTIATE CONNECTION VARIABLE
=====================================================================
*/

$kc = new DB; 
$connect = $kc->getConn();

/*
=====================================================================
INSERTIONS
=====================================================================
*/

/*
Insertion List

1. Subscribe Users
.....
*/ 

	
if(isset($_POST["INSERT"]) && $_POST["INSERT"] !="" )
{
		$crud = new Crud($connect);
		$user = new User($connect);
		$Timenow = date("Y-m-d H:i:s");

		switch ($_POST["INSERT"]) {

		//subscription
		case 1:

			$email  = $user->ValidateData( $_POST["Email"] );
			$ipaddress = $_SERVER["REMOTE_ADDR"];
			$checkemail = $crud->select("subscription", "*", "Email = '$email' ");

			if($checkemail == TRUE)
			{
					$response = "<div class='alert alert-danger alert-dismissable'>
								<button class='close' data-dismiss='alert'>&times;</button>
								<p align='center' style='color: #ff0000 !important;' >
									This email has subscribed before. Please use another.
								</p>
							</div>";
			}
			else
			{
				// Validate email address
				if( filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE ){
					$response = "<div class='alert alert-danger alert-dismissable'>
									<button class='close' data-dismiss='alert'>&times;</button>
									<p align='center' style='color: #ff0000 !important;' >
										Please input a valid email address.
									</p>
								</div>";
				}
				else{
					//Put values into an Array
					$inserted = $crud->insert("subscription", 
					array(
						'Email'=>$email,
						'AddedOn'=>$Timenow,
						'IPAddr'=> $ipaddress
					) );

					if(!$inserted)
					{
						$response = "<div class='alert alert-danger alert-dismissable'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<p align='center' style='color: #ff0000 !important;'>
											It looks like something went wrong while adding up your email.<br>
											Please Try again later.
										</p>
									</div>";
					}
					else
					{	
						$response = '
									<div align="center" class="alert alert-dismissable alert-success">
										<button class="close" data-dismiss="alert">&times;</button>
										Your Email has been added to our database. You will recieve information about our progress.
									</div>';
					}

				}		
			}

			break;






			default:
				# code...
				break;
		}
}



?>