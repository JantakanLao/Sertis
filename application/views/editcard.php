<html data-ng-app="myApp">
<head>
	<title>Edit card</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script>
	<script type="text/javascript" src="/sertis/js/uikit.min.js"> </script>
	<script type="text/javascript" src="/sertis/js/components/notify.min.js"> </script>

	<link rel="stylesheet" type="text/css" href="/sertis/css/uikit.gradient.min.css" />
    <link rel="stylesheet" type="text/css" href="/sertis/css/components/notify.gradient.min.css" />
	<script type="text/javascript">
		var myApp = angular.module("myApp", []);
		myApp.controller("myController", function($scope, $http) {

			
			$scope.cardInfo = <?php echo json_encode($cardInfo,JSON_UNESCAPED_UNICODE);?>
				
			
			$scope.card_id = $scope.cardInfo.card_id;

			$scope.editcard = function(){
				var req = {
					method: 'POST',
					url: "<?php echo site_url("ControlPage/editoldcard")?>"+ '/' + $scope.card_id,
					headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                        },
                    data: $.param($scope.cardInfo)
				}
			$http(req)
                    .success(function(data, status, headers, config){
                        if(data.err == 0){

                        	opener.location.reload(); 
  							window.close();
                        }
                       
					})
					.error(function(data, status, headers, config){
                        console.log(data);
					});
			}
		});
	</script>

</head>
<body data-ng-controller="myController">
	
	<!--form>
{{card_id}}
		<input type="text" name="name" ng-model="cardInfo.name">
		<input type="text" name="status" ng-model="cardInfo.status">
		<input type="text" name="content" ng-model="cardInfo.content">
		<input type="button" value="submit" ng-click="editcard();">

		
	</form-->

	<form class="uk-form" style="padding:10px;">

	    <fieldset data-uk-margin class="uk-form-horizontal">
	        <!--div class="uk-form-row" style=" margin-left: 20%; margin-top: 30px; padding-bottom: 30px;"-->
	        	<label class="uk-form-label" for="">Name</label>
		        <input class="uk-form-width-medium" type="text" placeholder="name" ng-model="cardInfo.name">

		        <label class="uk-form-label" for="">status</label>
		       	<select class="uk-form-width-medium" ng-model="cardInfo.status">
		            <option disabled selected> -- select status -- </option>
					<option value="private">private</option>
					<option value="public">public</option>
					<option value="draft">draft</option>
		        </select>

		        <label class="uk-form-label" for="">Content</label>
				<div class="uk-form-row">
				    <textarea style="width:83.5%;" placeholder="content" ng-model="cardInfo.content"></textarea>
				</div>
				
				<button class="uk-button" value="Add" ng-click="editcard();" style="width:10%;margin-left:3%;margin-top:1%;">Edit</button>
			<!--/div-->
		 </fieldset>

	</form>


</body>


</html>