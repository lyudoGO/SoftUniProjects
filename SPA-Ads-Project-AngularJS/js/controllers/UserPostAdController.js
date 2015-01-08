'use strict';

adsApp.controller('UserPostAdController', ['$scope', '$location', 'userPostAdService', 'authenticationService', 'categoriesDataService', 'townsDataService', function($scope, $location, userPostAdService, authenticationService, categoriesDataService, townsDataService) {
	$scope.$parent.pageTitle = 'Publish New Ad';
	var userData = JSON.parse(angular.fromJson(localStorage.getItem('user')));
	$scope.userAccessToken = userData['access_token'];
	$scope.username = userData['username'];
	$scope.isLogged = authenticationService.isLogged();
	$scope.isPublish = true;
	$scope.isUserHome = true;
/*	console.log(angular.fromJson(localStorage.getItem('user')));
	if (authenticationService.getUser()) {
		var userData = angular.fromJson(authenticationService.getUser());
		$scope.username = userData['username'];
	};
	if (authenticationService.getUser()) {
		var userData = angular.fromJson(authenticationService.getUser());
		userAccessToken = userData['access_token'];
	};*/

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

	$scope.publishAd = function (userAccessToken, dataAd) {
		userPostAdService.postUserAd(userAccessToken, dataAd, function(data) {
			$location.path('/user/ads');
		});
	}
	
	$scope.cancelAd = function (dataAd) {
		$scope.dataAd = {};
	}
}]);