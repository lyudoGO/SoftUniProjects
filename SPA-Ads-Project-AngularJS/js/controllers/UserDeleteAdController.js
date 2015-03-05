'use strict';

adsApp.controller('UserDeleteAdController', ['$scope', '$location', '$routeParams', 'userEditAdService', 'authenticationService', function($scope, $location, $routeParams, userEditAdService, authenticationService) {
	$('#title').text('Delete Ad');

	$scope.userAccessToken = $scope.userParams.userAccessToken;
	$scope.userParams.isUserAds = false;
/*	var userData = JSON.parse(angular.fromJson(localStorage.getItem('user')));
	$scope.userAccessToken = userData['access_token'];
	$scope.username = userData['username'];
	$scope.isLogged = authenticationService.isLogged();*/
	$scope.isPublish = false;
	$scope.isEdit = true;
	$scope.isUserHome = true;

	$scope.adId = $routeParams.adId;

	$scope.deleteAd = function (userAccessToken, id) {
		userEditAdService.deleteUserAd(userAccessToken, id, 
			function(data, status, headers, config) {
				$location.path('/user/ads');
				$scope.alertMsg('success', data.message);
			},
			function (data, status, headers, config) {
            	$scope.alertMsg('danger', 'Failed to delete ad. Please try again later.');
        	});
	}

	userEditAdService.getUserAdById($scope.userAccessToken, $scope.adId, 
		function(data, status, headers, config) {
			$scope.dataAd = data;
			$scope.alertMsg('success', 'Ad was successfully loaded!');
		},
		function (data, status, headers, config) {
        	$scope.alertMsg('danger', 'Failed to load ad by id. Please try again later.');
    	});
}]);