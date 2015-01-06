'use strict';

adsApp.directive('leftPublicSidebar', function() {
	return {
		controller: 'AdsHomeController',
		restrict: 'E',
		templateUrl:'templates/left-public-sidebar.html',
		//replace: true
	};
});