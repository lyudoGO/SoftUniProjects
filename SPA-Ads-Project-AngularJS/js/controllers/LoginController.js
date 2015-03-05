'use strict';

adsApp.controller('LoginController', ['$scope', '$location', 'userDataService', 'authenticationService', function($scope, $location, userDataService, authenticationService) {
	$('#title').text('Login');

	$scope.loginUser = function (user) {
		userDataService.loginUser(user, 
						function (data) {
							authenticationService.saveUser(angular.toJson(data));
							var userData = angular.fromJson(authenticationService.getUser());
							$scope.userParams.isLogged = true;
							$scope.userParams.username = userData['username'];
							$scope.userParams.userAccessToken = userData['access_token'];
							$scope.alertMsg('info', 'Your successfully login!');
							$location.path('/user/home');
						}, 
						function (data) {
							$scope.alertMsg('danger', data.message);
						});
/*		userDataService.loginUser(user)*/
/*						.$promise
						.then(function (data) {
							$scope.userParams.isLogged = true;
							$scope.alertMsg('info', 'Your successfully login!');
							$location.path('/user/home');
						}, function(data) {
							$scope.alertMsg('danger', data.message);
						});*/
	}
}]);