/**
 * Created by Shah on 4/23/2016.
 */
angular.module("kp_clothes").controller('attributesController',  ['$scope','$rootScope',
                                                              '$http','Upload','$sce',
                                                              '$compile','$q','$log',
        function ($scope,$rootScope,$http,Upload,$sce,$compile,$q,$log)  {
            var button = '<button class="btn btn-danger" ng-click="cancel_request()" onClick=" HoldOn.close();" type="button">Cancel</button>';
            $scope.forms = {
                reset:{
                    option: function () {
                        $('.tab-info').addClass('active');
                        $scope.attr.option = { opt_id : 0,opt_type:'nap',opt_input_type:'text'};
                        $scope.attr.values = {};
                        $scope.forms.option.$setPristine();
                        $scope.forms.option.$dirty = false;
                        $scope.forms.option.$pristine = true;
                        $scope.forms.option.$submitted = false;
                    },
                    values: function(){
                        $scope.attr.value = {
                            id:0
                        };
                        $scope.forms.values.$setPristine();
                        $scope.forms.values.$dirty = false;
                        $scope.forms.values.$pristine = true;
                        $scope.forms.values.$submitted = false;
                    },
                    all :function(){
                        $scope.forms.reset.option();
                    }

                }
            };
            $scope.attr = {
                option: {
                    opt_id: 0
                },
                value:{},
                values:{}
            };
            $scope.attributes = {};
            $http.get($rootScope.base_url+'stitching/attributes')
                .success(function (data) {
                    $scope.attributes = data;
                });
            $scope.get_attrName = function(id){
                if($scope.attributes.length){
                    for(var i =0 ; i<$scope.attributes.length;i++){
                        if($scope.attributes[i].opt_id==id){
                             return $scope.attributes[i].opt_title;
                        }
                    }
                }
            };
            $scope.edit_attr = function(attr){
                $scope.attr.option = attr;
                $scope.attr.value = {};
                $scope.attr.option.opt_order = parseInt(attr.opt_order);
                $http.get($rootScope.base_url+'stitching/attribute/'+attr.opt_id)
                    .success(function (data) {
                        $scope.attr.values = {};
                        if(data!='false')
                        {
                            $scope.attr.values = data;
                        }

                    });
            };
            $scope.edit_attr_val = function(val){
                $scope.attr.value = val;
                $scope.attr.value.opv_price = parseFloat(val.opv_price);
            };
            $scope.set_values = function(){
                $scope.canceler = $q.defer();
                var options = {
                    theme:"sk-bounce",
                    message:'<h2>'+($scope.attr.value.id>0?'Updating':'Saving Record')+'</h2><h5>Please wait. Attribute value is going to be '+($scope.attr.option.opt_id>0?'updated':'stored')+'.</h5>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
                };
               // HoldOn.open(options);
                var $elem = angular.element("#holdon-overlay #compiled_button");
                $elem.replaceWith($compile(button)($scope));
                Upload.upload({
                    url: $rootScope.base_url+'stitching/set_value',
                    data: {file:$scope.attr.value.image,
                        id:$scope.attr.value.id,
                        opv_title:$scope.attr.value.opv_title,
                        opv_value:$scope.attr.value.opv_value,
                        option_id:$scope.attr.option.opt_id,
                        opv_price:$scope.attr.value.opv_price,
                        opv_info:$scope.attr.value.opv_info,
                        opv_for:$scope.attr.value.opv_for,
                        opv_visibility:$scope.attr.value.opv_visibility,
                        opv_default:$scope.attr.value.opv_default
                    },
                }).then(function(resp) {
                    // file is uploaded successfully
                    if(resp.data.type=='success'){
                        if(resp.data.id){
                            var new_val = $scope.attr.value;
                             new_val.id = parseInt(resp.data.id);

                                $scope.attr.values = [].concat(new_val,$scope.attr.values);


                            $scope.forms.reset.values();
                        }
                        notification("topright",resp.data.type,"fa "+(resp.data.type=='success'?' fa-check-circle vd_green':'fa-exclamation-circle vd_red')+"",resp.data.message+" ");
                    }else{
                        $scope.attr.value.errors = $sce.trustAsHtml(resp.data.message);
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
                    $scope.attr.value.progress = parseInt(100.0 * evt.loaded / evt.total);
                    if($scope.attr.value.progress>=99){
                        HoldOn.close();
                    }

                });
            };


            $scope.delete_value = function(id,index){
                $scope.canceler = $q.defer();
                var options = {
                    theme:"sk-bounce",
                    message:'<h2>'+($scope.attr.value.id>0?'Updating':'Saving Record')+'</h2><h5>Please wait. Attribute value is going to be '+($scope.attr.option.opt_id>0?'updated':'stored')+'.</h5>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
                };
                // HoldOn.open(options);
                var $elem = angular.element("#holdon-overlay #compiled_button");
                $elem.replaceWith($compile(button)($scope));
                $http.post($rootScope.base_url+'stitching/delete_value',{
                        data:{id:id},
                        timeout: $scope.canceler.promise
                    } )
                    .then(function(response){
                        if(response.data.message && response.data.type ){
                            if(response.data.type=='success'){
                                $scope.attr.values.splice(index,1);

                            }
                            notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");
                        }
                    }, function (response) {
                        //error
                        $log.warn(response);
                    }).then(function () {
                    // Compleate
                    $scope.loading=false;
                    HoldOn.close();
                });

            };

            $scope.delete_attr = function(id){
                if(id>0){
                    $scope.canceler = $q.defer();
                    var options = {
                        theme:"sk-bounce",
                        message:'<h2>Deleting Attribute</h2><h5>Please wait. An attribute is going to be deleted.</h5>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
                    };
                    HoldOn.open(options);
                    var $elem = angular.element("#holdon-overlay #compiled_button");
                    $elem.replaceWith($compile(button)($scope));
                    $scope.loading = true;
                    $http.post($rootScope.base_url+'stitching/delete_attr',{
                            data: {id:id},
                            timeout: $scope.canceler.promise
                        } )
                        .then(function(response){
                            if(response.data.message && response.data.type ) {
                                if (response.data.type == 'success') {
                                    $scope.forms.reset.all();
                                    angular.forEach($scope.attributes,function(new_val,index){
                                        if(new_val.opt_id == id){
                                            $scope.attributes.splice(index,1);
                                        }
                                    });
                                }
                                notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");

                            }
                        }, function (response) {
                            //error
                            $log.warn(response);
                        }).then(function () {
                        // Compleate
                        $scope.loading=false;
                        HoldOn.close();
                    });
                    $log.debug(id);

                }
            };


            $scope.update_attr = function(){
                    $scope.canceler = $q.defer();
                    var options = {
                        theme:"sk-bounce",
                        message:'<h2>'+($scope.attr.option.opt_id>0?'Updating':'Saving Record')+'</h2><h5>Please wait. Price for Combination is going to be '+($scope.attr.option.opt_id>0?'updated':'stored')+'.</h5>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
                    };
                    HoldOn.open(options);
                    var $elem = angular.element("#holdon-overlay #compiled_button");
                    $elem.replaceWith($compile(button)($scope));
                    $scope.loading = true;
                    $http.post($rootScope.base_url+'stitching/update_attr',{
                            data: $scope.attr.option,
                            timeout: $scope.canceler.promise
                        } )
                        .then(function(response){
                            if(response.data.message && response.data.type ) {
                                if (response.data.type == 'form_errors') {
                                    $scope.attr.option.errors = $sce.trustAsHtml(response.data.message);
                                } else {
                                    if (response.data.type == 'success' && response.data.id>0) {
                                        $scope.attr.option.opt_id =  parseInt(response.data.id);
                                        var len = $scope.attributes.length;
                                        $scope.attributes[len] = $scope.attr.option;
                                    }
                                    notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");
                                }
                            }
                        }, function (response) {
                            //error
                            $log.warn(response);
                        }).then(function () {
                        // Compleate
                        $scope.loading=false;
                        HoldOn.close();
                    });
            };

}]);
