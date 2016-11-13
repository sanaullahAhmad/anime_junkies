/**
 * Created by Shah on 4/23/2016.
 */
//angular.module("kp_clothes").requires.push('owlcarousel');

angular.module("kp_clothes").controller('categoryController',['$scope','$rootScope','$state','$http','$stateParams','$log',function ($scope,$rootScope,$state,$http,$stateParams,$log) {
    $log.info("Category Controller");
	
	//$log.info($stateParams);
    // $state.current.data.pageTitle = "Hello";

    //angular.element(".selecter_1").selecter();
   // $log.debug(Products.test);
    $scope.owlConfigSingle = {
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        autoPlay: 4500,
        lazyLoad : true
    };
	
    $scope.videos = {};
	$scope.get_videos = function(){
		$http.get($rootScope.base_url+'home/get_videos/'+$stateParams.slug)
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
	/*if($stateParams.slug!=NULL)
	{
	$scope.catId=$stateParams.slug;
	}*/


}]);

