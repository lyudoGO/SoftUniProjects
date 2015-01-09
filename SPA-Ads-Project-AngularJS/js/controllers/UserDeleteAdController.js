'use strict';

adsApp.controller('UserDeleteAdController', ['$scope', '$location', '$routeParams', 'userEditAdService', 'authenticationService', function($scope, $location, $routeParams, userEditAdService, authenticationService) {
	$('#title').text('Delete Ad');

	var userData = JSON.parse(angular.fromJson(localStorage.getItem('user')));
	$scope.userAccessToken = userData['access_token'];
	$scope.username = userData['username'];
	$scope.isLogged = authenticationService.isLogged();
	$scope.isPublish = false;
	$scope.isEdit = true;
	$scope.isUserHome = true;

	$scope.adId = $routeParams.adId;

	$scope.deleteAd = function (userAccessToken, id) {
		userEditAdService.deleteUserAd(userAccessToken, id, function(data) {
			$location.path('/user/ads');
			alert('Ad was delete!');
		});
	}

	userEditAdService.getUserAdById($scope.userAccessToken, $scope.adId, function(data) {
		$scope.dataAd = data;
		$scope.dataAd['changeImage'] = false;
		alert('Ad was get!');
	});
}]);