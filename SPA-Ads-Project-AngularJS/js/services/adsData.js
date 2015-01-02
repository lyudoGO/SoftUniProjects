'use strict';

adsApp.factory('adsData', function ($http, $log) {
		
	var getAllAds = function getAllAds(success) {
		$http({
				method: 'GET',
				url: 'http://softuni-ads.azurewebsites.net/api/ads'
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			$log.warn(data);
		})
	}

	var getAllTowns = function getAllTowns(success) {
		$http({
				method: 'GET',
				url: 'http://softuni-ads.azurewebsites.net/api/towns'
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			$log.warn(data);
		})
	}

	var getAllCategories = function getAllCategories(success) {
		$http({
				method: 'GET',
				url: 'http://softuni-ads.azurewebsites.net/api/categories'
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			$log.warn(data);
		})
	}

	return {
		getAllAds: getAllAds,
		getAllTowns: getAllTowns,
		getAllCategories: getAllCategories
	}
});