'use strict';

adsApp.directive('rightTownSidebar', function() {
	return {
		controller: 'TownsController',
		restrict: 'E',
		templateUrl:'templates/directives/right-town-sidebar.html',
		//replace: true
	};
});