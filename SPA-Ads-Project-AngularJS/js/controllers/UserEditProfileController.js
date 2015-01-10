'use strict';

adsApp.controller('UserEditProfileController', ['$scope', '$location', '$routeParams', 'userEditProfileService', 'authenticationService', 'townsDataService', function($scope, $location, $routeParams, userEditProfileService, authenticationService, townsDataService) {

		$('#title').text('Edit User Profile');
		$scope.userAccessToken = $scope.userParams.userAccessToken;
/*		var userData = JSON.parse(angular.fromJson(localStorage.getItem('user')));
		$scope.userAccessToken = userData['access_token'];
		$scope.username = userData['username'];*/
		$scope.passwordData = {};

		townsDataService.getAllTowns(function(data) {
			$scope.towns = data;
		});

		userEditProfileService.getUserProfile($scope.userAccessToken, function(data) {
			$scope.profileData = data;
		});

		$scope.editProfile = function editProfile(userAccessToken, profileData) {
			userEditProfileService.editUserProfile(userAccessToken, profileData, 
				function(data, status, headers, config) {
					$scope.alertMsg('success', 'User profile was successfully updated!');
					$location.path('/user/ads');
				},
				function (data, status, headers, config) {
                	$scope.alertMsg('danger', 'Profile edit failed. Please try again later.');
            	});
		}

		$scope.changePassword = function changePassword(userAccessToken, passwordData) {
			userEditProfileService.changeUserPassword(userAccessToken, passwordData, 
				function(data, status, headers, config) {
					$scope.alertMsg('success', 'User password was successfully changed!');
					$location.path('/user/ads');
				},  
				function (data, status, headers, config) {
                	$scope.alertMsg('danger', 'Password change failed. Please try again later.');
            	});
		}

		$scope.cancelUpdateProfile = function cancelUpdateProfile(profileData) {
			$location.path('/user/ads');
			$scope.alertMsg('info', 'You canceled the update profile!');
		}

		$scope.cancelChangePassword = function cancelChangePassword(passwordData) {
			$location.path('/user/ads');
			$scope.alertMsg('info', 'You canceled the change passowrd!');
		}
}]);