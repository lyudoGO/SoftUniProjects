'use strict';

var adsApp = angular.module('adsApp', ['ngRoute'])
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
		controller: 'AdsHomeController'
	});
	$routeProvider.when('/register', {
		templateUrl: 'templates/registration.html',
		controller: 'AdsHomeController'
	});
	$routeProvider.otherwise({
		redirectTo: '/'
	});
}]);