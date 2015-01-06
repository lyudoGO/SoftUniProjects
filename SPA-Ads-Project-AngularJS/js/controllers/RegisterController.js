'use strict';

adsApp.controller('RegisterController', ['$scope', 'townsDataService', 'userDataService', function($scope, townsDataService, userDataService) {
	/*$('#title').text('Register');*/
	$scope.pageTitle = 'Register';
/*	townsDataService.getAllTowns()
					.$promise
					.then(function (data) {
						$scope.towns = data;
						console.log(data);
					});*/
	townsDataService.getAllTowns(function(resp) {
		$scope.towns = resp;
	});
	$scope.registerUser = function (user) {
		//console.log(user);
		userDataService.registerUser(user);
	}
}]);