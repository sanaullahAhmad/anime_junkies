/**
 * Created by Shah on 4/23/2016.
 */
angular.module("kp_clothes").controller('employeeController',['$scope','$http','$rootScope', 'Upload', '$sce',
    '$compile',
    '$q',
    '$stateParams',
    '$timeout',
    '$log',
   function ($scope,$http,$rootScope,Upload,$sce,$compile,$q,$stateParams,$timeout,$log) {
    $log.info("Employee Controller");
    var button = '<button class="btn btn-danger" ng-click="cancel_request()" onClick=" HoldOn.close();" type="button">Cancel</button>';
    var message = '<h1>Please wait</h1><h4>Please wait. The action is going to be completed in a moment.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>';
    var options = {
        theme:"sk-bounce",
        message: message
    };

    $scope.designation ={};
    if (window.location.hash!='#/employees/new'){
        $http.get($rootScope.base_url+'user/view')
            .success(function (data) {
                $scope.employees = data.users;
            })
            .error(function (data,status) {

            });
    }else {
        $http.get($rootScope.base_url+'user/designation_list')
            .success(function (data) {
                $scope.designation = data;
            });
    }
    $scope.add_user = function(employee){
        $scope.progress = 0;
        var options = {
            theme:"sk-bounce",
            // If theme == "custom" , the content option will be available to customize the logo
            message:'<h1>Progress : '+ $scope.progress +' %</h1><h4>Please wait. User is going to be inserted.</h4>.'
        };
        HoldOn.open(options);
        Upload.upload({
            url: $rootScope.base_url+'user/save',
            data: employee
        }).then(function(resp) {
            if(resp.data.message && resp.data.type) {
                if(resp.data.type=='success'){
                    $scope.employee = {};
                }
                notification("topright", resp.data.type, "fa " + (resp.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(resp.data.message) + " ");
            }

        }, function (response) {
            if(response.status=='404'){
                var message = "Error 404: The page you are looking for, not found."
            }else {
                var message = response.statusText;
            }
            notification("topright","error","fa fa-exclamation-circle vd_red",message);
        }, function (evt) {
            //event for progress bar
            $scope.progress = parseInt(100.0 * evt.loaded / evt.total);
            $log.info($scope.progress);
            if($scope.progress>=99){
                HoldOn.close();
            }

        });


    }

}]);