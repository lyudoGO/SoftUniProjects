'use strict';

adsApp.factory('townsDataService', ['$resource', 'baseServiceUrl', function ($resource, baseServiceUrl) {
	var resource = $resource(baseServiceUrl + 'towns');
	function getAllTowns() {
		return resource.query();
	}

	return {
		getAllTowns: getAllTowns
	}
}]);