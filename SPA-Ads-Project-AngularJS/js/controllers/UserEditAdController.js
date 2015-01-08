'use strict';

adsApp.controller('UserEditAdController', ['$scope', '$location', '$routeParams', 'userEditAdService', 'authenticationService', 'categoriesDataService', 'townsDataService', function($scope, $location, $routeParams, userEditAdService, authenticationService, categoriesDataService, townsDataService) {
	$scope.$parent.pageTitle = 'Edit Ad';
	var userData = JSON.parse(angular.fromJson(localStorage.getItem('user')));
	$scope.userAccessToken = userData['access_token'];
	$scope.username = userData['username'];
	$scope.isLogged = authenticationService.isLogged();
	$scope.isPublish = false;
	$scope.isEdit = true;
	$scope.isUserHome = true;

	$scope.adId = $routeParams.adId;

	$scope.isChangeImg = function() {
		$scope.dataAd['changeImage'] = true;console.log($scope.dataAd.changeImage);
	}

	$scope.deleteImg = function() {
		$scope.dataAd['changeImage'] = true;
		$scope.dataAd['ImageDataUrl'] = null;
	}

	townsDataService.getAllTowns(function(data) {
		$scope.towns = data;
	});

	categoriesDataService.getAllCategories(function(data) {
		$scope.categories = data;
	});

	$scope.editAd = function (userAccessToken, dataAd, id) {
		userEditAdService.editUserAd(userAccessToken, dataAd, id, function(data) {
			$location.path('/user/ads');
			alert('Ad was edit!');
		});
	}
	
	userEditAdService.getUserAdById($scope.userAccessToken, $scope.adId, function(data) {
		$scope.dataAd = data;
		$scope.dataAd['changeImage'] = false;
		alert('Ad was get!');
		console.log($scope.adId);
	});

	$scope.cancelAd = function (dataAd) {
		$scope.dataAd = {};
	}
}]);