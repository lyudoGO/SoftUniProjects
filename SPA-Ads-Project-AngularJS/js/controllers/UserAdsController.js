'use strict';

adsApp.controller('UserAdsController', ['$scope', '$location', '$routeParams', 'userAdsService', 'authenticationService', function($scope, $location, $routeParams, userAdsService, authenticationService) {
	$('#title').text('My Ads');
	$scope.userAccessToken = $scope.userParams.userAccessToken;
	console.log($scope.userAccessToken);
	$scope.parameters.pageSize = 3;
	$scope.isPublish = false;
	$scope.isUserHome = true;

	$scope.status = '';
	$scope.ready = true;

    $scope.pagination = {
        current: 1
    };

    $scope.pageChanged = function(newPage) {
        getAllAds(newPage);
    };

	$scope.filterByStatus = function(stat) {
		$scope.status = stat;
		if (stat == 'Inactive') {
			$scope.isInactive = true;
		} else {
			$scope.isInactive = false;
		};
	};

	getAllAds(1);

	function getAllAds(newPage) {
		userAdsService.getAllUserAds($scope.userAccessToken, newPage, $scope.parameters.pageSize,
			function(data, status, headers, config) {
				
				if (data.numItems == 0) {
					$scope.alertMsg('info', 'Your have not ads to load!');
				} else {
					$scope.alertMsg('success', 'Your ads was successfully loaded!');
				};
				$scope.data = data;
				$scope.totalAds = data.numItems;
			},
			function (data, status, headers, config) {
	        	$scope.alertMsg('danger', 'Failed to load your ads. Please try again later.');
	    	});
	}

	$scope.deactivateAd = function deactivateAd(id) {
		userAdsService.deactivateUserAd($scope.userAccessToken, id, 
			function(data, status, headers, config) {
				$location.path('/user/ads');
				$scope.alertMsg('success', 'Your ad = ' + id + ' was successfully deactivate!');
			},
			function (data, status, headers, config) {
	        	$scope.alertMsg('danger', 'Failed to deactivate your ad. Please try again later.');
	    	});
	}

	$scope.publishAgainUserAd = function publishAgainUserAd(id) {
		userAdsService.publishAgainUserAd($scope.userAccessToken, id, 
			function(data, status, headers, config) {
				$location.path('/user/ads');
				$scope.alertMsg('success', 'Your ad = ' + id + ' was successfully publish again!');
			},
			function (data, status, headers, config) {
	        	$scope.alertMsg('danger', 'Failed to publish your ad. Please try again later.');
	    	});
	}
}]);