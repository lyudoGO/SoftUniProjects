'use strict';

adsApp.controller('CategoriesController', ['$scope', '$routeParams', 'categoriesDataService', function($scope, $routeParams, categoriesDataService) {

	function getCategoryId(id) {
		$routeParams.categoriesId = id;
	}

	categoriesDataService.getAllCategories(function(resp) {
		$scope.categories = resp;
	});
}]);