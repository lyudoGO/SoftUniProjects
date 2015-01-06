'use strict';

adsApp.controller('AdsHomeController', function($scope, $routeParams, adsDataService) {
	$('#title').text('Home');
	$scope.pageSize = 3;
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
	adsDataService.getAllTowns(function(resp) {
		$scope.towns = resp;
	});
	adsDataService.getAllCategories(function(resp) {
		$scope.categories = resp;
	});
})