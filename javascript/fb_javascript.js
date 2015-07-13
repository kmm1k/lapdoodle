function launchCode(){
	$('#login_koht').load(document.URL +  ' #login_koht');
	//location.reload();
}

function checkLoginState() {
	FB.getLoginStatus(function(response) {

	});
}
window.fbAsyncInit = function(){
	FB.init({
		appId      : '585660011580124',
		cookie     : true,  // enable cookies to allow the server to access 
		xfbml      : true,  // parse social plugins on this page
		version    : 'v2.1' // use version 2.1
		});
	FB.getLoginStatus(function(response){

	});
};

(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/et_EE/sdk.js#xfbml=1&appId=585660011580124&version=v2.0";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));


$( document ).ready(function() {
    console.log( "ready!" );
	//launchCode();
});
