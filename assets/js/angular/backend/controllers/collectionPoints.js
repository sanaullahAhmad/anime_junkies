/**
 * Created by Shah on 4/23/2016.
 */
angular.module("kp_clothes").controller('collectionPoints',  ['$scope','$rootScope',
                                                              '$http','Upload','$sce',
                                                              '$compile','$q','$log',
                                                              function ($scope,$rootScope,$http,Upload,$sce,$compile,$q,$log)  {
        $log.info("Collection Points Controller");
        // $( '[data-rel^="ckeditor"]' ).ckeditor();
        CKEDITOR.replace('ck_editor');
        var button = '<button class="btn btn-danger" ng-click="cancel_request()" onClick=" HoldOn.close();" type="button">Cancel</button>';


        $scope.base_path = $rootScope.base_path;
        $scope.updated_id = 0;
        $scope.edit_action = false;
        $scope.loaded = false;
        $scope.deleted_id=0;
        $scope.detail_id=0;
        $scope.details = {  };
       
        /* ---------------------------------   Load Collection Point --------------------- */
        $scope.load = function (cp_id,details) {
            $scope.canceler = $q.defer();
            var options = {
                theme: "sk-bounce",
                message: '<h1>Loading Collection Points </h1><h4>Please wait. Collection Points is is going to be to be loaded.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $http.get($rootScope.base_url + 'collection_point/view/' + (cp_id > 0 ? cp_id : ''), {
                    timeout: $scope.canceler.promise
                })
                .then(
                    // ------- Success ---------
                    function (request) {
                        if(cp_id>0){
                             if(details==true){
                               $element =  angular.element("#detail_"+cp_id);
                                $element.html(request.data.details);
                                $element.parents("div.parent-div").removeClass("hidden");
                                
                                // $sce.trustAsHtml(request.data.details);
                                
                            }else{
                                CKEDITOR.instances.ck_editor.insertHtml(request.data.details);
                                $scope.data.name = request.data.name;
                                $scope.data.is_shop = request.data.is_shop;
                                $scope.data.phone = parseInt(request.data.contact_no);
                                $scope.edit_action = true;
                            }
                        }else{
                            $scope.collection_points = request.data;
                            $scope.loaded = true;
                        }
                       
                    },
                    function (data, status) {
                        $log.info(data);
                        $log.info(status);
                    }
                )
                .then(function () {
                    HoldOn.close();
                });
        };
        
        
        /* ---------------------------------   Add Collection Point --------------------- */
           
        $scope.add = function () {
            $scope.data.info = CKEDITOR.instances.ck_editor.getData();
            $scope.canceler = $q.defer();
            var options = {
                theme: "sk-bounce",
                message: '<h1>Storing Collection Point </h1><h4>Please wait. New Collecion Point is is going to be inserted into database table.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $http.post($rootScope.base_url + 'collection_point/save', {
                    data: {
                        name: $scope.data.name,
                        contact_no: $scope.data.phone,
                        is_shop: $scope.data.is_shop,
                        details: $scope.data.info
                    },
                    timeout: $scope.canceler.promise
                })
                .then(
                    // ------- Success ---------
                    function (request) {
                        if (request.data) {
                            if (request.data.type == "success") {
                                if ($scope.loaded == true) {
                                    $scope.load();
                                }
                               $scope.resetForm();
                                notification("topright", request.data.type, "fa " + (request.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(request.data.message) + " ");

                            } else {

                                $scope.data['errors'] = $sce.trustAsHtml(request.data.message);
                            }

                        }

                    },
                    function (data, status) {
                        $log.info(data);
                        $log.info(status);
                    }
                )
                .then(function () {
                    HoldOn.close();
                });
        };
        
        
        /* ---------------------------------   Update Collection Point --------------------- */

        $scope.update = function (cp_id) {
            $scope.data.info = CKEDITOR.instances.ck_editor.getData();
            $scope.canceler = $q.defer();
            var options = {
                theme: "sk-bounce",
                message: '<h1>Updating Collection Point </h1><h4>Please wait. A Collecion Point is is going to be updated.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $http.post($rootScope.base_url + 'collection_point/update', {
                data: {
                    id : cp_id,
                    name: $scope.data.name,
                    contact_no: $scope.data.phone,
                    is_shop: $scope.data.is_shop,
                    details: $scope.data.info
                },
                timeout: $scope.canceler.promise
            })
                .then(
                // ------- Success ---------
                function (request) {
                    if (request.data) {
                        if (request.data.type == "success") {
                            if ($scope.loaded == true) {
                                $scope.load();
                            }
                           $scope.resetForm();
                            angular.element("#detail_"+cp_id).html("");
                            $element =  angular.element("#detail_"+cp_id);
                            $element.html("");
                            $element.parents("div.parent-div").addClass("hidden");
                            $element.parents("div.parent-div").addClass("hidden");
                            
                           $scope["detail_"+cp_id] = false;
                            notification("topright", request.data.type, "fa " + (request.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(request.data.message) + " ");

                        } else {

                            $scope.data['errors'] = $sce.trustAsHtml(request.data.message);
                        }

                    }

                },
                function (data, status) {
                    $log.info(data);
                    $log.info(status);
                }
            )
                .then(function () {
                HoldOn.close();
            });
        };
        
        
        
        /* ---------------------------------   Show Delete Dialog --------------------- */
        $scope.delete_dialog =function (id) {
            $scope.deleted_id = id;
            if(id>0){
                var $dialog = angular.element("#myModal");
                $dialog.modal();
            }
        };
        
        
        /* ---------------------------------  On Edit Load data Dialog --------------------- */
        $scope.edit = function (cp_id) {
            $scope.updated_id = cp_id;
            $scope.load(cp_id);
        };
        
        /* ---------------------------------   Delete Collecion Point --------------------- */
        $scope.delete = function () {
            var deleted_id = $scope.deleted_id;
            $scope.deleted_id = 0;
            $scope.canceler = $q.defer();
            var options = {
                theme: "sk-bounce",
                message: '<h1>Deleting Collection Point </h1><h4>Please wait. A Collecion Point is is going to be deleted.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $http.post($rootScope.base_url + 'collection_point/delete', {
                data: {
                    id: deleted_id
                },
                timeout: $scope.canceler.promise
            })
                .then(
                // ------- Success ---------
                function (request) {
                    if (request.data) {
                        if (request.data.type == "success") {
                            if ($scope.loaded == true) {
                                $scope.load();
                            }
                         
                        } 
                        $scope.resetForm();
                        notification("topright", request.data.type, "fa " + (request.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(request.data.message) + " ");
                    }

                },
                function (data, status) {
                    $log.info(data);
                    $log.info(status);
                }
            )
                .then(function () {
                HoldOn.close();
            });
        };

        /* ---------------------------------   Clear Form --------------------- */
        $scope.resetForm = function () {
            $scope.edit_action = false;
            CKEDITOR.instances.ck_editor.setData('');
            $scope.data = {};
            $scope.data.is_shop = 1;
            $scope.cp_form.$setPristine();
            $scope.cp_form.$dirty = false;
            $scope.cp_form.$pristine = true;
            $scope.cp_form.$submitted = false;


            $log.info('resetForm');

        };


}]);
