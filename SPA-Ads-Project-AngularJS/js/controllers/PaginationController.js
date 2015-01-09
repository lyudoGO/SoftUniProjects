'use strict';

adsApp.controller('PaginationController', ['$scope', '$log', function($scope, $log) {
	$scope.totalItems = 50;
    $scope.currentPage = 1;
    $scope.maxSize = 5;

    $scope.setPage = function (pageNo) {
      $scope.currentPage = pageNo;
    };
  	console.log($scope.totalItems);
  	console.log($scope.currentPage);
  	console.log($scope.maxSize);
    $scope.pageChanged = function() {
      $log.log('Page changed to: ' + $scope.currentPage);
    };
}]);
/*'PaginationService', , PaginationService*/