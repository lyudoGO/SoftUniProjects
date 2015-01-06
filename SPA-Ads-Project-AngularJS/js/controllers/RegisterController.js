'use strict';

adsApp.controller('RegisterController', ['$scope', 'townsDataService', 'userDataService', function($scope, townsDataService, userDataService) {
	$('#title').text('Register');
	townsDataService.getAllTowns()
					.$promise
					.then(function (data) {
						$scope.towns = data;
						console.log(data);
					});
	$scope.registerUser = function (user) {
		//console.log(user);
		userDataService.registerUser(user);
	}
}]);