'use strict';

adsApp.controller('townsController', ['$scope', '$routeParams', 'townsDataService', function($scope, $routeParams, townsDataService) {

	townsDataService.getAllTowns(function(resp) {
		$scope.towns = resp;
	});
}]);