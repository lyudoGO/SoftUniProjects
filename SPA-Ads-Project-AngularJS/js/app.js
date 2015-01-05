'use strict';

var adsApp = angular.module('adsApp', ['ngRoute'])
.config(function($routeProvider) {
	$routeProvider.when('/', {
		templateUrl: 'templates/home.html',
		controller: 'AdsController'
	});
	$routeProvider.when('/category/:categoriesId', {
		templateUrl: 'templates/home.html',
		controller: 'AdsController'
	});
	$routeProvider.when('/town/:townsId', {
		templateUrl: 'templates/home.html',
		controller: 'AdsController'
	});
		$routeProvider.when('/ads/page/:page', {
		templateUrl: 'templates/home.html',
		controller: 'AdsController'
	});
	$routeProvider.when('/login', {
		templateUrl: 'templates/login.html',
		controller: 'AdsController'
	});
	$routeProvider.when('/register', {
		templateUrl: 'templates/registration.html',
		controller: 'AdsController'
	});
	$routeProvider.otherwise({
		redirectTo: '/'
	});
});