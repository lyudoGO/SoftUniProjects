'use strict';

adsApp.factory('userAdsService', ['$http', '$log', 'baseServiceUrl', function ($http, $log, baseServiceUrl) {
		
	function getAllUserAds(userAccessToken, success) {
		$http({
				method: 'GET',
				headers: { Authorization: 'Bearer ' + userAccessToken },
				url: baseServiceUrl + 'user/ads'
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			$log.error(data);
		})
	}

	return {
		getAllUserAds: getAllUserAds
	}
}]);