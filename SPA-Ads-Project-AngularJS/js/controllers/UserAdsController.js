'use strict';

adsApp.controller('UserAdsController', ['$scope', 'userAdsService', 'authenticationService', function($scope, userAdsService, authenticationService) {
	var userAccessToken = '';
	$scope.isLogged = authenticationService.isLogged();
		if (authenticationService.getUser()) {
		var userData = angular.fromJson(authenticationService.getUser());
		$scope.username = userData['username'];
	};
	if (authenticationService.getUser()) {
		var userData = angular.fromJson(authenticationService.getUser());
		userAccessToken = userData['access_token'];
	};

	userAdsService.getAllUserAds(userAccessToken, function(data) {
		if (data.numItems == 0) {
			alert('No ads from this user!');
		};
		$scope.data = data;
	});
}]);