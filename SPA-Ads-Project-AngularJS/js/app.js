'use strict';

var adsApp = angular.module('adsApp', ['ngRoute'])
.config(function($routeProvider) {
	$routeProvider.when('/ads', {
		templateUrl: 'templates/home.html'
	});
	$routeProvider.when('/login', {
		templateUrl: 'templates/login.html'
	});
	$routeProvider.when('/register', {
		templateUrl: 'templates/registretion.html'
	});
	$routeProvider.otherwise('/register', {
		redirectTo: '/ads'
	});
});