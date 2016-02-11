<html data-ng-app="myApp">
<head>
	<title>Login</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script>
	<script type="text/javascript" src="/sertis/js/uikit.min.js"> </script>
	<script type="text/javascript" src="/sertis/js/components/notify.min.js"> </script>

	<link rel="stylesheet" type="text/css" href="/sertis/css/uikit.gradient.min.css" />
    <link rel="stylesheet" type="text/css" href="/sertis/css/components/notify.gradient.min.css" />
	<script type="text/javascript">
		var myApp = angular.module("myApp", []);
		myApp.controller("myController", function($scope, $http) {

			$scope.loginForm = 
			{
				email : '',
				password : '',
			}

			$scope.id = '';
			$scope.login = function(){
				console.log('1234');
				var req = {

                        method: 'POST',
						url: "<?php echo site_url("ControlPage/login")?>",
                        headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        data: $.param($scope.loginForm)
                }

                $http(req)
                        .success(function(data, status, headers, config){
                                if(data.err == 0){
	                                
	                                UIkit.notify({
								    message :  data.msg,
								    status  : 'success',
								    timeout : 5000,
								    pos     : 'bottom-center'
								});	                         
								
									window.location.assign("<?php echo site_url("ControlPage/userspage")?>");      
								}
                                else {
	                                UIkit.notify({
								    message :  data.msg,
								    status  : 'warning',
								    timeout : 5000,
								    pos     : 'bottom-center'
								});	
                                }
                                console.log(data);
                        })
                        .error(function(data, status, headers, config){
                                console.log(data);
                        });

			}
	 });
	</script>
</head>
<body data-ng-controller="myController" style="background-color:#F0F0F0;">
	
	<center>
		<form class="uk-form" style="padding-top:15%; ">

		    <fieldset data-uk-margin class="uk-form-horizontal">
		        	<h1 style="color:#00CCFF;">Youknow</h1><br>
			        <input type="text" name="email" placeholder="email" ng-model="loginForm.email" style="width:25%;height:7%;"><br>
			        <input type="password" name="password" placeholder="password" ng-model="loginForm.password" style="width:25%;height:7%;"><br>
			        <br>
					<button class="uk-button" ng-click="login();" style="width:25%;height:7%;">Login</button><br><br>
					<a href="<?= site_url("controlpage/registerpage");?> ">Register</a>
			</fieldset>

		</form>
	</center>
</body>
</html>