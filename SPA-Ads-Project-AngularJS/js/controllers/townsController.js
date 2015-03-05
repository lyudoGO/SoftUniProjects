'use strict';

adsApp.controller('TownsController', ['$scope', 'townsDataService', function($scope, townsDataService) {

	townsDataService.getAllTowns(
		function(data) {
			$scope.alertMsg('success', 'Towns was successfully loaded!');
			$scope.towns = data;
		},
		function (data, status, headers, config) {
        	$scope.alertMsg('danger', 'Failed to load towns. Please try again later.');
    	});

	$scope.getTownId = function getTownId(id, name) {
		$scope.parameters.townId = id;
		$scope.parameters.townName = name;
		/*$scope.parameters.startPage = 1;*/
	}

	$scope.cancelTownId = function cancelTownId() {
		$scope.parameters.townId = '';
		$scope.parameters.townName = '';
		/*$scope.parameters.startPage = 1;*/
	}
}]);