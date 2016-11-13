/**
 * Created by Shah on 4/23/2016.
 */
angular.module("kp_clothes").controller('customerController',['$scope','$rootScope',
    '$http','Upload','$sce',
    '$stateParams','$compile','$q','$timeout','$log',
    function ($scope,$rootScope,$http,Upload,$sce,$stateParams,$compile,$q,$timeout,$log) {
    $log.info('customer controller');
    $scope.loading = false;
    $scope.customers = {};
    $scope.forms = {
        reset:{
            naps: function () {
                $scope.customer.nap ={
                    cus_id:null,
                    customer_id:$scope.current_customer,
                    contact_id:null,
                };
                $scope.forms.naps.$setPristine();
                $scope.forms.naps.$dirty = false;
                $scope.forms.naps.$pristine = true;
                $scope.forms.naps.$submitted = false;
            },
            all: function () {
                $scope.customer ={
                    nap:{
                        cus_id:null,
                        customer_id:$scope.current_customer,
                        contact_id:null,
                    },
                    naps:{}
                };
                $scope.forms.reset.naps();
                $scope.resetForm();
                $scope.reset_infoFrom();
            }
        }
    };
    $scope.ngScrollbarsConfig = {
            callbacks: {
                onTotalScrollOffset: 100,
                onTotalScroll: function () {
                    $scope.scroll_finish();
                }
            }
        };
    $scope.cus_category = {};
    $scope.photos = {};
    $scope.contacts = {};
    $scope.contact = {};
    $scope.customer_contact = {
        gender:'male'
    };
     $scope.customer ={
         nap:{
             cus_id:null,
             customer_id:$scope.current_customer,
             contact_id:null,
         },
         naps:{}
     };
    $scope.customer_like = '';
    $scope.page = 1;
    $scope.total_records = 1;
    $scope.loaded_all = false;
    $scope.current_customer = 0;
    $scope.current_contact = 0;
    $scope.vps = {};
     var button = '<button class="btn btn-danger" ng-click="cancel_request()" onClick="HoldOn.close();" type="button">Cancel</button>';
     var message = '<h2>Please wait</h2><h5>The process is going to complete in a moment.</h5>.<br> <button class="btn btn-xs btn-danger" id="compiled_button" type="button" >Cancel</button>';

        $scope.delete_nap = function (nap_id) {
            if(nap_id!=null){
                $scope.canceler = $q.defer();
                var options = {
                    theme:"sk-bounce",
                    message:message
                };
                HoldOn.open(options);
                var $elem = angular.element("#holdon-overlay #compiled_button");
                $elem.replaceWith($compile(button)($scope));
                $scope.customer.nap.customer_id = angular.copy($scope.current_customer);
                if($scope.customer.nap.cus_id!=null){
                    $scope.customer.nap.contact_id = angular.copy($scope.customer.nap.cus_id);
                }
                $http.post($rootScope.base_url+'customer/delete_nap',{
                        data: {nap_id:nap_id},
                        timeout: $scope.canceler.promise
                    })
                    .then(function(response){
                        if(response.data.message && response.data.type){
                            if(response.data.type=='success'){
                                if($scope.customer.nap.nap_id>0){
                                    $scope.forms.reset.naps();
                                }
                                angular.forEach($scope.customer.naps, function (nap, index) {
                                        if(nap.nap_id == nap_id){
                                            $scope.customer.naps.splice(index,1);
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
                    HoldOn.close();
                });
            }
        };
        $scope.edit_nap = function (nap) {
            $scope.customer.nap = {
                nap_id : nap.nap_id,
                cus_id : nap.contact_id,
                info : nap.info,
                vp_id : nap.vp_id,
                values:{}
            };
            if(nap.values!=false && nap.values.length>0){
                angular.forEach(nap.values, function (val,key) {
                    $scope.customer.nap.values[val.option_id] = val.value;
                });
            }

            $log.debug(nap);
        };
        $scope.get_opt_title = function (option_id) {
            var vp_id = $scope.customer.nap.vp_id;
            for(var i=0;i<$scope.vps.length; i++){
                if($scope.customer.naps[i].vp_id == vp_id){
                    for(var j=0; j<$scope.vps[i].options.length;j++){
                        if($scope.vps[i].options[j].opt_id == option_id){
                           return $scope.vps[i].options[j].opt_title;
                        }
                    }
                }
            }
        };
        $scope.updated_nap_values = function () {
            var count = 0;
            var values = {};
            angular.forEach($scope.customer.nap.values, function (value,key) {
                var new_val = {
                    option_id : key,
                    value : value,
                    title : $scope.get_opt_title(key)
                };
                values = [].concat(values,new_val);
                count++;
            });
            values.splice(0,1);
            return values;
        };
        $scope.get_contact_name = function () {
            for(var i =0; i<$scope.contacts.length; i++){
                if($scope.contacts[i].id == $scope.customer.nap.cus_id){
                    return $scope.contacts[i].name;
                }
            }
        };
        $scope.process_nap = function () {
            $scope.canceler = $q.defer();
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:message
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $scope.customer.nap.customer_id = angular.copy($scope.current_customer);
            if($scope.customer.nap.cus_id!=null){
               $scope.customer.nap.contact_id = angular.copy($scope.customer.nap.cus_id);
            }

            //----------- Deleting extra values of the other type of service
            var _values = angular.copy($scope.customer.nap.values);
            angular.forEach($scope.vps, function (value,key) {
                if(value.vp_id == $scope.customer.nap.vp_id){
                   $scope.customer.nap.values = new Array();
                    //$scou
                    angular.forEach(value.options, function (inner_val,inner_key) {
                       // $log.debug(inner_val);
                        if(inner_val.opt_type =='nap'){
                            var option_id = inner_val.option_id;
                            var val = _values[inner_val.option_id];
                            $scope.customer.nap.values[option_id] ={};
                            $scope.customer.nap.values[option_id] = val ;
                        }

                    });
                }
            });


            $http.post($rootScope.base_url+'stitching/process_nap',{
                    data: $scope.customer.nap,
                    timeout: $scope.canceler.promise
                })
                .then(function(response){
                    if(response.data.message && response.data.type){
                        if(response.data.type=='success'){
                            if(response.data.nap !=null){
                                $scope.customer.nap.nap_id =  response.data.nap.nap_id;
                                  $scope.customer.naps = [].concat(response.data.nap,$scope.customer.naps);
                            }else {
                                angular.forEach($scope.customer.naps,function(val,key){
                                    if(val.nap_id == $scope.customer.nap.nap_id){
                                         $scope.customer.naps[key].info = angular.copy($scope.customer.nap.info);
                                        $scope.customer.naps[key].vp_id = angular.copy($scope.customer.nap.vp_id);
                                        $scope.customer.naps[key].contact_id = ($scope.customer.nap.cus_id>0 ?angular.copy($scope.customer.nap.cus_id):null);
                                        $scope.customer.naps[key].contact_name = ($scope.customer.nap.cus_id>0 ?$scope.get_contact_name():null);
                                        if(val.values!=false && val.values.length>0){
                                            $scope.customer.naps[key].values = $scope.updated_nap_values();
                                        }
                                    }
                                });
                            }
                        }
                        notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");
                    }


                }, function (response) {
                    //error
                    $log.warn(response);
                }).then(function () {
                // Compleate
                HoldOn.close();
            });
        };
        /* ---------------------------------   Delete customer photo --------------------- */
        $scope.delete_photo = function(data){
            if (data){
                var photo = data.photo;
                var index = data.index;
                $scope.canceler = $q.defer();
                var options = {
                    theme:"sk-bounce",
                    // If theme == "custom" , the content option will be available to customize the logo
                    message:'<h2>Deleting Photo</h2><h5>Please wait. Customer photo is going to be deleted.</h5>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
                };
                HoldOn.open(options);
                var $elem = angular.element("#holdon-overlay #compiled_button");
                $elem.replaceWith($compile(button)($scope));
                $http.post($rootScope.base_url+'customer/delete_photo',{
                        data:{
                            customer_id : $scope.current_customer,
                            photo:photo
                        },
                        timeout: $scope.canceler.promise
                    } )
                    .then(function(response){
                        if(response.data.type=='success'){
                            $scope.photos.this_customer.splice($scope.photos.this_customer.indexOf(index),1);
                        }
                        notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");

                    }, function (response) {
                        //error
                        $log.warn(response);
                    }).then(function () {
                    // Compleate
                    HoldOn.close();
                });

            }

        };
            
        /* ---------------------------------   Delete customer photo --------------------- */
        $scope.get_virtual_products = function(){
            $http.get($rootScope.base_url+'product/virtual_products/form_data')
                .then(function(response){
                    if(response.data!=false){
                        $scope.vps = response.data;
                    }
                });
        };
         /* ---------------------------------   delete customer contact --------------------- */
        $scope.delete_contact = function(contact){
           // $log.debug(contact_id);return false;
            if (contact && contact.id>0){
                $scope.canceler = $q.defer();
                var options = {
                    theme:"sk-bounce",
                    // If theme == "custom" , the content option will be available to customize the logo
                    message:'<h2>Deleting Customer Contact</h2><h5>Please wait. A contact of the customer going to be deleted.</h5>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
                };
                HoldOn.open(options);
                var $elem = angular.element("#holdon-overlay #compiled_button");
                $elem.replaceWith($compile(button)($scope));
                $http.post($rootScope.base_url+'customer/delete_contact',{
                        data:{
                            id : contact.id
                        },
                        timeout: $scope.canceler.promise
                    } )
                    .then(function(response){
                        if(response.data.type=='success'){

                            $scope.contacts.splice( $scope.contacts.indexOf(contact.index),1);
                            if($scope.current_contact == contact.id){
                                $scope.reset_contactForm();
                            }
                        }
                        notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");

                    }, function (response) {
                        //error
                        $log.warn(response);
                    }).then(function () {
                    // Compleate
                    HoldOn.close();
                });

            }

        };


        /* ---------------------------------   function to get customers --------------------- */
        $scope.get_customers = function(like,check_loaded){
       // /search/sh
        if(check_loaded==true && $scope.loaded_all==true){
            return true;
        }
        if(like==true){
            $scope.page=1;
            $scope.customers = {};
        }
        $http.get($rootScope.base_url+'customer/view/page/'+$scope.page+(like==true?'/search/'+$scope.customer_like :'') )
            .then(function(response){
                if(response.data.customers==false){
                    $scope.loaded_all = true;
                }else {
                   // var customers = $scope.customers;
                    $scope.customers =[].concat($scope.customers,response.data.customers);
                    //   $scope.customers =   $scope.customers.concat(response.data.customers);
                    $scope.total_records = response.data.total_records;
                    $scope.page++;
                }

        }, function (response) {
                 $log.warn(response);



        }).then(function () {
            // Compleate
            $scope.loading = false;
         });
    };


        /* --------------------------------- get customers on document load --------------------- */
        $scope.get_customers();


        /* ---------------------------------   Cancel Request --------------------- */
        $scope.cancel_request = function () {
            $scope.canceler.resolve();
            $scope.current_customer = 0;
            delete  $scope.canceler;
        };


        /* ---------------------------------   Clear Form --------------------- */
        $scope.customer_info= function(id,push) {
            if (id > 0) {
                $scope.canceler = $q.defer();
                var options = {
                    theme:"sk-bounce",
                    // If theme == "custom" , the content option will be available to customize the logo
                    message:'<h2>Loading Customer info </h2><h5>Please wait. Your selected customer information is going to be loaded.</h5>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
                };
                HoldOn.open(options);
                var $elem = angular.element("#holdon-overlay #compiled_button");
                $elem.replaceWith($compile(button)($scope));
                $http.get($rootScope.base_url+'customer/view/'+id ,{
                        timeout: $scope.canceler.promise
                })
                    .then(function(response){
                        //success
                        if(response.data.type && response.data.message){
                            notification("topright", request.data.type, "fa " + (request.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(request.data.message) + " ");
                            return true;
                        }
                        if(push==true){
                            $scope.customers = [].concat(response.data.info,$scope.customers);
                            $scope.total_records++;
                            return true;
                        }
                       $scope.photos['this_customer'] = response.data.photos;
                        $scope.contacts = response.data.contacts;
                        $scope.customer.naps = response.data.naps;
                        $scope.info = {
                            name : response.data.info.name,
                            fname : response.data.info.fname,
                            age   :  $rootScope.this_year - parseInt(response.data.info.age),
                            gender   :  response.data.info.gender

                        };

                        // $scope.info.age = response.data;
                        $scope.contact = {
                            contact1: parseInt(response.data.info.contact1),
                            email: response.data.info.email,
                            address: response.data.info.address,
                            ref_id: response.data.info.ref_id,
                            contact2: parseInt(response.data.info.contact2)
                        };


                        $scope.cus_category = {
                            category: response.data.category,
                            sub_category: response.data.sub_category,
                            details: response.data.presence_details,
                        };

                        $scope.customer.nap = {
                            cus_id:null,
                            customer_id:$scope.current_customer,
                            contact_id:null
                        };

                    }, function (response) {
                        //error
                        $log.warn(response);



                    }).then(function () {
                    // Compleate
                   HoldOn.close();
                });
            } else {
                return false;
            }
        };


        /* ---------------------------------  Get info a single customer --------------------- */
        $scope.get_customer= function (id){
                $scope.current_customer = id;
                $scope.customer_info(id);
            };


        /* ---------------------------------  When custom scroll to reach to bottom --------------------- */
        $scope.scroll_finish = function() {
        $scope.get_customers(null,true);
    };


        /* ---------------------------------   Reset Forms --------------------- */
        $scope.resetForm = function () {
            $('.tab-info').addClass('active');

            $scope.reset_infoFrom();
            $scope.reset_contactForm();
            $scope.contact = {};
        };


        /* ---------------------------------  Reset Info form --------------------- */
        $scope.reset_infoFrom = function(){
           $scope.info = {
               gender:'male'
           };
            $scope.info_form.$setPristine();
            $scope.info_form.$dirty = false;
            $scope.info_form.$pristine = true;
            $scope.info_form.$submitted = false;
            $scope.current_customer = 0;

            $log.info('resetForm');

        };

        /* ---------------------------------   Add new customer --------------------- */
        $scope.info_add = function() {
            $scope.canceler = $q.defer();
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:'<h2>Saving</h2><h5>Please wait. New customer is going to be stored.</h5>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
             var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            HoldOn.open(options);
            $http.post($rootScope.base_url + 'customer/add_info',
                {
                    data: {
                        name: $scope.info.name,
                        fname:$scope.info.fname,
                        age: $scope.info.age,
                        gender: $scope.info.gender

                    },
                    timeout: $scope.canceler.promise
                }
                )
                .then(
                    // ------- Success ---------
                    function (request) {
                        if (request.data) {
                           if(request.data.id>0){
                               $scope.current_customer = request.data.id;
                               $scope.contact = {};
                               $scope.customer_info(request.data.id,true);
                             }
                            if (request.data.type == "error") {
                                $scope.info['errors'] = $sce.trustAsHtml(request.data.message);
                            }
                            notification("topright", request.data.type, "fa " + (request.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(request.data.message) + " ");
                        }

                    }, function (data, status) {
                        // error
                        $log.info(data);
                        $log.info(status);
                    }
                )
                .then(function () {
                    // complete
                    HoldOn.close();
                });


        };


        /* ---------------------------------  Update customr info --------------------- */
        $scope.info_update = function (action) {
           $scope.canceler = $q.defer();
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:'<h2>Updating</h2><h5>Please wait. Customer information is going to be updated.</h5>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
            };
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay").find("button#compiled_button");
            $elem.replaceWith($compile(button)($scope));
            if(action=='cat'){
                var data = {
                    id: $scope.current_customer,
                    action: action,
                    category: $scope.cus_category.category,
                    sub_category: $scope.cus_category.sub_category,
                    presence_details: $scope.cus_category.details
                }
            }else if(action=='contact'){
               delete $scope.contact.errors;
                var data = {
                    id: $scope.current_customer,
                    action: action,
                    name: $scope.info.name,
                    contact1: $scope.contact.contact1,
                    email:$scope.contact.email,
                    contact2: $scope.contact.contact2,
                    address: $scope.contact.address,
                    ref_id: $scope.contact.ref_id
                }
            }else {
                delete $scope.info.errors;
                var data = {
                    id: $scope.current_customer,
                    name: $scope.info.name,
                    fname:$scope.info.fname,
                    age: $scope.info.age,
                    gender: $scope.info.gender
                }
            }

            $http.post($rootScope.base_url + 'customer/update_info',
                {
                    data: data,
                    timeout: $scope.canceler.promise
                }
                )
                .then(
                    // ------- Success ---------
                    function (request) {
                       if (request.data) {
                            if (request.data.type == "error") {
                                if(action=='contact'){
                                    $scope.contact['errors'] = $sce.trustAsHtml(request.data.message);

                                }else {
                                    $scope.info['errors'] = $sce.trustAsHtml(request.data.message);
                                }
                            } else if (request.data.type == "success") {

                                for(var i=0; i<$scope.customers.length-1;i++){
                                   if($scope.customers[i] && $scope.customers[i].customer_id == data.id){
                                        $scope.customers.splice(i,1);
                                        $scope.total_records--;
                                        $scope.customer_info(data.id,true);
                                    }

                                }

                            }
                            notification("topright", request.data.type, "fa " + (request.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(request.data.message) + " ");
                        }

                    }, function (data, status) {
                        // error
                        $log.info(data);
                        $log.info(status);
                    }
                )
                .then(function () {
                    // complete
                    HoldOn.close();
                });


        };


        /* ---------------------------------   Watch --------------------- */
        $scope.$watch('photos.cover',function(new_photo,old_photo){
            if($scope.current_customer>0){
                  angular.forEach($scope.customers, function (customer,key) {
                      if(customer.customer_id==$scope.current_customer){
                          customer.photo = new_photo;
                          var new_customer = customer;
                        $scope.customers.splice(key,1);
                          $scope.customers = [].concat(new_customer, $scope.customers);
                      }
                  });  
                $http.post($rootScope.base_url + 'customer/change_cover_photo',
                    {
                        data: {
                            customer_id:$scope.current_customer,
                            photo:new_photo
                        },
                        timeout: $scope.canceler.promise
                    });

            }
       });


        /* ---------------------------------  Watch --------------------- */
        $scope.$watch('current_customer',function(new_val,old_val){
            if($scope.current_contact>0){
                $scope.reset_contactForm();
            }
       });


        /* ---------------------------------   Upload a customer photo --------------------- */
        $scope.uploadPhotos = function (photos) {
            if (photos && photos.length) {
                angular.forEach(photos, function(photo,key) {
                    photo.upload = Upload.upload({
                        url: $rootScope.base_url+'customer/upload_photo',
                        data: {
                            file: photo,
                            customer_id: $scope.current_customer
                        }
                    });

                    photo.upload.then(function (response) {
                        if(response.data.type=='success'){
                            var new_photo = {
                                photo : response.data.photo,
                                main:'0',

                            };
                            if($scope.photos.this_customer==false){
                                $scope.photos.this_customer = [].concat(new_photo);
                            }else {
                                $scope.photos.this_customer = [].concat(new_photo, $scope.photos.this_customer);
                            }
                            $scope.photos.files.splice(key,1);
                        }
                        notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");
                        $timeout(function () {
                            photo.result = response.data;
                        });
                    }, function (response) {
                        if (response.status > 0)
                            $scope.errorMsg = response.status + ': ' + response.data;
                    }, function (evt) {
                        photo.progress = Math.min(100, parseInt(100.0 *
                            evt.loaded / evt.total));
                    });
                });
            }
        };


        /* ---------------------------------   Get info a contact --------------------- */
        $scope.get_contact = function (id) {
           angular.forEach($scope.contacts, function (contact) {
               if(contact.id == id){
                   $scope.current_contact = id;
                   $log.info(id);
                   $scope.customer_contact  = {
                       name : contact.name,
                       info : contact.info,
                       gender: contact.gender,
                       photo : contact.photo
                    };
               }
           });



       };


        /* ---------------------------------  Update contact  --------------------- */
        $scope.update_contact= function () {
            $scope.customer_contact.progress = 0;
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:'<h2>Updating : '+ $scope.customer_contact.progress +' %</h2><h5>Please wait. One of the customer contact is going to be updated.</h5>.'
            };
           // HoldOn.open(options);
            Upload.upload({
                url: $rootScope.base_url+'customer/update_contact',
                data: {file:$scope.customer_contact.file,
                    id: $scope.current_contact,
                    name: $scope.customer_contact.name,
                    info:$scope.customer_contact.info,
                    gender:$scope.customer_contact.gender,
                    photo_link:$scope.customer_contact.photo_link,
                    customer_id: $scope.current_customer
                },
            }).then(function(resp) {
                // file is uploaded successfully
                if( resp.data.type=='success'){
                    var new_contact = {
                        id: $scope.current_contact,
                        name: $scope.customer_contact.name,
                        info:$scope.customer_contact.info,
                        gender:$scope.customer_contact.gender,
                        photo_link:$scope.customer_contact.photo_link,
                        customer_id: $scope.current_customer,
                        photo : resp.data.photo
                    }
                    angular.forEach($scope.contacts, function (contact,key) {
                        if(contact.id==$scope.current_contact){
                            $scope.contacts.splice(key,1);
                            if(new_contact.photo==false){
                                new_contact.photo = contact.photo;
                            }
                        }
                    });
                    $scope.contacts = [].concat(new_contact,$scope.contacts);
                }

                notification("topright",resp.data.type,"fa "+(resp.data.type=='success'?' fa-check-circle vd_green':'fa-exclamation-circle vd_red')+"",$sce.trustAsHtml(resp.data.message)+" ");



            }, function (response) {
                // Even when error in uploading data
                if(response.status=='404'){
                    var message = "Error 404: The page you are looking for, not found."
                }else {
                    var message = response.statusText;
                }
                notification("topright","error","fa fa-exclamation-circle vd_red",message);


            }, function (evt) {
                //event for progress bar
                $scope.customer_contact.progress = parseInt(100.0 * evt.loaded / evt.total);
                if($scope.customer_contact.progress>=99){
                  //  HoldOn.close();
                }

            });



        };


        /* ---------------------------------  Reset contacts form --------------------- */
        $scope.reset_contactForm = function(){
            $scope.current_contact = 0;
            $scope.customer_contact = {
                gender:'male'
            };
            if($scope.forms.contacts){
                $scope.forms.contacts.$setPristine();
                $scope.forms.contacts.$dirty = false;
                $scope.forms.contacts.$pristine = true;
                $scope.forms.contacts.$submitted = false;
            }


        };


        /* ---------------------------------   Delete customer contact --------------------- */
        $scope.delete_contact_photo = function (photo) {
            $log.info(photo);
            if(photo.length>5){
                $scope.canceler = $q.defer();
                var options = {
                    theme:"sk-bounce",
                    // If theme == "custom" , the content option will be available to customize the logo
                    message:'<h2>Deleting Photo</h2><h5>Please wait.Contact photo is going to be deleted.</h5>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
                };
                HoldOn.open(options);
                var $elem = angular.element("#holdon-overlay #compiled_button");
                $elem.replaceWith($compile(button)($scope));
                $http.post($rootScope.base_url + 'customer/delete_contact_photo',
                    {
                        data: {
                            id: $scope.current_contact,
                            photo:photo
                        },
                        timeout: $scope.canceler.promise
                    }
                    )
                    .then(
                        // ------- Success ---------
                        function (request) {
                            if (request.data) {
                                if(request.data.type=='success'){
                                   angular.forEach($scope.contacts,function(contact,key){
                                        if(contact.id == $scope.current_contact){
                                            $scope.customer_contact.photo = false;
                                            $scope.contacts[key].photo = false;
                                        }
                                   });
                                }
                                if (request.data.type == "error") {
                                    $scope.info['errors'] = $sce.trustAsHtml(request.data.message);
                                }
                                notification("topright", request.data.type, "fa " + (request.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(request.data.message) + " ");
                            }

                        }, function (data, status) {
                            // error
                            $log.info(data);
                            $log.info(status);
                        }
                    )
                    .then(function () {
                        // complete
                        HoldOn.close();
                    });


            }
        };


        /* ---------------------------------   Add new customer contact --------------------- */
        $scope.add_contact = function () {
            $log.debug("add Contact");

            $scope.customer_contact.progress = 0;
            var options = {
                theme:"sk-bounce",
                // If theme == "custom" , the content option will be available to customize the logo
                message:'<h2>Saving : '+ $scope.customer_contact.progress +' %</h2><h5>Please wait. Customer new contact is going to be saved.</h5>.'
            };
            // HoldOn.open(options);
            Upload.upload({
                url: $rootScope.base_url+'customer/save_contact',
                data: {file:$scope.customer_contact.file,
                    name: $scope.customer_contact.name,
                    info:$scope.customer_contact.info,
                    gender:$scope.customer_contact.gender,
                    photo_link:$scope.customer_contact.photo_link,
                    customer_id: $scope.current_customer
                },
            }).then(function(resp) {
                // file is uploaded successfully
               if( resp.data.type=='success'){
                    $scope.current_contact =  resp.data.id;
                    var new_contact = {
                        id: $scope.current_contact,
                        name: $scope.customer_contact.name,
                        info:$scope.customer_contact.info,
                        gender:$scope.customer_contact.gender,
                        photo_link:$scope.customer_contact.photo_link,
                        customer_id: $scope.current_customer,
                        photo : resp.data.photo
                    };
                   $scope.contacts = [].concat(new_contact,$scope.contacts);
                   angular.forEach($scope.contacts, function (cont,key) {
                        if(cont.id>0){

                        }else {
                            $scope.contacts.splice(key,1);
                        }
                       $scope.reset_contactForm();
                   });

                }

                notification("topright",resp.data.type,"fa "+(resp.data.type=='success'?' fa-check-circle vd_green':'fa-exclamation-circle vd_red')+"",$sce.trustAsHtml(resp.data.message)+" ");



            }, function (response) {
                // Even when error in uploading data
                if(response.status=='404'){
                    var message = "Error 404: The page you are looking for, not found."
                }else {
                    var message = response.statusText;
                }
                notification("topright","error","fa fa-exclamation-circle vd_red",message);


            }, function (evt) {
                //event for progress bar
                $scope.customer_contact.progress = parseInt(100.0 * evt.loaded / evt.total);
                if($scope.customer_contact.progress>=99){
                    //  HoldOn.close();
                }

            });



        };


        /* ---------------------------------  Remove uploaded Photo--------------------- */
        $scope.removePhoto = function(index){
            $scope.photos.files.splice(index,1);
        }


        /* ---------------------------------   Delete customer Photo --------------------- */
        $scope.delete_customer = function(id){
            $log.debug(id);
            if(id>0){
                $scope.canceler = $q.defer();
                var options = {
                    theme:"sk-bounce",
                    // If theme == "custom" , the content option will be available to customize the logo
                    message:'<h2>Deleting contact</h2><h5>Please wait. A customer going to be deleted from the database.</h5>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>'
                };
                HoldOn.open(options);
                var $elem = angular.element("#holdon-overlay #compiled_button");
                $elem.replaceWith($compile(button)($scope));
                $http.post($rootScope.base_url+'customer/delete',{
                        data:{
                            id : id
                        },
                        timeout: $scope.canceler.promise
                    } )
                    .then(function(response){
                        if(response.data.type=='success'){
                             for(var i = 0; i<$scope.customers.length - 1; i++ ){
                                 //var customer = $scope.customers[i];
                                if($scope.customers[i] && $scope.customers[i].customer_id == id){

                                   $scope.customers.splice(i,1);
                                    $scope.resetForm();
                                    $scope.total_records--;
                                    break;
                                 }
                             }

                        }
                        notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");

                    }, function (response) {
                        //error
                        $log.warn(response);
                    }).then(function () {
                    // Compleate
                    HoldOn.close();
                });

            }
        }


        $scope.get_virtual_products();

    }]);

