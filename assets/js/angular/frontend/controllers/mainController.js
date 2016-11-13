/**
 * Created by Shah on 4/23/2016.
 */
angular.module("kp_clothes").controller('mainController', ['$scope','$rootScope',
                            '$http','$sce',
                            '$compile','$q','$state','$log',
        function ($scope,$rootScope,$http,$sce,$compile,$q,$state,$log) {
        $log.info("Main Controller");






            $scope.page_name = 'home';

            $scope.page_title = '';
            $scope.categories = {};
			$rootScope.search_videos = function(keywords){
						$rootScope.search_kewords = keywords;
						$state.go('search');
					}

            $scope.get_categories = function(){
                $http.get($rootScope.base_url+'home/get_categories')
                    .success(function (data) {
                        if(data!=null){
                           $scope.categories = data.categories;
                        }
                    })
                    .error(function (data,status,code) {
                        $log.debug(data);
                    });
            };
            $scope.get_categories();


        }
]);