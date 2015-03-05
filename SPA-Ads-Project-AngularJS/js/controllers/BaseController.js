'use strict';

adsApp.controller('BaseController', ['$scope', 'authenticationService', 'alertsService', 'userDataService', 'categoriesDataService', 'townsDataService', function($scope, authenticationService, alertsService, userDataService, categoriesDataService, townsDataService) {
	$('#title').text('Home');
	$scope.parameters = {
		startPage: '',
		pageSize: '',
		categoryId: '',
		townId: '',
		categoryName: '',
		townName: '',
	};

	$scope.userParams = {
		username: '',
		userAccessToken: '',
		isLogged: false,
		isUserAds: false
	}

	/*$scope.userParams.isLogged = false;*/

	if (authenticationService.getUser()) {
		var userData = angular.fromJson(authenticationService.getUser());
		$scope.userParams.username = userData['username'];
		$scope.userParams.userAccessToken = userData['access_token'];
		$scope.userParams.isLogged = true;
	};
	
/*	$scope.logout = function () {
/*		authenticationService.removeUser();
		$scope.alertMsg('info', 'Your are successfully loggout!');
		$scope.userParams.isLogged = false;
		userDataService.logoutUser()
								.$promise
								.then(function (data) {
									$scope.userParams.isLogged = false;
									$scope.alertMsg('info', data.message);
									$location.path('/');
								}, function(data) {
									$scope.alertMsg('danger', data.message);
								});
	}*/

/*	townsDataService.getAllTowns(function(data) {
		$scope.towns = data;
	});

	categoriesDataService.getAllCategories(function(data) {
		$scope.categories = data;
	});*/

	$scope.alertMsg = function (type, message) {
		alertsService.showAlerts(type, message);
	}

	$scope.towns = {};
	$scope.categories = {};

	$scope.filterByStatus = function(stat) {
		$scope.status = stat;
		console.log($scope.status);
		if (stat == 'Inactive') {
			$scope.isInactive = true;
		} else {
			$scope.isInactive = false;
		};
	};
}]);