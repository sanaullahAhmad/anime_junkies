/**
 * Created by Shah on 4/23/2016.
 */
//angular.module("kp_clothes").requires.push('owlcarousel');

angular.module("kp_clothes").controller('homeController',['$scope','$rootScope','$state','$http','$stateParams','$log',function ($scope,$rootScope,$state,$http,$stateParams,$log) {
    $log.info("Home Controller");
   $scope.$parent.page_title =   $state.current.data.pageTitle + ' - ' + $scope.$parent.page_title;
    $scope.owlConfig = {
        slideSpeed : 300,
        paginationSpeed : 400,
       /* autoPlay: 4500,*/
        lazyLoad : true
    };

    $scope.series_videos = {};
    $scope.get_series_videos = function(){
        $http.get($rootScope.base_url+'home/get_videos/anime-series')
            .success(function (data) {
                if(data!=null){
                    $scope.series_videos = data.videos;
                }
            })
            .error(function (data,status,code) {
                $log.debug(data);
            });
    };
    $scope.get_series_videos();


    $scope.film_videos = {};
    $scope.get_film_videos = function(){
        $http.get($rootScope.base_url+'home/get_videos/anime-series')
            .success(function (data) {
                if(data!=null){
                    $scope.film_videos = data.videos;
                }
            })
            .error(function (data,status,code) {
                $log.debug(data);
            });
    };
    $scope.get_film_videos();

}]);

