'use strict';

var adsApp = angular.module('adsApp', ['ngRoute'])
.config(function($routeProvider) {
	$routeProvider.when('/', {
		templateUrl: 'templates/home.html'
	});
	$routeProvider.when('/ads', {
		templateUrl: 'templates/home.html'
	});
	$routeProvider.when('/login', {
		templateUrl: 'templates/login.html'
	});
	$routeProvider.when('/register', {
		templateUrl: 'templates/registration.html'
	});
	$routeProvider.otherwise({
		redirectTo: '/ads'
	});
});