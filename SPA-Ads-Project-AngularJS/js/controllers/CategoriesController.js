'use strict';

adsApp.controller('CategoriesController', ['$scope', '$routeParams', 'categoriesDataService', function($scope, $routeParams, categoriesDataService) {

	categoriesDataService.getAllCategories(function(resp) {
		$scope.categories = resp;
	});
}]);