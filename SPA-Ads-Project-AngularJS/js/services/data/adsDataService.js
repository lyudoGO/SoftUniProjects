'use strict';

adsApp.factory('adsDataService', function ($http, $log) {
		
	var getAllAds = function getAllAds(categoryId, townId, startPage, pageSize, success) {
		$http({
				method: 'GET',
				url: 'http://softuni-ads.azurewebsites.net/api/Ads?CategoryId=' + categoryId +
				'&TownId=' + townId + '&StartPage=' + startPage + '&PageSize=' + pageSize
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			$log.warn(data);
		})
	}

/*	var getAdsByCategory = function getAdsByCategory(categoryId, success) {
		$http({
				method: 'GET',
				url: 'http://softuni-ads.azurewebsites.net/api/ads?categoryId=' + categoryId
		})
		.success(function(data, status, headers, config) {
			success(data);
		})
		.error(function(data, status, headers, config) {
			$log.warn(data);
		})
	}*/

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