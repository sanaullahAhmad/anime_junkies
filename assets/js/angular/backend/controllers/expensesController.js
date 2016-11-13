/**
 * Created by Shah on 4/23/2016.
*/
angular.module("kp_clothes").requires.push('switcher');
angular.module("kp_clothes").controller('expensesController', ['$scope', '$rootScope',
    '$http', 'Upload', '$sce',
     '$compile',
    '$q',
    '$filter',
    'uibDateParser',
    '$timeout',
    '$log',
    function ($scope, $rootScope, $http, Upload, $sce, $compile, $q,$filter,uibDateParser,$timeout, $log) {
        var button = '<button class="btn btn-danger" ng-click="cancel_request()" onClick=" HoldOn.close();" type="button">Cancel</button>';
        var message = '<h1>Please wait</h1><h4>Please wait. The action is going to be completed in a moment.</h4>.<br> <button class="btn btn-danger" id="compiled_button" type="button" >Cancel</button>';
        var options = {
            theme:"sk-bounce",
            message: message
        };

        $scope.loading=false;
        $scope.search = {
            price:{
                min: 0,
                max: 0,
            },
            global:'',
            time:'-1 month',
            label:'of the last month'
        };
        $scope.ngScrollbarsConfig = {
            callbacks: {
                onTotalScrollOffset: 100,
                onTotalScroll: function () {
                    console.log("Ending....");
                }
            }
        };
        $scope.datepickers = {
           isopen: {},
        };
        $scope.heads ={};
        $scope.get_heads = function () {
            $http.post($rootScope.base_url+'expense/get_heads')
                .success(function (data) {
                    $scope.heads = data;
                });
        };
        $scope.get_heads()
        $scope.expenses = {
            max_amount:100000,
            get:function(){
                if( $scope.loading){
                    return false;
                }
                $scope.canceler = $q.defer();
                HoldOn.open(options);
                var $elem = angular.element("#holdon-overlay #compiled_button");
                $elem.replaceWith($compile(button)($scope));
                $scope.loading = true;
                var data = {};
                if($scope.filter==1){
                    data = $scope.search;
                }
                $http.post($rootScope.base_url+'expense/get_list',{
                        data: data,
                        timeout: $scope.canceler.promise
                    })
                    .then(function (response) {
                        if(response.data.type && response.data.message){
                            notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");
                        }else {
                            $scope.expenses.list = response.data;
                        }
                        if($scope.search_custom_date==1){
                            $scope.search.label = 'from "' + $filter('date')($scope.search.from_date,'MMMM,dd yyyy') + '" to "' +  $filter('date')($scope.search.to_date,'MMMM,dd yyyy') +'"' ;
                        }else {
                            if($scope.search.time == '-1 hour'){
                                $scope.search.label = " of the last hour" ;
                            }else if($scope.search.time == '-1 day'){
                                $scope.search.label = " of the last day" ;
                            }else if($scope.search.time == '-1 week'){
                                $scope.search.label = " of the last week" ;
                            }else if($scope.search.time == '-1 month'){
                                $scope.search.label = " of the last month" ;
                            }else if($scope.search.time == '-3 month'){
                                $scope.search.label = " of the last 3 months" ;
                            }else if($scope.search.time == '-6 month'){
                                $scope.search.label = " of the last 6 months" ;
                            }else if($scope.search.time == '-1 year'){
                                $scope.search.label = " of the last year" ;
                            }else if($scope.search.time == 'all'){
                                $scope.search.label = " from the start" ;
                            }
                        }
                    }, function (response) {
                        //error
                        $log.warn(response);
                    }).then(function(){
                    //completed
                    $scope.loading=false;
                    HoldOn.close();
                });
            },
            list:{},
            total_price: function(){
                var total = 0;
                if($scope.filter && $scope.filter==1){
                    var filtered_expenses_list = ($filter('filter')($filter('toArray')($scope.expenses.list,false), {title: $scope.search.search_text,eh_id:$scope.search.eh_id }));
                    var len = filtered_expenses_list.length;
                    angular.forEach(filtered_expenses_list, function (val,key) {
                        if(parseFloat(val.amount)>= parseFloat($scope.search.price.min) &&  parseFloat(val.amount)<= parseFloat($scope.search.price.max)){
                            total += parseFloat(val.amount);
                        }
                   });

                }else {
                    if($scope.search.global.length>0){
                        var filtered_expenses_list = ($filter('filter')($filter('toArray')($scope.expenses.list,false), $scope.search.global));
                        var len = filtered_expenses_list.length;
                        angular.forEach(filtered_expenses_list, function (val,key) {
                            total += parseFloat(val.amount);
                        });
                    }else {
                        for (var i=0; i<$scope.expenses.list.length; i++){
                            if($scope.expenses.list[i]) {
                                total += parseFloat($scope.expenses.list[i].amount);
                            }
                        }
                    }
                }

                return total;
            },
            heading:{
                eh_id:0,
                eh_details:''
            }
        };
        $scope.update_headings = function(){
            $scope.canceler = $q.defer();
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $scope.loading = true;
            $http.post($rootScope.base_url+'expense/update_heading',{
                    data: $scope.expenses.heading,
                    timeout: $scope.canceler.promise
                })
                .then(function (response) {
                    if(response.data.type && response.data.message){
                        if(response.data.type =='success'){
                            if(response.data.id && response.data.id>0){
                               var new_heading = {
                                   eh_id : response.data.id,
                                   eh_details : $scope.expenses.heading.eh_details
                               };
                                $scope.expenses.heading = new_heading;
                                $scope.heads = [].concat( $scope.heads,new_heading);
                            }
                        }
                        notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");
                    }
                }, function (response) {
                    //error
                    $log.warn(response);
                }).then(function(){
                //completed
                $scope.loading=false;
                HoldOn.close();
            });
        };
        $scope.edit_heading = function(exp){
            $scope.expenses.heading = exp
        };
        $scope.delete_heading = function(id){
            if( $scope.loading){
                return false;
            }
            $scope.canceler = $q.defer();
            HoldOn.open(options);
            var $elem = angular.element("#holdon-overlay #compiled_button");
            $elem.replaceWith($compile(button)($scope));
            $scope.loading = true;
            $http.post($rootScope.base_url+'expense/delete_heading',{
                    data: {id:id},
                    timeout: $scope.canceler.promise
                })
                .then(function (response) {
                    if(response.data.type && response.data.message){
                        if(response.data.type =='success'){
                            for(var i =0; i<$scope.heads.length; i++){
                                if($scope.heads[i].eh_id==id){
                                    $scope.heads.splice(i,1);
                                    break;
                                }
                            }
                        }
                        notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");
                    }
                }, function (response) {
                    //error
                    $log.warn(response);
                }).then(function(){
                //completed
                $scope.loading=false;
                HoldOn.close();
            });
        };

        $scope.expenses.get();
        $scope.expense = {
            order:'id',
            reverse:true,
            data:{
                id:0
            },
            edit: function (expense) {
               $scope.expense.data = expense;
                $scope.expense.data.id  = expense.id;
                $scope.expense.data.amount  = parseFloat(expense.amount);
                $scope.expense.data.date  = new Date(expense.date);

            },
            get:function(){

            },
            save:function(){
                $scope.expense.data.progress = 0;
                var options = {
                    theme:"sk-bounce",
                    // If theme == "custom" , the content option will be available to customize the logo
                    message:'<h1>Progress : '+ $scope.expense.data.progress +' %</h1><h4>Please wait. Expense is going to be '+($scope.expense.data.id>0?"updated":"inserted")+'.</h4>.'
                };
                HoldOn.open(options);
                Upload.upload({
                    url: $rootScope.base_url+'expense/save',
                    data: {file:$scope.expense.data.file,
                       post_data: $scope.expense.data
                    }
                }).then(function(resp) {
                    if(resp.data.message && resp.data.type) {
                        if(resp.data.type=='success'){
                            if(resp.data.new_data){
                                //var len = ($scope.expenses.list.length>0?$scope.expenses.list.length:0);
                                $scope.expenses.list = [].concat(resp.data.new_data, $scope.expenses.list);
                                $scope.expense.data = resp.data.new_data;
                                $scope.expense.data.date = new Date(resp.data.new_data.date);
                                $scope.expense.data.amount = parseFloat(resp.data.new_data.amount);
                            }
                            if(resp.data.image_name){
                                $scope.expense.data.file='';
                                $scope.expense.data.photo = resp.data.image_name;
                            }
                        }

                        notification("topright", resp.data.type, "fa " + (resp.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(resp.data.message) + " ");
                    }

                }, function (response) {
                    // Even when error in uploading data
                    $log.info(response);
                    if(response.status=='404'){
                        var message = "Error 404: The page you are looking for, not found."
                    }else {
                        var message = response.statusText;
                    }
                    notification("topright","error","fa fa-exclamation-circle vd_red",message);
                }, function (evt) {
                    //event for progress bar
                    $scope.expense.data.progress = parseInt(100.0 * evt.loaded / evt.total);
                    $log.info($scope.expense.data.progress);
                    if($scope.expense.data.progress>=99){
                        HoldOn.close();
                    }

                });


























                /*$scope.canceler = $q.defer();
                HoldOn.open(options);
                var $elem = angular.element("#holdon-overlay #compiled_button");
                $elem.replaceWith($compile(button)($scope));
                $scope.loading = true;
                $http.post($rootScope.base_url+'expense/save',{
                        data: $scope.expense.data,
                        timeout: $scope.canceler.promise
                    })
                    .then(function (response) {
                        if(response.data.message && response.data.type) {
                            if(response.data.type=='success' && response.data.new_data){
                                var len = $scope.expenses.list.length
                                $scope.expenses.list[len] = response.data.new_data;
                                $scope.expense.data = response.data.new_data;
                            }
                            notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");
                        }
                    }, function (response) {
                        //error
                        $log.warn(response);
                    }).then(function(){
                    //completed
                    $scope.loading=false;
                    HoldOn.close();
                });*/
            },
            get_head:function(he_id){
                for(var i = 0; i<$scope.heads.length; i++){
                    if($scope.heads[i].eh_id == he_id){
                        return $scope.heads[i].eh_details;
                    }
                }
            },
            delete_photo: function (expense) {
                if(expense){
                    $scope.canceler = $q.defer();
                    HoldOn.open(options);
                    var $elem = angular.element("#holdon-overlay #compiled_button");
                    $elem.replaceWith($compile(button)($scope));
                    $scope.loading = true;
                    $http.post($rootScope.base_url+'expense/delete_photo',{
                            data: {id:expense.id,photo:expense.photo},
                            timeout: $scope.canceler.promise
                        })
                        .then(function (response) {
                            if(response.data.type && response.data.message){
                                if(response.data.type=='success'){
                                    if($scope.expense.data.id ==expense.id){
                                        $scope.expense.data.photo = null;
                                    }
                                    for(var i =  0; i<$scope.expenses.list.length; i++){
                                        if($scope.expenses.list[i].id==expense.id){
                                            $scope.expenses.list[i].photo = null;
                                            break;
                                        }
                                    }
                                }
                                notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");
                            }
                        }, function (response) {
                            //error
                            $log.warn(response);
                        }).then(function(){
                        //completed
                        $scope.loading=false;
                        HoldOn.close();
                    });
                }
            },
            delete_expense : function (id) {
                if(id>0){
                    $scope.canceler = $q.defer();
                    HoldOn.open(options);
                    var $elem = angular.element("#holdon-overlay #compiled_button");
                    $elem.replaceWith($compile(button)($scope));
                    $scope.loading = true;
                    $http.post($rootScope.base_url+'expense/delete',{
                            data: {id:id},
                            timeout: $scope.canceler.promise
                        })
                        .then(function (response) {
                            if(response.data.type && response.data.message){
                                if(response.data.type=='success'){
                                    if($scope.expense.data.id == id){
                                        $scope.expense.data = { id:0 };
                                    }
                                    for(var i =  0; i<$scope.expenses.list.length; i++){
                                        if($scope.expenses.list[i].id==id){
                                            $scope.expenses.list.splice(i,1);
                                           break;
                                        }
                                    }
                                }
                                notification("topright", response.data.type, "fa " + (response.data.type == 'success' ? ' fa-check-circle vd_green' : 'fa-exclamation-circle vd_red') + "", $sce.trustAsHtml(response.data.message) + " ");
                            }
                        }, function (response) {
                            //error
                            $log.warn(response);
                        }).then(function(){
                        //completed
                        $scope.loading=false;
                        HoldOn.close();
                    });
                }
            }
        };




        var snapSlider = make_noUiSlider('slider-snap');
        if(snapSlider!=null) {
            var snapValues = [
                document.getElementById('slider-snap-value-lower'),
                document.getElementById('slider-snap-value-upper')
            ];

            snapSlider.noUiSlider.on('update', function (values, handle) {
                $timeout(function() {
                    $scope.search.price.min = parseFloat(values[0]);
                    $scope.search.price.max = parseFloat(values[1]);
                }, 0);
                snapValues[handle].innerHTML = values[handle];
            });
        }

    }]);




