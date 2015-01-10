'use strict';

adsApp.controller('UserPostAdController', ['$scope', '$location', 'userPostAdService', 'authenticationService', 'categoriesDataService', 'townsDataService', function($scope, $location, userPostAdService, authenticationService, categoriesDataService, townsDataService) {
	$('#title').text('Publish New Ad');
	$scope.userAccessToken = $scope.userParams.userAccessToken;
/*	var userData = JSON.parse(angular.fromJson(localStorage.getItem('user')));
	$scope.userAccessToken = userData['access_token'];
	$scope.username = userData['username'];
	$scope.isLogged = authenticationService.isLogged();*/
	$scope.isPublish = true;
	$scope.isUserHome = true;

	$scope.dataAd = {
		title: '',
		text: '',
		imageDataUrl: '',
		categoryId: '',
		townId: ''
	};

	townsDataService.getAllTowns(function(data) {
		$scope.towns = data;
	});

	categoriesDataService.getAllCategories(function(data) {
		$scope.categories = data;
	});

	$scope.publishAd = function (userAccessToken, dataAd, filetype, base64) {
		$scope.dataAd.imageDataUrl = "data:" + filetype + ";base64," + base64;
		userPostAdService.postUserAd(userAccessToken, dataAd, 
			function(data, status, headers, config) {
				$location.path('/user/ads');
				$scope.alertMsg('success', 'Ad was successfully published!');
			},
			function (data, status, headers, config) {
            	$scope.alertMsg('danger', 'Publish ad failed. Please try again later.');
        	});
	}
	
	$scope.cancelAd = function (dataAd) {
		$location.path('/user/ads');
		$scope.alertMsg('warning', 'You canceled the publication of the ad!');
	}
}]);