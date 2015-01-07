'use strict';

var adsApp = angular.module('adsApp', ['ngRoute', 'ngResource', 'LocalStorageModule'])
.constant('baseServiceUrl', 'http://softuni-ads.azurewebsites.net/api/')
.config(['$routeProvider', 'localStorageServiceProvider', function($routeProvider, localStorageServiceProvider) {
	$routeProvider.when('/', {
		templateUrl: 'templates/home.html',
		controller: 'AdsHomeController'
	});
	$routeProvider.when('/category/:categoriesId/town/:townsId', {
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
	$routeProvider.otherwise({
		redirectTo: '/'
	});

	/*// Web storage settings
	localStorageServiceProvider.setStorageType('localStorage');
	localStorageServiceProvider.setPrefix('adsApp');*/
}]);