'use strict';

adsApp.controller('LoginController', ['$scope', '$location', 'userDataService', function($scope, $location, userDataService) {
	/*$('#title').text('Login');*/
	$scope.pageTitle = 'Login';
	$scope.loginUser = function (user) {
		userDataService.loginUser(user)
						.$promise
						.then(function (data) {
							$location.path('/');
						});
	}
	console.log($scope.pageTitle);
}]);