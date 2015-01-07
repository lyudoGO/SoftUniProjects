'use strict';

adsApp.controller('LoginController', ['$rootScope', '$scope', '$location', 'userDataService', function($rootScope, $scope, $location, userDataService) {
	/*$('#title').text('Login');*/

	$scope.loginUser = function (user) {
		userDataService.loginUser(user)
						.$promise
						.then(function (data) {
							$location.path('/');
						});
	}
}]);