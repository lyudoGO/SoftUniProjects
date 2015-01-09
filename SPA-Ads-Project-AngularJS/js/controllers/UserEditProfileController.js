'use strict';

adsApp.controller('UserEditProfileController', ['$scope', '$location', '$routeParams', 'userEditProfileService', 'authenticationService', 'townsDataService', function($scope, $location, $routeParams, userEditProfileService, authenticationService, townsDataService) {

		$scope.$parent.pageTitle = 'Edit User Profile';
		var userData = JSON.parse(angular.fromJson(localStorage.getItem('user')));
		$scope.userAccessToken = userData['access_token'];
		$scope.username = userData['username'];
		$scope.passwordData = {};

		townsDataService.getAllTowns(function(data) {
			$scope.towns = data;
		});

		userEditProfileService.getUserProfile($scope.userAccessToken, function(data) {
			$scope.profileData = data;
		});

		$scope.editProfile = function editProfile(userAccessToken, profileData) {
			userEditProfileService.editUserProfile(userAccessToken, profileData, function(data) {
				$location.path('/user/ads');
				alert('User profile was updated!');
			});
		}

		$scope.changePassword = function changePassword(userAccessToken, passwordData) {
			userEditProfileService.changeUserPassword(userAccessToken, passwordData, function(data) {
				$location.path('/user/ads');
				alert('User password was changed!');
			});
		}

		$scope.cancelUpdateProfile = function cancelUpdateProfile(profileData) {
			$scope.profileData = {};
			alert('You are canceling updating!');
		}

		$scope.cancelChangePassword = function cancelChangePassword(passwordData) {
			$scope.passwordData = {};
			alert('ou are cancel changing password!');
		}
}]);