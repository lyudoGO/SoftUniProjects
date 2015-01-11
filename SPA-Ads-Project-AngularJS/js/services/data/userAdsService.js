'use strict';

adsApp.factory('userAdsService', ['$http', '$log', 'baseServiceUrl', function ($http, $log, baseServiceUrl) {
		
	function getAllUserAds(userAccessToken, startPage, pageSize, success, error) {
		$http({
				method: 'GET',
				headers: { Authorization: 'Bearer ' + userAccessToken },
				url: baseServiceUrl + 'user/ads/',
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

	function deactivateUserAd(userAccessToken, id, success, error) {
		$http({
				method: 'PUT',
				headers: { Authorization: 'Bearer ' + userAccessToken },
				url: baseServiceUrl + 'user/ads/deactivate/' + id
		})
		.success(function(data, status, headers, config) {
			error(data);
			success(data);
		})
		.error(function(data, status, headers, config) {
			error(data);
			$log.error(data);
		})
	}

	function publishAgainUserAd(userAccessToken, id, success, error) {
		$http({
				method: 'PUT',
				headers: { Authorization: 'Bearer ' + userAccessToken },
				url: baseServiceUrl + 'user/ads/publishagain/' + id
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
		getAllUserAds: getAllUserAds,
		deactivateUserAd: deactivateUserAd,
		publishAgainUserAd: publishAgainUserAd
	}
}]);