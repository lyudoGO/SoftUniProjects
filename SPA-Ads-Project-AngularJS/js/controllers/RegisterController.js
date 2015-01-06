'use strict';

adsApp.controller('RegisterController', ['$scope', 'townsDataService', function($scope, townsDataService) {
	$('#title').text('Register');
	townsDataService.getAllTowns()
					.$promise
					.then(function (data) {
						$scope.towns = data;
						console.log(data);
					});
}]);