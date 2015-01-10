'use strict';

adsApp.controller('UserAdsController', ['$scope', '$location', '$routeParams', 'userAdsService', 'authenticationService', function($scope, $location, $routeParams, userAdsService, authenticationService) {
	$('#title').text('My Ads');
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
		if (stat == 'Inactive') {
			$scope.isInactive = true;
		} else {
			$scope.isInactive = false;
		};
	};

	userAdsService.getAllUserAds(userAccessToken, 
		function(data, status, headers, config) {
			
			if (data.numItems == 0) {
				$scope.alertMsg('info', 'Your are no ads to load!');
			} else {
				$scope.alertMsg('success', 'Your ads was successfully loaded!');
			};
			$scope.data = data;
			$scope.numPages = [];
			$scope.startPage = 1;
			for (var i = 0; i < data.numPages; i++) {
				$scope.numPages[i] = i + 1;
			};
		},
		function (data, status, headers, config) {
        	$scope.alertMsg('danger', 'Failed to load your ads. Please try again later.');
    	});

	$scope.deactivateAd = function deactivateAd(id) {
		userAdsService.deactivateUserAd(userAccessToken, id, 
			function(data, status, headers, config) {
				$location.path('/user/ads');
				$scope.alertMsg('success', 'Your ad = ' + id + ' was successfully deactivate!');
			},
			function (data, status, headers, config) {
	        	$scope.alertMsg('danger', 'Failed to deactivate your ad. Please try again later.');
	    	});
	}

	$scope.publishAgainUserAd = function publishAgainUserAd(id) {
		userAdsService.publishAgainUserAd(userAccessToken, id, 
			function(data) {
				$location.path('/user/ads');
				$scope.alertMsg('success', 'Your ad = ' + id + ' was successfully publish again!');
			},
			function (data, status, headers, config) {
	        	$scope.alertMsg('danger', 'Failed to publish your ad. Please try again later.');
	    	});
	}
}]);