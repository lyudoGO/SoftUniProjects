'use strict';

adsApp.controller('BaseController', ['$scope', 'authenticationService', 'alertsService', function($scope, authenticationService, alertsService) {
	$('#title').text('Home');
	$scope.parameters = {
		startPage: 1,
		pageSize: 4,
		categoryId: '',
		townId: '',
		categoryName: '',
		townName: '',
	};

	$scope.userParams = {
		username: '',
		userAccessToken: '',
		isLogged: ''
	}

	if (authenticationService.getUser()) {
		var userData = angular.fromJson(authenticationService.getUser());
		$scope.userParams.username = userData['username'];
		$scope.userParams.userAccessToken = userData['access_token'];
		$scope.userParams.isLogged = authenticationService.isLogged();
	};
	
	$scope.logout = function () {
		authenticationService.removeUser();
		$scope.userParams.isLogged = false;
	}

	$scope.alertMsg = function (type, message) {
		alertsService.showAlerts(type, message);
	}
}]);