'use strict';

adsApp.controller('RegisterController', ['$scope', '$location', 'townsDataService', 'userDataService', function($scope, $location, townsDataService, userDataService) {
	$('#title').text('Register');
	
	townsDataService.getAllTowns(function(data) {
		$scope.towns = data;
	});
	
	$scope.registerUser = function (user) {
		userDataService.registerUser(user);
		$scope.alertMsg('info', 'Your successfully login!');
		$location.path('/user/home');
	}
}]);