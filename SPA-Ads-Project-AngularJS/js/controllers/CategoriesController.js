'use strict';

adsApp.controller('CategoriesController', ['$scope', 'categoriesDataService', function($scope, categoriesDataService) {
	categoriesDataService.getAllCategories(function(resp) {
		$scope.categories = resp;
	});

	$scope.getCategoryId = function getCategoryId(id, name) {
		$scope.parameters.categoryId = id;
		$scope.parameters.categoryName = name;
		/*alert($scope.parameters.categoryId);*/
	};

	$scope.cancelCategoryId = function cancelCategoryId() {
		$scope.parameters.categoryId = '';
		$scope.parameters.categoryName = '';
		/*alert($scope.parameters.categoryId);*/
	}
}]);