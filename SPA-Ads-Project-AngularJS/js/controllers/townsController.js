'use strict';

adsApp.controller('TownsController', ['$scope', 'townsDataService', function($scope, townsDataService) {

	townsDataService.getAllTowns(function(resp) {
		$scope.towns = resp;
	});

	$scope.getTownId = function getTownId(id, name) {
		$scope.parameters.townId = id;
		$scope.parameters.townName = name;
		$scope.parameters.startPage = 1;
		/*alert($scope.parameters.townId);*/
	}

	$scope.cancelTownId = function cancelTownId() {
		$scope.parameters.townId = '';
		$scope.parameters.townName = '';
		$scope.parameters.startPage = 1;
		/*alert($scope.parameters.townId);*/
	}
}]);