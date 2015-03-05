'use strict';

adsApp.controller('RegisterController', ['$scope', '$location', 'townsDataService', 'userDataService', 'authenticationService', function($scope, $location, townsDataService, userDataService, authenticationService) {
	$('#title').text('Register');
	
	townsDataService.getAllTowns(function(data) {
		$scope.towns = data;
	});

	$scope.user = {};

	$scope.registerUser = function (user) {
		userDataService.registerUser(user, 
			function(data) {
				authenticationService.saveUser(angular.toJson(data));
				authenticationService.getHeaders();
				$scope.alertMsg('info', 'Your successfully login!');
				$location.path('/user/home');
			}, function(data) {
				$scope.alertMsg('danger', 'Cannot register! ' + data.message);
			});
	}
}]);