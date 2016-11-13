/**
 * Created by Shah on 4/23/2016.
 */
angular.module("kp_clothes").controller('productController',
                    ['$scope','$rootScope',
                     '$http','products',
                     '$stateParams','$log',
    function ($scope,$rootScope,$http,Products,$stateParams,$log) {
       // if($stateParams.display == null){
            //$state.go('home');
        //}
      //  $log.debug($stateParams.display)
        $scope.products ={};
        $scope.no_image = '';
        Products.get_products(function (data) {
               if(data.products !=null){
                    $scope.products = data.products;
                   $scope.no_image = data.no_image;
               }
        });
       //$log.debug($scope.products);
}]);