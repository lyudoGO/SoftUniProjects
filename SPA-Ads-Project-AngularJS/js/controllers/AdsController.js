'use strict';

adsApp.controller('AdsController', function($scope, $routeParams, adsData) {
	$scope.title = 'Home';
	adsData.getAllAds(function(resp) {
		$scope.data = resp;
	});
	adsData.getAllTowns(function(resp) {
		$scope.towns = resp;
	});
	adsData.getAllCategories(function(resp) {
		$scope.categories = resp;
	});
})