<html data-ng-app="myApp">
<head>
	<title>Register</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script>
	<script type="text/javascript" src="/sertis/js/uikit.min.js"> </script>
	<script type="text/javascript" src="/sertis/js/components/notify.min.js"> </script>

	<link rel="stylesheet" type="text/css" href="/sertis/css/uikit.gradient.min.css" />
    <link rel="stylesheet" type="text/css" href="/sertis/css/components/notify.gradient.min.css" />
	<script type="text/javascript">
		var myApp = angular.module("myApp", []);
		myApp.controller("myController", function($scope, $http) {

			$scope.regisForm = 
			{
				username : '',
				email : '',
				password : '',
				confirmpassword : '',
			}

			$scope.id = '';
			$scope.registration = function(){
				console.log('1234');
				var req = {

                        method: 'POST',
						url: "<?php echo site_url("ControlPage/register")?>",
                        headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        data: $.param($scope.regisForm)
                }

                $http(req)
                        .success(function(data, status, headers, config){
                                if(data.err == 0){
	                                
	                                $scope.id = data.id;
	                                
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
		<form class="uk-form" style="padding-top:11%; ">
			 <fieldset data-uk-margin class="uk-form-horizontal">
		        	<h1 style="color:#00CCFF;">Youknow</h1><br>
			        <input type="text" name="username" placeholder="username" ng-model="regisForm.username" style="width:25%;height:7%;"><br>
			        <input type="text" name="email" placeholder="email" ng-model="regisForm.email" style="width:25%;height:7%;"><br>
			        <input type="password" name="password" placeholder="password" ng-model="regisForm.password" style="width:25%;height:7%;"><br>
			        <input type="password" name="confirmpassword" placeholder="confirmpassword" ng-model="regisForm.confirmpassword" style="width:25%;height:7%;"><br>
			        <br>
					<button class="uk-button" ng-click="registration();" style="width:25%;height:7%;">Submit</button><br><br>
					<a href="<?= site_url("controlpage/loginpage");?> ">Login</a>
			</fieldset>
		</form>
	</center>
</body>
</html>