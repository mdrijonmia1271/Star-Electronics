
//show all Category
app.controller("showdsrCtrl", function($scope, $http){
	$scope.reverse = false;
	$scope.perPage = "20";
	$scope.dsrs = [];

	var obj = { 
	    'table': 'dsr', 
	    cond : { 'trash' : 0 }
	};

	$http({
		method : 'POST',
		url    : url+'read',
		data   : obj
	}).success(function(response) {
		angular.forEach(response, function(values, index) {
			values['sl'] = index + 1;
			$scope.dsrs.push(values);
			console.log(response);
		});

		 //Pre Loader
		  $("#loading").fadeOut("fast",function(){
			  $("#data").fadeIn('slow');
		  });
	});
});
