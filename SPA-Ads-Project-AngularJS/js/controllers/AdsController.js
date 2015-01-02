'use strict';

adsApp.controller('AdsController', function($scope, adsData) {
	$scope.title = 'Home';
	adsData.getAllAds(function(resp) {
		$scope.data = resp;
	});
	adsData.getAllTowns(function(resp) {
		$scope.towns = resp;
	});
})