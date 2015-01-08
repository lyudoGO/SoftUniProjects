'use strict';

adsApp.factory('userPostAdService', ['$http', '$log', 'baseServiceUrl', function ($http, $log, baseServiceUrl) {
		
	function postUserAd(userAccessToken, dataAd, success) {
		$http({
				method: 'POST',
				headers: { Authorization: 'Bearer ' + userAccessToken },
				url: baseServiceUrl + 'user/ads',
				data: JSON.stringify(dataAd)
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			$log.error(data);
		})
	}

	return {
		postUserAd: postUserAd
	}
}]);