'use strict';

adsApp.controller('CategoriesController', ['$scope', 'categoriesDataService', function($scope, categoriesDataService) {
	categoriesDataService.getAllCategories(function(resp) {
		$scope.categories = resp;
	});
}]);