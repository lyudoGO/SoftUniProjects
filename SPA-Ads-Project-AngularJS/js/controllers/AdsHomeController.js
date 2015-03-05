'use strict';

adsApp.controller('AdsHomeController', ['$scope', 'adsDataService', 'authenticationService', function($scope, adsDataService, authenticationService) {
	$('#title').text('Home');
/*	if (authenticationService.getUser()) {
		var userData = angular.fromJson(authenticationService.getUser());
		$scope.username = userData['username'];
		$scope.userAccessToken = userData['access_token'];
		$scope.isLogged = authenticationService.isLogged();
	};*/
	$scope.userParams.isUserAds = false;
	$scope.pageSize = 4;

    $scope.pagination = {
        current: 1
    };

    $scope.pageChanged = function(newPage) {
        getAllAds(newPage);
    };

	$scope.ready = false;
	$scope.isUserHome = false;
	$scope.isPublish = false;
	$scope.pageSize = 4;
	getAllAds(1);

	$scope.reload = function reload() {
		$scope.parameters.categoryId = '';
		$scope.parameters.townId = '';
		$('#title').text('Home');
		getAllAds(1);
	};

	function getAllAds(newPage) {
		adsDataService.getAllAds($scope.parameters.categoryId, $scope.parameters.townId, newPage, $scope.pageSize, 
			function(data, status, headers, config) {
				$scope.alertMsg('success', 'Ads was successfully loaded!');
				$scope.data = data;
				$scope.ready = true;
				$scope.totalAds = data.numItems;
			},
			function (data, status, headers, config) {
            	$scope.alertMsg('danger', 'Failed to load all ads. Please try again later.');
        	});
	}

	$scope.changePage = function changePage(page) {
		$scope.parameters.startPage = page;
	}
}]);


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