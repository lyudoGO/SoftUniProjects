'use strict';

adsApp.controller('AdsHomeController', ['$scope', '$routeParams', 'adsDataService', 'authenticationService', function($scope, $routeParams, adsDataService, authenticationService) {
	/*$('#title').text('Home');*/
	/*$scope.base.pageTitle = 'Home';*/
	if (authenticationService.getUser()) {
		var userData = angular.fromJson(authenticationService.getUser());
		$scope.username = userData['username'];
		$scope.isLogged = authenticationService.isLogged();
	};
	
	$scope.logout = function() {
		authenticationService.removeUser();
		$scope.isLogged = false;
	}

	$scope.ready = false;
/*	if($routeParams.page == undefined) {
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
	}*/
	getAllAds();

	$scope.reload = function reload() {
		$scope.parameters.categoryId = '';
		$scope.parameters.townId = '';
		$('#title').text('Home');
		getAllAds();
	};

	function getAllAds() {
		adsDataService.getAllAds($scope.parameters.categoryId, $scope.parameters.townId, $scope.parameters.startPage, $scope.parameters.pageSize, 
			function(data, status, headers, config) {
				$scope.alertMsg('success', 'Ads was successfully loaded!');
				$scope.data = data;
				$scope.ready = true;
				$scope.numPages = [];

				var startWithPage = $scope.parameters.startPage - 1;
				for (var i = 0; i < 5; i++, startWithPage++) {
					$scope.numPages[i] = startWithPage + 1;
				};
			},
			function (data, status, headers, config) {
            	$scope.alertMsg('danger', 'Failed to load all ads. Please try again later.');
        	});
	}

	$scope.changePage = function changePage(page) {
		$scope.parameters.startPage = page;
	}
}]);