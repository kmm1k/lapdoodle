<?php
if(isset($fbsession)) {
	if($fbsession){
		try{
			$user_profile = (new FacebookRequest($fbsession, 'GET', '/me'))->execute()->getGraphObject(GraphUser::className());
			echo "it twerked";
			$email = $user_profile->getEmail();
			echo"\n ", $email;
			$_SESSION['logged']=1;
		}catch(FacebookRequestException $e){
			echo "Exception occured, code: " . $e->getCode();
			echo " with message: " . $e->getMessage();
			$_SESSION['logged']=0;
		}   
	}
}
?>