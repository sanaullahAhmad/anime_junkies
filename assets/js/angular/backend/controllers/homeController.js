/**
 * Created by Shah on 4/23/2016.
 */
//angular.module("kp_clothes").requires.push('owlcarousel');

angular.module("kp_clothes").controller('homeController',['$scope','$state','$http','products','$stateParams','$log',function ($scope,$state,$http,Products,$stateParams,$log) {
    $log.info("Home Controller");
    // $state.current.data.pageTitle = "Hello";


   // $log.debug(Products.test);

}]);

