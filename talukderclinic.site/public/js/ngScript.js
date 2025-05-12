var app = angular.module("MainApp", ["ngCookies"]);
var url = 'http://' + window.location.hostname + '/ads/ajax/';

app.run(function($rootScope, $cookies){
	// clear the cookie
	// $cookies.remove("favoriteSites");

	// Retrieving cookie
	if($cookies.get('favoriteSites')){
		var favoriteSites = $cookies.get('favoriteSites').split(',');
		favoriteSites = favoriteSites.map(function(i){
			return parseInt(i);
		});
	} else {
		var favoriteSites = [];
	}

	$rootScope.checkMarkedFn = function(id){
		var id = parseInt(id);
		if(favoriteSites.indexOf(id) >= 0){
			return true;
		}
		
		return false;
	}

  	// Set cookie
  	$rootScope.addFavoriteFn = function(id){
  		var id = parseInt(id);
  		if(favoriteSites.indexOf(id) >= 0){
  			// match then remove item
  			index = favoriteSites.indexOf(id);
  			favoriteSites.splice(index, 1);

  			// set the new cookie
  			$cookies.put('favoriteSites', favoriteSites);
  		} else { 
  			// not match then add item
  			favoriteSites.push(id);

  			// set the new cookie
  			$cookies.put('favoriteSites', favoriteSites);
  		}
  	}

  	// count the length of cookie
  	$rootScope.countFavoriteFn = function(){
  		return favoriteSites.length;
  	}

  	$rootScope.conditionalTextFn = function(id){
  		var id = parseInt(id);
  		if(favoriteSites.indexOf(id) >= 0){
  			return "Unmark";
  		}

  		return "Mark";
  	}

});

app.controller('AdvertisingCtrl', function($scope){
	$scope.duration = "1";
	$scope.instruction = true;

	// code goes to here
	$scope.adsFormFn = function(e) {
		e.preventDefault();

		$scope.position = $(e.target).data('position');
		$scope.size = $(e.target).data('size');
		$scope.id = $(e.target).data('id');
		$scope.status = $(e.target).data('status');
		$scope.price = $(e.target).data('price');

		if($scope.status == 'Blank'){
			$scope.instruction = false;
		} else {
			$scope.instruction = true;
		}
	}

	$scope.caculatePriceFn = function(duration, price){
		return (duration * price);
	}
	
});

app.controller("MarkedCtrl", ["$scope", "$cookies", "$http", "$window", function($scope, $cookies, $http, $window){
	var url = 'http://' + window.location.hostname + '/ads/home/getAds';
	var condition = {
		table: "posts",
		key: "id",
		value: $cookies.get('favoriteSites')
	};

	$http({
		method: "POST",
		url: url,
		data: condition
	}).success(function(response){
		$scope.resultset = response;
		console.log(response);
	});

	$scope.go_to = function(id){
		var url = 'http://' + window.location.hostname + '/ads/home/advertising_detils?id=' + id;
		$window.location.assign(url);
	}
}]);

// custom filters
app.filter('inHours', function(){
	return function(dateTime){
		var postAt = new Date(dateTime).getTime() / 1000, // in seconds
			today = new Date().getTime() / 1000, // in seconds
			hours = Math.floor((today - postAt) / 3600); // in hours

		return hours;
	}
});





