'use strict';

adsApp.directive('rightCategorySidebar', function() {
	return {
		controller: 'CategoriesController',
		restrict: 'E',
		templateUrl:'templates/directives/right-category-sidebar.html',
		//replace: true
	};
});