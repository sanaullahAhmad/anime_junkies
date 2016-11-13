/**
 * Created by Shah on 4/23/2016.
 */
angular.module("kp_clothes").controller('mbsController',
                    ['$scope','$rootScope',
                     '$http','Upload','$sce',
                     '$stateParams','$compile','$q','$log',
    function ($scope,$rootScope,$http,Upload,$sce,$stateParams,$compile,$q,$log) {
        $scope.base_path = $rootScope.base_path;
        $scope.brand = { loaded : false };
        $scope.size = { loaded : false };
        $scope.material = { loaded : false };
        var button = '<button class="btn btn-danger" ng-click="cancel_request()" onclick="HoldOn.close();" type="button">Cancel</button>';
        $scope.action_edit_brand = false;
        $scope.action_edit_size = false;
        $scope.action_edit_material = false;
        $scope.brands = {  };
        $scope.sizes = {  };
        $scope.materials = {  };


         /* ---------------------------------   Load Sizes --------------------- */
        $scope.load_brands = function (brand_id) {
            $scope.brand = { loaded : true };
            $http.get('product/brands' + (brand_id>0?'/'+brand_id:''))
                .success(function (data) {
                    if(brand_id>0 && data.id>0){
                        // for edit set values
                        $scope.brand = {
                                  id: data.id,
                                  name : data.name
                        };
                        $scope.action_edit_brand = true;
                    }else {
                        $scope.brands =  data;
                    }
                     // $log.info(data.categories);
                })
                .error(function (data,status,code) {

                });
        };


        /* ---------------------------------   Load sizes --------------------- */
        $scope.load_sizes = function (size_id) {
            $scope.size = { loaded : true };
            $http.get('product/sizes' + (size_id>0?'/'+size_id:''))
                .success(function (data) {
                    if(size_id>0 && data.id>0){
                        // for edit set values
                        $scope.size = {
                            id: data.id,
                            name : data.name
                        };
                        $scope.action_edit_size = true;
                    }else {
                        $scope.sizes =  data;
                    }
                    // $log.info(data.categories);
                })
                .error(function (data,status,code) {

                });
        };

        /* ---------------------------------   Load Materials --------------------- */
        $scope.load_materials = function (material_id) {
            $scope.material = { loaded : true };
            $http.get('product/materials' + (material_id>0?'/'+material_id:''))
                .success(function (data) {
                    if(material_id>0 && data.id>0){
                        // for edit set values
                        $scope.material = {
                            id: data.id,
                            name : data.name
                        };
                        $scope.action_edit_material = true;
                    }else {
                        $scope.materials =  data;
                    }
                    // $log.info(data.categories);
                })
                .error(function (data,status,code) {

                });
        };





        /* ---------------------------------   Abort  http request --------------------- */

       $scope.cancel_request = function () {
           $scope.canceler.resolve();
           delete  $scope.canceler;
       };

        /* ---------------------------------   Show Delete Dialog --------------------- */
        $scope.delete_dialog =function (brand_id,dialog_type) {
            var $dialog = angular.element("#delete_model");
            $dialog.modal();
            $scope.dialog_type = dialog_type;
            $scope.delete_id = brand_id;
        };





        /* ---------------------------------   Edit Brand --------------------- */
        $scope.edit_brand = function (brand_id) {
            $scope.canceler = $q.defer();
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:'<h1>Loading brand </h1><h4>Please wait. Brand information is going to be load.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $scope.load_brands(brand_id);
            HoldOn.close();
        };

        /* ---------------------------------   Edit Size --------------------- */
        $scope.edit_size = function (size_id) {
            $scope.canceler = $q.defer();
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:'<h1>Loading Size </h1><h4>Please wait. Size information is going to be load.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $scope.load_sizes(size_id);
            HoldOn.close();
        };

        /* ---------------------------------   Edit Material --------------------- */
        $scope.edit_material = function (material_id) {
            $scope.canceler = $q.defer();
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:'<h1>Loading Material </h1><h4>Please wait. Material information is going to be load.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $scope.load_materials(material_id);
            HoldOn.close();
        };




        /* ---------------------------------   Delete Brand --------------------- */
        $scope.delete_brand = function (brand_id) {
            $scope.delete_id = 0;
            if(brand_id>0){
                $scope.canceler = $q.defer();
                var options = {
                    theme:"sk-bounce",
                    // If theme == "custom" , the content option will be available to customize the logo
                    message:'<h1>Deleting brand </h1><h4>Please wait. One of the products brand is going to be deleted.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
                };
                HoldOn.open(options);
                var $elem = angular.element("#holdon-overlay #compiled_button");
                $elem.replaceWith($compile(button)($scope));
                $http.post($rootScope.base_url+'product/delete_brand/',
                    {
                        data: {id: brand_id },
                        timeout: $scope.canceler.promise
                    }
                    )
                    .then(
                        // ------- Success ---------
                        function (request) {
                            if(request.data){
                                $log.info(request.data);
                                if(request.data.type=="error"){
                                    $scope.brands['errors'] = $sce.trustAsHtml(request.data.message);
                                }else if(request.data.type=="success"){
                                    $scope.load_brands();
                                    $scope.action_edit_brand = false;
                                 }
                                notification("topright",request.data.type,"fa "+(request.data.type=='success'?' fa-check-circle vd_green':'fa-exclamation-circle vd_red')+"",$sce.trustAsHtml(request.data.message)+" ");


                            }

                        },function (data,status) {
                            $log.info(data);
                            $log.info(status);
                        }
                    )
                    .then(function () {
                        HoldOn.close();
                    });
            }
        };

        /* ---------------------------------   Delete Size --------------------- */
        $scope.delete_size = function (size_id) {
            $scope.delete_id = 0;
            if(size_id>0){
                $scope.canceler = $q.defer();
                var options = {
                    theme:"sk-bounce",
                    // If theme == "custom" , the content option will be available to customize the logo
                    message:'<h1>Deleting Size </h1><h4>Please wait. One of the products size is going to be deleted.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
                };
                HoldOn.open(options);
                var $elem = angular.element("#holdon-overlay #compiled_button");
                $elem.replaceWith($compile(button)($scope));
                $http.post($rootScope.base_url+'product/delete_size/',
                    {
                        data: {id: size_id },
                        timeout: $scope.canceler.promise
                    }
                    )
                    .then(
                        // ------- Success ---------
                        function (request) {
                            if(request.data){
                                $log.info(request.data);
                                if(request.data.type=="error"){
                                    $scope.sizes['errors'] = $sce.trustAsHtml(request.data.message);
                                }else if(request.data.type=="success"){
                                    $scope.load_sizes();
                                    $scope.action_edit_size = false;
                                }
                                notification("topright",request.data.type,"fa "+(request.data.type=='success'?' fa-check-circle vd_green':'fa-exclamation-circle vd_red')+"",$sce.trustAsHtml(request.data.message)+" ");


                            }

                        },function (data,status) {
                            $log.info(data);
                            $log.info(status);
                        }
                    )
                    .then(function () {
                        HoldOn.close();
                    });
            }
        };

        /* ---------------------------------   Delete Material --------------------- */
        $scope.delete_material = function (material_id) {
            $scope.delete_id = 0;
            if(material_id>0){
                $scope.canceler = $q.defer();
                var options = {
                    theme:"sk-bounce",
                    // If theme == "custom" , the content option will be available to customize the logo
                    message:'<h1>Deleting Material </h1><h4>Please wait. One of the products material is going to be deleted.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
                };
                HoldOn.open(options);
                var $elem = angular.element("#holdon-overlay #compiled_button");
                $elem.replaceWith($compile(button)($scope));
                $http.post($rootScope.base_url+'product/delete_material/',
                    {
                        data: {id: material_id },
                        timeout: $scope.canceler.promise
                    }
                    )
                    .then(
                        // ------- Success ---------
                        function (request) {
                            if(request.data){
                                if(request.data.type=="error"){
                                    $scope.materials['errors'] = $sce.trustAsHtml(request.data.message);
                                }else if(request.data.type=="success"){
                                    $scope.load_materials();
                                    $scope.action_edit_material = false;
                                }
                                notification("topright",request.data.type,"fa "+(request.data.type=='success'?' fa-check-circle vd_green':'fa-exclamation-circle vd_red')+"",$sce.trustAsHtml(request.data.message)+" ");


                            }

                        },function (data,status) {
                            $log.info(data);
                            $log.info(status);
                        }
                    )
                    .then(function () {
                        HoldOn.close();
                    });
            }
        };







        /* ---------------------------------   Update Brand --------------------- */
        $scope.update_brand = function(brand_id){
            $scope.canceler = $q.defer();
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:'<h1>Updating brand </h1><h4>Please wait. One of the product brand is going to be updated.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $http.post($rootScope.base_url+'product/update_brand/',
                         {
                             data: {name: $scope.brand.name, id: brand_id },
                             timeout: $scope.canceler.promise
                         }
                    )
                .then(
                    // ------- Success ---------
                    function (request) {
                        if(request.data){
                            $log.info(request.data);
                            if(request.data.type=="success"){
                                $scope.load_brands();
                                $scope.brand_form.$setPristine();
                                notification("topright",request.data.type,"fa "+(request.data.type=='success'?' fa-check-circle vd_green':'fa-exclamation-circle vd_red')+"",$sce.trustAsHtml(request.data.message)+" ");
                                $scope.action_edit_brand = false;
                            }else {
                                $scope.brands['errors'] = $sce.trustAsHtml(request.data.message);
                            }

                        }

                    },function (data,status) {
                        $log.info(data);
                        $log.info(status);
                    }
                )
                .then(function () {
                    HoldOn.close();
                });
        };

        /* ---------------------------------   Update Size --------------------- */
        $scope.update_size = function(size_id){
            $scope.canceler = $q.defer();
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:'<h1>Updating Size </h1><h4>Please wait. One of the product size is going to be updated.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $http.post($rootScope.base_url+'product/update_size/',
                {
                    data: {name: $scope.size.name, id: size_id },
                    timeout: $scope.canceler.promise
                }
                )
                .then(
                    // ------- Success ---------
                    function (request) {
                        if(request.data){
                            $log.info(request.data);
                            if(request.data.type=="success"){
                                $scope.load_sizes();
                                $scope.size_form.$setPristine();
                                notification("topright",request.data.type,"fa "+(request.data.type=='success'?' fa-check-circle vd_green':'fa-exclamation-circle vd_red')+"",$sce.trustAsHtml(request.data.message)+" ");
                                $scope.action_edit_size = false;
                            }else {
                                $scope.sizes['errors'] = $sce.trustAsHtml(request.data.message);
                            }

                        }

                    },function (data,status) {
                        $log.info(data);
                        $log.info(status);
                    }
                )
                .then(function () {
                    HoldOn.close();
                });
        };

        /* ---------------------------------   Update Materials --------------------- */
        $scope.update_material = function(material_id){
            $scope.canceler = $q.defer();
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:'<h1>Updating Material </h1><h4>Please wait. One of the product material is going to be updated.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $http.post($rootScope.base_url+'product/update_material/',
                {
                    data: {name: $scope.material.name, id: material_id },
                    timeout: $scope.canceler.promise
                }
                )
                .then(
                    // ------- Success ---------
                    function (request) {
                        $log.info(request);
                        if(request.data){
                            $log.info(request.data);
                            if(request.data.type=="success"){
                                $scope.load_materials();
                                $scope.material_form.$setPristine();
                                notification("topright",request.data.type,"fa "+(request.data.type=='success'?' fa-check-circle vd_green':'fa-exclamation-circle vd_red')+"",$sce.trustAsHtml(request.data.message)+" ");
                                $scope.action_edit_material = false;
                            }else {
                                $scope.materials['errors'] = $sce.trustAsHtml(request.data.message);
                            }

                        }

                    },function (data,status) {
                        $log.info(data);
                        $log.info(status);
                    }
                )
                .then(function () {
                    HoldOn.close();
                });
        };






        /* ---------------------------------   Add Brand --------------------- */
        $scope.add_brand = function(){
            $scope.canceler = $q.defer();
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:'<h1>Storing record </h1><h4>Please wait. A product brand is is going to be inserted into database table.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $http.post($rootScope.base_url+'product/add_brand/',
                {
                    data: {name: $scope.brand.name},
                    timeout: $scope.canceler.promise
                }
                )
                .then(
                    // ------- Success ---------
                    function (request) {
                        if(request.data){
                            if(request.data.type=="success"){
                                if($scope.brand.loaded==true) {
                                    $scope.load_brands();
                                }
                                $scope.brand_form.$setPristine();
                                notification("topright",request.data.type,"fa "+(request.data.type=='success'?' fa-check-circle vd_green':'fa-exclamation-circle vd_red')+"",$sce.trustAsHtml(request.data.message)+" ");

                            }else {

                                 $scope.brands['errors'] = $sce.trustAsHtml(request.data.message);
                            }

                       }

                    },function (data,status) {
                        $log.info(data);
                        $log.info(status);
                    }
                )
                .then(function () {
                    HoldOn.close();
                });
        };

        /* ---------------------------------   Add Size --------------------- */
        $scope.add_size = function(){
            $scope.canceler = $q.defer();
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:'<h1>Storing record </h1><h4>Please wait. A product size is is going to be inserted into database table.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $http.post($rootScope.base_url+'product/add_size/',
                {
                    data: {name: $scope.size.name},
                    timeout: $scope.canceler.promise
                }
                )
                .then(
                    // ------- Success ---------
                    function (request) {
                        if(request.data){
                            if(request.data.type=="success"){
                                if($scope.size.loaded==true) {
                                    $scope.load_sizes();
                                }
                                $scope.size_form.$setPristine();
                                notification("topright",request.data.type,"fa "+(request.data.type=='success'?' fa-check-circle vd_green':'fa-exclamation-circle vd_red')+"",$sce.trustAsHtml(request.data.message)+" ");

                            }else {

                                $scope.sizes['errors'] = $sce.trustAsHtml(request.data.message);
                            }

                        }

                    },function (data,status) {
                        $log.info(data);
                        $log.info(status);
                    }
                )
                .then(function () {
                    HoldOn.close();
                });
        };


        /* ---------------------------------   Add Material --------------------- */
        $scope.add_material = function(){
            $scope.canceler = $q.defer();
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:'<h1>Storing record </h1><h4>Please wait. A product material is is going to be inserted into database table.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $http.post($rootScope.base_url+'product/add_material/',
                {
                    data: {name: $scope.material.name},
                    timeout: $scope.canceler.promise
                }
                )
                .then(
                    // ------- Success ---------
                    function (request) {
                        if(request.data){
                            if(request.data.type=="success"){
                                if($scope.material.loaded ==true) {
                                    $scope.load_materials();
                                }
                                $scope.material_form.$setPristine();
                                notification("topright",request.data.type,"fa "+(request.data.type=='success'?' fa-check-circle vd_green':'fa-exclamation-circle vd_red')+"",$sce.trustAsHtml(request.data.message)+" ");

                            }else {

                                $scope.materials['errors'] = $sce.trustAsHtml(request.data.message);
                            }

                        }

                    },function (data,status) {
                        $log.info(data);
                        $log.info(status);
                    }
                )
                .then(function () {
                    HoldOn.close();
                });
        };

        /* ---------------------------------   Reset Brand Form --------------------- */
        $scope.reset_brand_form = function () {
            $scope.brand = {};
            $scope.action_edit_brand=false;
            $scope.brand_form.$setPristine();
        }
        /* ---------------------------------   Reset Size Form --------------------- */
        $scope.reset_size_form = function () {
            $scope.size = {};
            $scope.action_edit_size=false;
            $scope.size_form.$setPristine();
        }
        /* ---------------------------------   Reset Material Form --------------------- */
        $scope.reset_material_form = function () {
            $scope.material = {};
            $scope.action_edit_material=false;
            $scope.material_form.$setPristine();
        }
}]);