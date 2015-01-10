'use strict';

adsApp.factory('categoriesDataService', ['$http', '$log', 'baseServiceUrl', function ($http, $log, baseServiceUrl) {
	function getAllCategories(success, error) {
		$http({
				method: 'GET',
				url: baseServiceUrl + 'categories'
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			error(data);
			$log.error(data);
		})
	}

	return {
		getAllCategories: getAllCategories
	}
}]);