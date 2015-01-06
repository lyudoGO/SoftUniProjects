'use strict';

adsApp.controller('TownsController', ['$scope', 'townsDataService', function($scope, townsDataService) {

	townsDataService.getAllTowns(function(resp) {
		$scope.towns = resp;
	});
}]);