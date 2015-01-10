'use strict';

adsApp.controller('RegisterController', ['$scope', '$location', 'townsDataService', 'userDataService', function($scope, $location, townsDataService, userDataService) {
	$('#title').text('Register');
	
	townsDataService.getAllTowns(function(data) {
		$scope.towns = data;
	});
	
	$scope.registerUser = function (user) {
		//console.log(user);
		userDataService.registerUser(user);
		$location.path('/user/ads');
	}
}]);