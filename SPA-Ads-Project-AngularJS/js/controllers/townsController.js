'use strict';

adsApp.controller('TownsController', ['$scope', '$routeParams', 'townsDataService', function($scope, $routeParams, townsDataService) {

	townsDataService.getAllTowns(function(resp) {
		$scope.towns = resp;
	});
}]);