/**
 * Created by Shah on 4/23/2016.
 */
/*angular.module("kp_clothes").requires.push('ngMask');*/
angular.module("kp_clothes").requires.push('mgo-angular-wizard');

angular.module("kp_clothes").controller('orderController',  ['$scope','$rootScope',
    '$http','$sce',
    '$compile','$q','$log','$timeout',
    function ($scope,$rootScope,$http,$sce,$compile,$q,$log,$timeout)  {
        var button = '<button class="btn btn-danger" ng-click="cancel_request()" onClick=" HoldOn.close();" type="button">Cancel</button>';
        $scope.order = {
            products: {},
            status:'1',
            date:new Date(),
        };
        $scope.product  = {
            info :null,
            child_products:null,
            virtual_products:null,
            selected:{
                id:null,
                quantity:null,
                quantities:{

                }

            },
            stitching_service:null
        };
        $scope.empty_product = angular.copy($scope.product);
        $scope.empty_selectedProducts = angular.copy($scope.product.selected);
        $scope.select2Customer = {
            placeholder: "Select Customer",
            maximumSelectionLength: 1,
            /* allowClear:true,*/
            ajax: {
                url: $rootScope.base_url + "customer/search",
                type:"post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data
                    };
                }
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: function  (data, container) {
                if (!data.id || data == false ) { return 'Searching...';  }
                var details = '';
                if(data.address!=null && data.address.length>0){
                    details = data.address;
                }else if(data.phone!=null && data.phone.length>0){
                    details = data.phone;
                }else {
                    details = data.fname;
                }
                var $state = $(
                    '<div class="menu-icon"><img style="width: 32px;" src="' + data.photo + '"  /></div><div class="menu-text"> <strong>' + data.text + '</strong> <br />  <span> '+details+'</span> </div></div>'
                );
                return $state;

            },
            templateSelection: function (data) {
                if (!data.id || data == false || data == null ) { return ;  }
                var $state = $(
                    '<span><img style="width: 24px;max-height: 24px !important;" src="' + data.photo + '"  /> <b>' + data.text + '</b></span>'
                );
                return $state;
            }


        };
        $scope.select2Product = {
            placeholder: "Select Product",
            maximumSelectionLength: 1,
            language: {
                inputTooShort: function () { return 'Type to search..'; },
                searching: function() {
                    return "Searching...";
                }
            },
            /* allowClear:true,*/
            ajax: {
                url: $rootScope.base_url + "product/input_search",
                type:"post",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term // search term
                    };
                },
                processResults: function (data, params) {
                    return {
                        results: data
                    };
                }
            },
            escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: function  (data, container) {
                if (!data.id || data == false ) { return 'Searching...';  }
                var details = '';
                if(data.details!=null && data.details.length>0){
                    details = data.details;
                }else {
                    details = "<span class='text-danger'>no details found</span>";
                }
                var $state = $(
                    '<div class="menu-icon"><img style="width: 32px;" src="' + data.photo + '"  /></div><div class="menu-text"> <strong>' + data.text + '</strong> <br />  <span> '+details+'</span> </div></div>'
                );
                return $state;

            },
            templateSelection: function (data) {
                if (!data.id || data == false || data == null ) { return ;  }
                var $state = $(
                    '<span><img style="width: 24px; max-height: 24px !important;" src="' + data.photo + '"  /> <b>' + data.text + '</b></span>'
                );
                return $state;
            }


        };
        $scope.get_child = function(id){
                for(var i =0; i<$scope.product.child_products.length; i++){
                    if(id==$scope.product.child_products[i].id){
                        return $scope.product.child_products[i];
                    }
                }
        };
        $scope.push_product = function () {
            var item = new Object();
            item.info = angular.copy($scope.product.info);
            var quantity = angular.copy($scope.product.selected.quantity);
            if(quantity>0){
                    item.quantity = quantity;
            }else {
                var quantities = angular.copy($scope.product.selected.quantities);
                item.quantities = new Object();
                angular.forEach(quantities,function (child,child_id) {
                    if(child.status == true){
                        var selected_child = new Object();
                        selected_child.info = $scope.get_child(child_id);
                        selected_child.quantity = child.value;
                        item.quantities = [].concat(selected_child,item.quantities);
                    }
                });
            }

            $scope.order.products = [].concat($scope.order.products,item);
            //$scope.order.products[id] = angular.copy(item);
            $scope.product.selected = angular.copy($scope.empty_selectedProducts);
            $('select[select2="select2Product"]').html('');
            notification("topright",'success', "fa  fa-check-circle vd_green","Oh yeah! ","Product is successfully added to cart.",3000);
            if(!$scope.$$phase){
                $scope.$apply();
            }
            $log.debug($scope.product);
            $log.debug($scope.order);


        };
        $scope.get_product = function (id) {
            if(id>0){
                $scope.product  = angular.copy($scope.empty_product);
                $scope.product.selected.id = id;
                $http.post($rootScope.base_url+'product/get_product',{
                        data:{
                            id :id
                        }/*,
                        timeout: $scope.canceler.promise*/
                    } )
                    .then(function(response){
                        if(response.data.type=='error'){
                            notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");
                        }
                        if(response.data.info){
                            $scope.product.info = response.data.info;
                            $scope.product.child_products = response.data.child_products;
                            $scope.product.virtual_products = response.data.virtual_products;
                            //$log.debug($scope.product);
                        }

                    });
            }
        };

        $scope.place_order = function () {
            $log.debug("Place Order");
        }
        






    }]);
