'use strict';

adsApp.controller('AdsHomeController', ['$scope', '$routeParams', 'adsDataService', 'authenticationService', function($scope, $routeParams, adsDataService, authenticationService) {
	$scope.pageTitle = 'Home';
	$scope.pageSize = 3;
	$scope.isLogged = authenticationService.isLogged();
	if (authenticationService.getUser()) {
		var userData = angular.fromJson(authenticationService.getUser());
		$scope.username = userData['username'];
	};
	
	$scope.logout = function () {
		authenticationService.removeUser();
		$scope.isLogged = false;
	}

	if($routeParams.page == undefined) {
		$scope.startPage = 1;
	} else {
		$scope.startPage = Number($routeParams.page);
	}
	if($routeParams.categoriesId == undefined) {
		$scope.categoriesId = '';
	} else {
		$scope.categoriesId = $routeParams.categoriesId;
	}
	
	if($routeParams.townsId == undefined) {
		$scope.townsId = '';
	} else {
		$scope.townsId = $routeParams.townsId;
	}

	adsDataService.getAllAds($scope.categoriesId, $scope.townsId, $scope.startPage, $scope.pageSize, function(data) {
		$scope.data = data;
		$scope.numPages = [];
		for (var i = 0; i < data.numPages; i++) {
			$scope.numPages[i] = i + 1;
		};
		
	});
}]);