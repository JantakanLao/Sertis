<html data-ng-app="myApp">
<head>
	<title>Users</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.16/angular.min.js"></script>
	<script type="text/javascript" src="/sertis/js/uikit.min.js"> </script>
	<script type="text/javascript" src="/sertis/js/components/notify.min.js"> </script>

	<link rel="stylesheet" type="text/css" href="/sertis/css/uikit.gradient.min.css" />
    <link rel="stylesheet" type="text/css" href="/sertis/css/components/notify.gradient.min.css" />
	<script type="text/javascript">
		var myApp = angular.module("myApp", []);
		myApp.controller("myController", function($scope, $http) {


			$scope.loggedIn = false;
			$scope.loggedInID = 0;
			$scope.username = '';
			
			$http
			.get("<?php echo site_url("controlpage/check_session")?>")
			.success(function(data, status, headers, config) {
				
				if(data.status == 1)
				{
					$scope.loggedIn   = true;
					$scope.loggedInID = data.user_id;
					$scope.username   = data.username;
				}
				else {
					$scope.loggedIn   = false;
					$scope.loggedInID = 0;
				}
			})

			$http
				.get("<?php echo site_url("controlpage/retrieveinfo")?>")    
				.success(function(data, status, headers, config) {
					$scope.info = data
				})
				
			$scope.card = 
			{
				name: '',
				status: '',
				content: '',
				category: '',
				author: '',
			}

			$scope.addcard = function(){
				var req = {
					method: 'POST',
					url: "<?php echo site_url("ControlPage/addnewcard")?>",
					headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                        },
                    data: $.param($scope.card)
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
								//$scope.refresh();
								window.location.assign("<?php echo site_url("ControlPage/Userspage")?>");      
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

			$scope.editcard = function(cardid){
                var url = "<?php echo site_url("ControlPage/editcardpage")?>" + '/' + cardid;
                newwindow=window.open(url,'name','height=800,width=500');
                if (window.focus) {newwindow.focus()}
                
                    }

            $scope.deletecard = function(cardid){
                //console.log('1234');
                var req = {
                        method: 'POST',
                        url: "<?php echo site_url("ControlPage/deletecard")?>" + '/' + cardid,
                        headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                        },
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
									
									window.location.assign("<?php echo site_url("ControlPage/Userspage")?>"); 
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

			$scope.selectcategory = function(category){
				
				window.location.assign("<?php echo site_url("ControlPage/categorypage/")?>" + '/' + category);

			}
			$scope.activitypage = function(){
				
				window.location.assign("<?php echo site_url("ControlPage/activitypage/")?>");

			}
			$scope.userspage = function(){
				
				window.location.assign("<?php echo site_url("ControlPage/userspage/")?>");

			}
			$scope.hide = function(){
				
				$("#aa").hide();
			}


		});
	</script>

</head>
<body data-ng-controller="myController" style="background-color:#F0F0F0;">
	
	<div class="uk-grid uk-grid-collapse">
	    <div class="uk-width-1-5">
	    	<div style="height:12%;background-color:00CCFF;">
	    		<div class="uk-grid uk-grid-collapse" style="font-size:20px;">
	    			<div class="uk-panel uk-panel-box uk-margin-top" style="border:1px solid #00CCFF;background-color:#00CCFF;color:white;"> 
	    				<div class="uk-width-2-5">Youknow
			    		</div>
	    			</div>
	    			
	    		</div>
	    	</div>
	    	<div class="uk-grid uk-grid-collapse">
	    		
	    			<table class="uk-table">
	    				<tr>
		    				<td class="uk-width-1-3 uk-text-middle uk-text-center" style="background-color:0099CC;">
		    				 	<i class="uk-icon-heartbeat uk-icon-small" style="color:white;" ng-click="selectcategory('biology')"></i>
		    				</td>
							<td class="uk-width-2-3" style="background-color:66CCFF;font-size:14px;color:white;" >
								<div ng-click="selectcategory('biology')" ng-mouseover="style1={color:'#707070','cursor':'pointer'}" 
									 ng-mouseleave="style1={'color':'white'}" ng-style="style1" style="padding:5px;">Biology</div>
							    <div style="padding:5px;color:#707070;">20 Users</div>						
							</td>
						</tr>

						<tr>
		    				<td class="uk-width-1-3 uk-text-middle uk-text-center" style="background-color:0099CC;">
		    					<i class="uk-icon-line-chart uk-icon-small" style="color:white;" ng-click="selectcategory('finance')"></i>
		    				</td>
							<td class="uk-width-2-3" style="background-color:66CCFF;font-size:14px;color:white;" >
								<div ng-click="selectcategory('finance')" ng-mouseover="style2={color:'#707070','cursor':'pointer'}" 
									 ng-mouseleave="style2={'color':'white'}" ng-style="style2" style="padding:5px;">Finance</div>
							    <div style="padding:5px;color:#707070;">20 Users</div>						
							</td>
						</tr>

						<tr>
		    				<td class="uk-width-1-3 uk-text-middle uk-text-center" style="background-color:0099CC;">
		    					<i class="uk-icon-flask uk-icon-small" style="color:white;" ng-click="selectcategory('chemistry')" ></i>
		    				</td>
							<td class="uk-width-2-3" style="background-color:66CCFF;font-size:14px;color:white;" >
								<div ng-click="selectcategory('chemistry')" ng-mouseover="style3={color:'#707070','cursor':'pointer'}" 
									 ng-mouseleave="style3={'color':'white'}" ng-style="style3" style="padding:5px;">Chemistry</div>
							    <div style="padding:5px;color:#707070;">20 Users</div>						
							</td>
						</tr>
						
						<tr>
		    				<td class="uk-width-1-3 uk-text-middle uk-text-center" style="background-color:0099CC;">
		    					<i class="uk-icon-cog uk-icon-small" style="color:white;" ng-click="selectcategory('engineering')"></i>
		    				</td>
							<td class="uk-width-2-3" style="background-color:66CCFF;font-size:14px;color:white;" >
								<div ng-click="selectcategory('engineering')" ng-mouseover="style4={color:'#707070','cursor':'pointer'}" 
									 ng-mouseleave="style4={'color':'white'}" ng-style="style4" style="padding:5px;">Engineering</div>
							    <div style="padding:5px;color:#707070;">20 Users</div>						
							</td>
						</tr>

						<tr>
		    				<td class="uk-width-1-3 uk-text-middle uk-text-center" style="background-color:0099CC;">
		    					<i class="uk-icon-cart-plus uk-icon-small" style="color:white;" ng-click="selectcategory('health')" ></i>
		    				</td>
							<td class="uk-width-2-3" style="background-color:66CCFF;font-size:14px;color:white;" >
								<div ng-click="selectcategory('health')" ng-mouseover="style5={color:'#707070','cursor':'pointer'}" 
									 ng-mouseleave="style5={'color':'white'}" ng-style="style5" style="padding:5px;">Health</div>
							    <div style="padding:5px;color:#707070;">20 Users</div>						
							</td>
						</tr>

						<tr>
		    				<td class="uk-width-1-3 uk-text-middle uk-text-center" style="background-color:0099CC;">
		    					<i class="uk-icon-users uk-icon-small" style="color:white;" ng-click="selectcategory('society')" ></i>
		    				</td>
							<td class="uk-width-2-3" style="background-color:66CCFF;font-size:14px;color:white;" >
								<div ng-click="selectcategory('society')" ng-mouseover="style6={color:'#707070','cursor':'pointer'}" 
									 ng-mouseleave="style6={'color':'white'}" ng-style="style6" style="padding:5px;">Society</div>
							    <div style="padding:5px;color:#707070;">20 Users</div>						
							</td>
						</tr>

						<tr>
		    				<td class="uk-width-1-3 uk-text-middle uk-text-center" style="background-color:0099CC;">
		    					<i class="uk-icon-paper-plane uk-icon-small" style="color:white;" ng-click="selectcategory('space')"></i>
		    				</td>
							<td class="uk-width-2-3" style="background-color:66CCFF;font-size:14px;color:white;" >
								<div ng-click="selectcategory('space')" ng-mouseover="style7={color:'#707070','cursor':'pointer'}" 
									 ng-mouseleave="style7={'color':'white'}" ng-style="style7" style="padding:5px;">Space</div>
							    <div style="padding:5px;color:#707070;">20 Users</div>						
							</td>
						</tr>

						<tr>
		    				<td class="uk-width-1-3 uk-text-middle uk-text-center" style="background-color:0099CC;">
		    					<i class="uk-icon-paint-brush uk-icon-small" style="color:white;" ng-click="selectcategory('art')"></i>
		    				</td>	
							<td class="uk-width-2-3" style="background-color:66CCFF;font-size:14px;color:white;" >
								<div ng-click="selectcategory('art')" ng-mouseover="style8={color:'#707070','cursor':'pointer'}" 
									 ng-mouseleave="style8={'color':'white'}" ng-style="style8" style="padding:5px;">Art</div>
							    <div style="padding:5px;color:#707070;">20 Users</div>						
							</td>
						</tr>

						<tr>
		    				<td class="uk-width-1-3 uk-text-middle uk-text-center" style="background-color:0099CC;">
		    					<i class="uk-icon-desktop uk-icon-small" style="color:white;" ng-click="selectcategory('computer')"></i>
		    				</td>
							<td class="uk-width-2-3" style="background-color:66CCFF;font-size:14px;color:white;" >
								<div ng-click="selectcategory('computer')" ng-mouseover="style9={color:'#707070','cursor':'pointer'}" 
									 ng-mouseleave="style9={'color':'white'}" ng-style="style9" style="padding:5px;">Computer</div>
							    <div style="padding:5px;color:#707070;">20 Users</div>						
							</td>
						</tr>
					</table>
	    	</div>
	    		
	    </div>
	    <div class="uk-width-4-5">
	    	<div style="height:12%;background-color: white;">
    			<div >
					<div ng-hide="loggedIn" style="float:right;padding-right:1%;">
		                <a href="<?= site_url("controlpage/loginpage");?>">Login</a>
					</div>
				    <div ng-show="loggedIn" style="float:right;padding-right:1%;">
					    {{username}} |
					    <a href="<?= site_url("controlpage/logout");?>">Logout</a>
				    </div>
				</div>
	    		<div class="uk-grid uk-grid-collapse" style="font-size:22px;background-color: white;">
	    			<div class="uk-panel uk-panel-box uk-margin-top" style="border:1px solid white;background-color: white;"> 
	    				<div class="uk-width-1-6 " >
	    				</div>
	    			</div>

	    			<div class="uk-panel uk-panel-box uk-margin-top" style="border:1px solid white;background-color:white;color:#707070;"> 
	    				<div class="uk-width-1-6 " >
			    			<div ng-mouseover="style01={color:'00CCFF', 'cursor':'pointer'}" 
			    		     	 ng-mouseleave="style01={'color':'#707070'}" ng-style="style01" ng-click="activitypage()">Activity</div>
			    		</div>
			    	</div>

	    			<div class="uk-panel uk-panel-box uk-margin-top" style="border:1px solid white;background-color:white;"> 
	    				<div class="uk-width-1-6 " >
			    		</div>
	    			</div>

	    			<div class="uk-panel uk-panel-box uk-margin-top" style="border:1px solid white;background-color:white;color:#00CCFF;"> 
	    				<div class="uk-width-1-6 " >
			    			<div ng-mouseover="style02={color:'00CCFF', 'cursor':'pointer'}" 
			    		     	 ng-mouseleave="style02={'color':'#00CCFF'}" ng-style="style02" ng-click="userspage()">Users</div>
			    		</div>
			    	</div>

	    			<div class="uk-panel uk-panel-box uk-margin-top" style="border:1px solid white;background-color:white;"> 
	    				<div class="uk-width-1-6 " >
			    		</div>
	    			</div>

	    			<div class="uk-panel uk-panel-box uk-margin-top" style="border:1px solid white;background-color:white;color:#707070;"> 
	    				<div class="uk-width-1-6 " >
			    			<div ng-mouseover="style03={color:'00CCFF', 'cursor':'pointer'}" 
			    		     	 ng-mouseleave="style03={'color':'#707070'}" ng-style="style03" ng-click="">Groups</div>
			    		</div>
			    	</div>
			    	
	    		</div>
	    			
	    	</div>

	    	<div style="background-color:white;margin:10px 15px 10px 15px;">
	    		
	    		<form class="uk-form" style="padding:10px;">

				    <fieldset data-uk-margin>
				        
				        <input class="uk-form-width-medium" type="text" placeholder="name" ng-model="card.name">
				       	<select class="uk-form-width-medium" ng-model="card.status">
				            <option disabled selected> -- select status -- </option>
		    				<option value="private">private</option>
		    				<option value="public">public</option>
		    				<option value="draft">draft</option>
				        </select>

		    			<input class="uk-form-width-medium" type="text" placeholder="category" ng-model="card.category" >
		    			<input class="uk-form-width-medium" type="text" placeholder="author" ng-model="card.author">
		    			
		    			
		    			<div class="uk-form-row">
						    <textarea style="width:83.5%;" placeholder="content" ng-model="card.content"></textarea>
						    
						    <button class="uk-button" value="Add" ng-click="addcard();" style="width:10%;margin-left:3%;margin-top:1%;">Add</button>
						</div>
		    		 </fieldset>

				</form>

	    	</div>

	    	<div class="uk-grid uk-grid-collapse">
	    		<div class="uk-width-1-3" data-ng-repeat="info in info">
	    			<div class="uk-panel uk-panel-box uk-panel-box-secondary" style="margin:2px 15px 10px 15px;border:1px solid #F8F8F8;position: relative;">
	    				<div style="float:left">
	    					<h5 data-ng-bind="info.category" style="color:#660099;text-transform: uppercase;"></h5>
	    				</div>
	    				<div style="float:right">
	    					<i class="uk-icon-circle-o" style="color:green;" ng-if="info.status == 'public'"></i>
							<i class="uk-icon-circle-o" style="color:red;" ng-if="info.status == 'private'"></i>
							<i class="uk-icon-circle-o" style="color:yellow;" ng-if="info.status == 'draft'"></i>
							
	    					<i class="uk-icon-edit" ng-mouseover="style001={color:'00CCFF', 'cursor':'pointer'}" ng-mouseleave="style001={'color':'black'}" 
	    						ng-style="style001" ng-click="editcard(info.card_id);" ></i>	
	    					<i class="uk-icon-trash-o" ng-mouseover="style002={color:'00CCFF', 'cursor':'pointer'}" ng-mouseleave="style002={'color':'black'}" 
	    						ng-style="style002" ng-click="deletecard(info.card_id);"></i>	
						</div><br>

						
	    				<h5 data-ng-bind="info.content" style="color:#707070;"></h5>
	    				<h5 data-ng-bind="info.author" style="color:#707070;"></h5>
	    			</div>
	    		</div>
	    		
	    	</div>

	    </div>

	</div>
						
</body>


</html>