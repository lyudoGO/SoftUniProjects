'use strict';

adsApp.controller('LogoutController', ['$scope', '$location', 'userDataService', 'authenticationService', function($scope, $location, userDataService, authenticationService) {
	$('#title').text('Logout');

	$scope.logout = function () {
		/*console.log($scope.userParams.userAccessToken);
*/		userDataService.logoutUser($scope.userParams.userAccessToken, 
								function (data) {
									$scope.userParams.isLogged = false;
									authenticationService.removeUser();
									$scope.alertMsg('success', data.message);
									$location.path('/');
								}, 
								function (data) {
									$scope.alertMsg('danger', data.message);
								});
	}
}]);