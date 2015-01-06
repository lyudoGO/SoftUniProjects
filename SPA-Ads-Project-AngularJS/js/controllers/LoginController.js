'use strict';

adsApp.controller('LoginController', ['$scope', 'userDataService', function($scope, userDataService) {
	$('#title').text('Login');
	$scope.loginUser = function (user) {
		userDataService.loginUser(user);
	}
}]);