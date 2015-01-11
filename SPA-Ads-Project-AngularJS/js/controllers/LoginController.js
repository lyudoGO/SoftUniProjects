'use strict';

adsApp.controller('LoginController', ['$scope', '$location', 'userDataService', function($scope, $location, userDataService) {
	$('#title').text('Login');

	$scope.loginUser = function (user) {
		userDataService.loginUser(user)
						.$promise
						.then(function (data) {
							$scope.alertMsg('info', 'Your successfully login!');
							$location.path('/user/home');
						});
	}
}]);