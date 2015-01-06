'use strict';

adsApp.directive('rightPublicSidebar', function() {
	return {
		controller: 'TownsController',
		restrict: 'E',
		templateUrl:'templates/right-public-sidebar.html',
		//replace: true
	};
});