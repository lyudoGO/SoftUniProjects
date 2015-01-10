'use strict';

adsApp.controller('RegisterController', ['$scope', '$location', 'townsDataService', 'userDataService', function($scope, $location, townsDataService, userDataService) {
	$('#title').text('Register');
	
	townsDataService.getAllTowns(function(resp) {
		$scope.towns = resp;
	});
	
	$scope.registerUser = function (user) {
		//console.log(user);
		userDataService.registerUser(user);
		$location.path('/user/ads');
	}
}]);