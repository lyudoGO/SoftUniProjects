'use strict';

adsApp.factory('categoriesDataService', ['$http', '$log', 'baseServiceUrl', function ($http, $log, baseServiceUrl) {
	/*var resource = $resource(baseServiceUrl + 'towns');*/
	function getAllCategories(success) {
		$http({
				method: 'GET',
				url: baseServiceUrl + 'categories'
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			$log.error(data);
		})
	}

	return {
		getAllCategories: getAllCategories
	}
}]);