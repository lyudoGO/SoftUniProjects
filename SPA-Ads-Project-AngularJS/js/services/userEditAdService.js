'use strict';

adsApp.factory('userEditAdService', ['$http', '$log', 'baseServiceUrl', function ($http, $log, baseServiceUrl) {
		
	function editUserAd(userAccessToken, dataAd, id, success) {
		$http({
				method: 'PUT',
				headers: { Authorization: 'Bearer ' + userAccessToken },
				url: baseServiceUrl + 'user/ads/' + id,
				data: JSON.stringify(dataAd)
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			$log.error(data);
		})
	}

	function getUserAdById(userAccessToken, id, success) {
		$http({
				method: 'GET',
				headers: { Authorization: 'Bearer ' + userAccessToken },
				url: baseServiceUrl + 'user/ads/' + id,
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			$log.error(data);
		})
	}

	return {
		editUserAd: editUserAd,
		getUserAdById: getUserAdById
	}
}]);