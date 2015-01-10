'use strict';

adsApp.controller('LoginController', ['$rootScope', '$scope', '$location', 'userDataService', function($rootScope, $scope, $location, userDataService) {
	$scope.parameters.pageTitle = 'Login';
	$('#title').text('Login');
	
	$scope.loginUser = function (user) {
		userDataService.loginUser(user)
						.$promise
						.then(function (data) {
							$location.path('/user/ads');
						});
	}
}]);