'use strict';

adsApp.controller('UserAdsController', ['$scope', 'userAdsService', 'authenticationService', function($scope, userAdsService, authenticationService) {
	$scope.$parent.pageTitle = 'My Ads';
	var userAccessToken = '';
	$scope.isPublish = false;
	$scope.isUserHome = true;
	$scope.isLogged = authenticationService.isLogged();
		if (authenticationService.getUser()) {
		var userData = angular.fromJson(authenticationService.getUser());
		$scope.username = userData['username'];
	};
	if (authenticationService.getUser()) {
		var userData = angular.fromJson(authenticationService.getUser());
		userAccessToken = userData['access_token'];
	};

	$scope.status = '';

	$scope.filterByStatus = function(stat) {
		$scope.status = stat;
	};

	userAdsService.getAllUserAds(userAccessToken, function(data) {
		if (data.numItems == 0) {
			alert('No ads from this user!');
		};
		$scope.data = data;
		$scope.numPages = [];
		$scope.startPage = 1;
		for (var i = 0; i < data.numPages; i++) {
			$scope.numPages[i] = i + 1;
		};
	});

	$scope.DeactivateAd = function DeactivateAd(id) {
		userAdsService.deactivateUserAd(userAccessToken, id, function(data) {
			alert('Ad with id = ' + id + ' was deactivate!');
		});
	}

}]);