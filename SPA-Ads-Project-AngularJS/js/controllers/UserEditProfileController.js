'use strict';

adsApp.controller('UserEditProfileController', ['$scope', '$location', '$routeParams', 'userEditProfileService', 'authenticationService', 'townsDataService', function($scope, $location, $routeParams, userEditProfileService, authenticationService, townsDataService) {

		$('#title').text('Edit User Profile');
		$scope.userAccessToken = $scope.userParams.userAccessToken;
		console.log($scope.userAccessToken);
		$scope.userParams.isUserAds = false;
/*		var userData = JSON.parse(angular.fromJson(localStorage.getItem('user')));
		$scope.userAccessToken = userData['access_token'];
		$scope.username = userData['username'];
		$scope.isLogged = authenticationService.isLogged();*/

		$scope.passwordData = {};

/*		townsDataService.getAllTowns(function(data) {
			$scope.towns = data;
		});*/

		userEditProfileService.getUserProfile($scope.userAccessToken, 
			function(data) {
				$scope.alertMsg('success', 'User profile was successfully load!');
				$scope.profileData = data;
			},
			function (data, status, headers, config) {
            	$scope.alertMsg('danger', 'Failed to get progile. Please try again later.');
        	});

		$scope.editProfile = function editProfile(userAccessToken, profileData) {
			userEditProfileService.editUserProfile(userAccessToken, profileData, 
				function(data, status, headers, config) {
					$scope.alertMsg('success', 'User profile was successfully updated!');
					$location.path('/user/ads');
				},
				function (data, status, headers, config) {
                	$scope.alertMsg('danger', 'Profile edit failed. ' + data.message);
            	});
		}

		$scope.changePassword = function changePassword(userAccessToken, passwordData) {
			userEditProfileService.changeUserPassword(userAccessToken, passwordData, 
				function(data, status, headers, config) {
					$scope.alertMsg('success', 'User password was successfully changed!');
					$location.path('/user/ads');
				},  
				function (data, status, headers, config) {
                	$scope.alertMsg('danger', 'Password changed failed. ' + data.message );
            	});
		}

		$scope.cancelUpdateProfile = function cancelUpdateProfile() {
			$location.path('/user/ads');
			$scope.alertMsg('info', $scope.profileData.name + ' canceled the update profile!');
		}

		$scope.cancelChangePassword = function cancelChangePassword() {
			$location.path('/user/ads');
			$scope.alertMsg('info', $scope.profileData.name + ' canceled the change passowrd!');
		}
}]);