'use strict';

adsApp.factory('townsDataService', ['$http', '$log', 'baseServiceUrl', function ($http, $log, baseServiceUrl) {
	/*var resource = $resource(baseServiceUrl + 'towns');*/
	function getAllTowns(success) {
		$http({
				method: 'GET',
				url: baseServiceUrl + 'towns'
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			$log.warn(data);
		})
	}

	return {
		getAllTowns: getAllTowns
	}
}]);