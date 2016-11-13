/**
 * Created by Shah on 4/23/2016.
 */
//angular.module("kp_clothes").requires.push('owlcarousel');

angular.module("kp_clothes").controller('do_logoutController',['$scope','$rootScope','$state','$http','$stateParams','$log',function ($scope,$rootScope,$state,$http,$stateParams,$log) {
    $log.info("Log out Controller");
    $scope.delete_session = function ()
    {
        $.get($rootScope.base_url+"home/do_logout", function(data, status){

                window.location.href=$rootScope.base_url;

        });
    }
    $scope.delete_session();


}]);


