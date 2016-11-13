/**
 * Created by Shah on 4/23/2016.
 */
//angular.module("kp_clothes").requires.push('owlcarousel');

angular.module("kp_clothes").controller('registerController',['$scope','$rootScope','$state','$http','$stateParams','$log',function ($scope,$rootScope,$state,$http,$stateParams,$log) {
    $log.info("register Controller");
     $scope.check_cond = false;
    $scope.search_emails = function(){
        $scope.check_cond = false;
        //event.preventDefault();
        $log.debug($scope.keywords);
        $http.post($rootScope.base_url+'home/search_emails', { "data" : $scope.email})
            .success(function (data) {
                if(data!=null){
                    //alert(data);
                    if (data == 'true') {
                        $scope.check_cond = false;
                        //$('#registerform').submit();
                        //$(".btn-register").prop("disabled",false);
                        }
                    else {

                        $scope.check_cond = true;
                        $('#registerform').submit();
                        //$(".btn-register").prop("disabled",true);
                    }
                }
            })
            .error(function (data,status,code) {
                $log.debug(data);
            });
    };


}]);


