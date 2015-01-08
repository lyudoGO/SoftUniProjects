'use strict';

var adsApp = angular.module('adsApp', ['ngRoute', 'ngResource', 'LocalStorageModule'])
.constant('baseServiceUrl', 'http://softuni-ads.azurewebsites.net/api/')
.config(['$routeProvider', function($routeProvider) {
	$routeProvider.when('/', {
		templateUrl: 'templates/home.html',
		controller: 'AdsHomeController'
	});
	$routeProvider.when('/category/:categoriesId', {
		templateUrl: 'templates/home.html',
		controller: 'AdsHomeController'
	});
	$routeProvider.when('/town/:townsId', {
		templateUrl: 'templates/home.html',
		controller: 'AdsHomeController'
	});
		$routeProvider.when('/ads/page/:page', {
		templateUrl: 'templates/home.html',
		controller: 'AdsHomeController'
	});
	$routeProvider.when('/login', {
		templateUrl: 'templates/login.html',
		controller: 'LoginController'
	});
	$routeProvider.when('/register', {
		templateUrl: 'templates/registration.html',
		controller: 'RegisterController'
	});
	$routeProvider.when('/user/ads', {
		templateUrl: 'templates/user-home.html',
		controller: 'UserAdsController'
	});
	$routeProvider.when('/user/postAd', {
		templateUrl: 'templates/user-home.html',
		controller: 'UserPostAdController'
	});
	$routeProvider.otherwise({
		redirectTo: '/'
	});
}]);