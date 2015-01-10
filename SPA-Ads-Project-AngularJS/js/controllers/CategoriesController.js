'use strict';

adsApp.controller('CategoriesController', ['$scope', 'categoriesDataService', function($scope, categoriesDataService) {
	categoriesDataService.getAllCategories(
		function(data, status, headers, config) {
			$scope.alertMsg('success', 'Categories was successfully loaded!');
			$scope.categories = data;
		},
		function (data, status, headers, config) {
        	$scope.alertMsg('danger', 'Failed to load categories. Please try again later.');
    	});

	$scope.getCategoryId = function getCategoryId(id, name) {
		$scope.parameters.categoryId = id;
		$scope.parameters.categoryName = name;
		$scope.parameters.startPage = 1;
	};

	$scope.cancelCategoryId = function cancelCategoryId() {
		$scope.parameters.categoryId = '';
		$scope.parameters.categoryName = '';
		$scope.parameters.startPage = 1;
	}
}]);