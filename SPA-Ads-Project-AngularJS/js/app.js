'use strict';

var adsApp = angular.module('adsApp', ['ngRoute', 'ngResource'])
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
	$routeProvider.when('/user/home', {
		templateUrl: 'templates/home.html',
		controller: 'AdsHomeController'
	});
	$routeProvider.when('/user/ads', {
		templateUrl: 'templates/user-home.html',
		controller: 'UserAdsController'
	});
	$routeProvider.when('/user/ads/publish', {
		templateUrl: 'templates/user-home.html',
		controller: 'UserPostAdController'
	});	
	$routeProvider.when('/user/ads/edit/:adId', {
		templateUrl: 'templates/user-edit-ads.html',
		controller: 'UserEditAdController'
	});
	$routeProvider.when('/user/ads/delete/:adId', {
		templateUrl: 'templates/user-delete-ad.html',
		controller: 'UserEditAdController'
	});
	$routeProvider.when('/user/profile', {
		templateUrl: 'templates/user-edit-profile.html',
		controller: 'UserEditProfileController'
	});
	$routeProvider.otherwise({
		redirectTo: '/'
	});
}]);