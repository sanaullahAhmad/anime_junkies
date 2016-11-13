/**
 * Created by Shah on 4/23/2016.
 */
//angular.module("kp_clothes").requires.push('owlcarousel');

angular.module("kp_clothes").controller('searchController',['$scope','$rootScope','$state','$http','$stateParams','$log',function ($scope,$rootScope,$state,$http,$stateParams,$log) {
    $log.info("Search Controller");
	
	$scope.url = $rootScope.base_url+'home/search_videos/'; // The url of our search
	$scope.videos = {};
	$scope.get_videos = function(){
	$log.debug($scope.keywords);	
	$http.post($scope.url, { "data" : $scope.keywords})
		.success(function (data) {
			if(data!=null){
			   $scope.videos = data.videos;
			}
		})
		.error(function (data,status,code) {
			$log.debug(data);
		});
	};
   $scope.get_videos();
	
	
	
	

}]);

