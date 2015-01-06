'use strict';

adsApp.directive('rightPublicSidebar', function() {
	return {
		controller: 'AdsHomeController',
		restrict: 'E',
		templateUrl:'templates/right-public-sidebar.html',
		//replace: true
	};
});