'use strict';

adsApp.factory('adsDataService', ['$http', '$log', 'baseServiceUrl', function ($http, $log, baseServiceUrl) {
		
	function getAllAds(categoryId, townId, startPage, pageSize, success, error) {
		$http({
				method: 'GET',
				url: baseServiceUrl + 'ads',
				params: { 
					StartPage: startPage,
					PageSize: pageSize,
					CategoryId: categoryId,
					TownId: townId
				}
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
		getAllAds: getAllAds,
	}
}]);