'use strict';

adsApp.controller('AdsHomeController', ['$scope', '$routeParams', 'adsDataService', 'authenticationService', function($scope, $routeParams, adsDataService, authenticationService) {
	$('#title').text('Home');

    $scope.totalAds = 0;
    $scope.pagination = {
        current: 1
    };

    $scope.pageChanged = function(newPage) {
        getAllAds(newPage);
    };

	$scope.ready = false;
	$scope.isUserHome = false;

	getAllAds(1);

	$scope.reload = function reload() {
		$scope.parameters.categoryId = '';
		$scope.parameters.townId = '';
		$('#title').text('Home');
		getAllAds(1);
	};

	function getAllAds(newPage) {
		adsDataService.getAllAds($scope.parameters.categoryId, $scope.parameters.townId, newPage, $scope.parameters.pageSize, 
			function(data, status, headers, config) {
				$scope.alertMsg('success', 'Ads was successfully loaded!');
				$scope.data = data;
				$scope.ready = true;
				/*$scope.numPages = [];
				$scope.totalAds = data.numItems;
				var startWithPage = $scope.parameters.startPage - 1;
				for (var i = 0; i < 5; i++, startWithPage++) {
					$scope.numPages[i] = startWithPage + 1;
				};*/
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