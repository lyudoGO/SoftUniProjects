'use strict';

adsApp.controller('UserEditAdController', ['$scope', '$location', '$routeParams', 'userEditAdService', 'authenticationService', 'categoriesDataService', 'townsDataService', function($scope, $location, $routeParams, userEditAdService, authenticationService, categoriesDataService, townsDataService) {
	$('#title').text('Edit Ad');
	var userData = JSON.parse(angular.fromJson(localStorage.getItem('user')));
	$scope.userAccessToken = userData['access_token'];
	$scope.username = userData['username'];
	$scope.isLogged = authenticationService.isLogged();
	$scope.isPublish = false;
	$scope.isEdit = true;
	$scope.isUserHome = true;

	$scope.adId = $routeParams.adId;

	$scope.isChangeImg = function(filetype, base64) {
		var inputImage = $('#inputImage').val();
		if ( inputImage != "") {
			$scope.dataAd.imageDataUrl = "data:" + filetype + ";base64," + base64;
			$scope.dataAd['changeImage'] = true;
			alert('Image will be changed!');
		} else {
			alert('You should choose image first!');
		};
		
	}

	var isDeleteImage = false;
	$scope.deleteImg = function() {
		$scope.dataAd['changeImage'] = true;
		isDeleteImage = true;
		alert('Image will be deleted from server!');
	}

	$scope.getBase64 = function(filetype, base64) {
		$scope.dataAd.imageDataUrl = "data:" + filetype + ";base64," + base64;
		console.log($scope.dataAd.imageDataUrl);
	}

	townsDataService.getAllTowns(function(data) {
		$scope.towns = data;
	});

	categoriesDataService.getAllCategories(function(data) {
		$scope.categories = data;
	});

	$scope.editAd = function (userAccessToken, dataAd, id) {
		
		if (isDeleteImage) {
			$scope.dataAd.imageDataUrl = null;
		};
		userEditAdService.editUserAd(userAccessToken, dataAd, id, function(data) {
			$location.path('/user/ads');
			alert('Ad was edit!');
		});
	}
		
	$scope.deleteAd = function (userAccessToken, id) {
		userEditAdService.deleteUserAd(userAccessToken, id, function(data) {
			$location.path('/user/ads');
			alert('Ad was delete!');
		});
	}

	userEditAdService.getUserAdById($scope.userAccessToken, $scope.adId, function(data) {
		$scope.dataAd = data;
		$scope.dataAd['changeImage'] = false;
		alert('Ad was get!');
	});

	$scope.cancelAd = function (dataAd) {
		$scope.dataAd = {};
		alert('You are canceling editing!');
	}
}]);