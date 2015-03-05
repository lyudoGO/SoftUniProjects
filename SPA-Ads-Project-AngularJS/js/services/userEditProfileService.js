'use strict';

adsApp.factory('userEditProfileService', ['$http', '$log', 'baseServiceUrl', function ($http, $log, baseServiceUrl) {
		
	function getUserProfile(userAccessToken, success, error) {
		$http({
				method: 'GET',
				headers: { Authorization: 'Bearer ' + userAccessToken },
				url: baseServiceUrl + 'user/profile/'
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			error(data);
			$log.error(data);
		})
	}

	function editUserProfile(userAccessToken, userData, success, error) {
		$http({
				method: 'PUT',
				headers: { Authorization: 'Bearer ' + userAccessToken },
				url: baseServiceUrl + 'user/profile/',
				data: JSON.stringify(userData)
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			error(data);
			$log.error(data);
		})
	}

	function changeUserPassword(userAccessToken, userData, success, error) {
		$http({
				method: 'PUT',
				headers: { Authorization: 'Bearer ' + userAccessToken },
				url: baseServiceUrl + 'user/changePassword/',
				data: JSON.stringify(userData)
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
		getUserProfile: getUserProfile,
		editUserProfile: editUserProfile,
		changeUserPassword: changeUserPassword
	}
}]);