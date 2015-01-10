'use strict';

adsApp.controller('BaseController', ['$scope', 'authenticationService', function($scope, authenticationService) {
	$scope.alertMsg = false;
	$('#title').text('Home');
	$scope.parameters = {
		startPage: 1,
		pageSize: 4,
		categoryId: '',
		townId: '',
		categoryName: '',
		townName: '',
		pageTitle: 'Home'
	};

	if (authenticationService.getUser()) {
		var userData = angular.fromJson(authenticationService.getUser());
		$scope.username = userData['username'];
		$scope.isLogged = authenticationService.isLogged();
	};
	
	$scope.logout = function () {
		authenticationService.removeUser();
		$scope.isLogged = false;
	}
}]);