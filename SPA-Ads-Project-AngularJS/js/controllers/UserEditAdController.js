'use strict';

adsApp.controller('UserEditAdController', ['$scope', '$location', '$routeParams', 'userEditAdService', 'authenticationService', 'categoriesDataService', 'townsDataService', function($scope, $location, $routeParams, userEditAdService, authenticationService, categoriesDataService, townsDataService) {
	$('#title').text('Edit Ad');
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

	$scope.isChangeImg = function(filetype, base64) {
		var inputImage = $('#inputImage').val();
		if ( inputImage != "") {
			$scope.dataAd.imageDataUrl = "data:" + filetype + ";base64," + base64;
			$scope.dataAd['changeImage'] = true;
			$scope.alertMsg('info', 'Image will be changed!');
		} else {
			$scope.alertMsg('info', 'You should choose image first!');
		};
		
	}

	$scope.deleteImg = function() {
		$scope.dataAd['changeImage'] = true;
		$scope.dataAd.imageDataUrl = null;
		$scope.alertMsg('info', 'Image will be deleted from server!');
	}

	$scope.getBase64 = function(filetype, base64) {
		$scope.dataAd.imageDataUrl = "data:" + filetype + ";base64," + base64;
		/*console.log($scope.dataAd.imageDataUrl);*/
	}

/*	townsDataService.getAllTowns(function(data) {
		$scope.towns = data;
	});

	categoriesDataService.getAllCategories(function(data) {
		$scope.categories = data;
	});*/

	$scope.editAd = function (userAccessToken, dataAd, id) {
		userEditAdService.editUserAd(userAccessToken, dataAd, id, 
			function(data, status, headers, config) {
				$location.path('/user/ads');
				$scope.alertMsg('success', 'Ad was successfully edited!');
			},
			function (data, status, headers, config) {
            	$scope.alertMsg('danger', 'Edit ad failed. Please try again later.');
        	});
	}
		
	$scope.deleteAd = function (userAccessToken, id) {
		userEditAdService.deleteUserAd(userAccessToken, id, 
			function(data) {
				$location.path('/user/ads');
				$scope.alertMsg('success', 'Ad was successfully deleted!');
			},
			function (data, status, headers, config) {
            	$scope.alertMsg('danger', 'Delete ad failed. Please try again later.');
        	});
	}

	userEditAdService.getUserAdById($scope.userAccessToken, $scope.adId, 
		function(data, status, headers, config) {
			$scope.dataAd = data;
			$scope.dataAd['changeImage'] = false;
			$scope.alertMsg('success', 'Ad was successfully loaded!');
		},
		function (data, status, headers, config) {
        	$scope.alertMsg('danger', 'Failed to load ad by id. Please try again later.');
    	});

	$scope.cancelAd = function (dataAd) {
		$scope.dataAd = {};
		$scope.alertMsg('warning', 'You canceled the edition of the ad!');
	}
}]);