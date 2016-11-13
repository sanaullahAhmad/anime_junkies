/**
 * Created by Shah on 4/23/2016.
 */
angular.module("kp_clothes").controller('mainController', ['$scope','$rootScope',
                            '$http','$sce','products',
                            '$stateParams','$compile','$q','$log',
        function ($scope,$rootScope,$http,$sce,Products,$stateParams,$compile,$q,$log) {
        $log.info("Main Controller");
            $scope.page_name = 'home';
            $scope.categories = '';
            Products.get_categories(function(categories){
                if(categories){
                    $scope.categories = categories;
                }
            });


      }
]);