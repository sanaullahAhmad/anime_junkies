/**
 * Created by Shah on 4/23/2016.
 */
//angular.module("kp_clothes").requires.push('owlcarousel');

angular.module("kp_clothes").controller('facebook_loginController',['$scope','$rootScope','$state','$http','$stateParams','$log',function ($scope,$rootScope,$state,$http,$stateParams,$log) {
    $log.info("facebook login Controller");
    $scope.facebooklogin = function ()
    {
        window.location.href=$rootScope.base_url+"home/facebook_login";
    }
    $scope.facebooklogin();


}]);


