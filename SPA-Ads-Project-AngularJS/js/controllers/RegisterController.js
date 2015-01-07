'use strict';

adsApp.controller('RegisterController', ['$rootScope', '$scope', 'townsDataService', 'userDataService', function($rootScope, $scope, townsDataService, userDataService) {

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