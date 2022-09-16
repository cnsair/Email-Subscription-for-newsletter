<?php 

class User
{
    private $conn;
    
    public function __construct($connectionObject)
    {
        $this->conn = $connectionObject;
    }
    

    //================================================
    //			Validate User Inputs
    //================================================
    public function ValidateData( $data ) 
    {
        try
        {
            //$data = "";

            //$_SERVER["REQUEST_METHOD"] == "POST"
            //$_SERVER["PHP_SELF"];
            //$_SERVER["REQUEST_METHOD"];
            // $url = filter_var($url, FILTER_VALIDATE_URL);
            // $email = filter_var($email, FILTER_VALIDATE_EMAIL);
            // $number = filter_var($number, FILTER_VALIDATE_INT);

            $data = trim( $data );
            $data = stripslashes( $data );
            $data = htmlspecialchars( $data );
            
            return $data;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
    
	 


    //================================================
    //			Google reCAPTCHA KEYS
    //================================================
    public function googleKeys($type)
    {
        try
        {
            //FOR LOCALHOST
            //SecretKey and siteKey are Google's test keys for development purpose only
            $secretKey = "6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe";
            $siteKey = "6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI";

            if($type == 1)
            {
                return $secretKey;
            }elseif($type == 2){
                return $siteKey;
            }else{
                return false;
            }
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

 
 




}

?>