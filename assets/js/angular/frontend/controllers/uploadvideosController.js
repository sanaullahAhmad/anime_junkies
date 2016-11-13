/**
 * Created by Shah on 4/23/2016.
 */
//angular.module("kp_clothes").requires.push('owlcarousel');

angular.module("kp_clothes").controller('uploadvideosController',['$scope','$rootScope','Upload','$timeout','$state','$http','$stateParams','$log',function ($scope,$rootScope,Upload,$timeout,$state,$http,$stateParams,$log) {
    $log.info("uploadvideos Controller");

    $scope.videofile={};

    $scope.uploadPic = function(video) {
        video.upload = Upload.upload({
            url: $rootScope.base_url+'home/video_uploads',
            data: {username: $scope.title, video: video},
        });

        video.upload.then(function (response) {
            $timeout(function () {
                video.result = response.data;
                //$('#videofile_placeholder').html(response.data);
                $scope.videofile=response.data;
            });
        }, function (response) {
            if (response.status > 0) {
                $scope.errorMsg = response.status + ': ' + response.data;
            }
        }, function (evt) {
            // Math.min is to fix IE which reports 200% sometimes
            video.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
        });
    }
    $scope.check_cond = false;
    $scope.video_uploads = function(fields) {
        //$('.process_video').show();
        $scope.check_cond = true;
        //$log.info(fields);
        //$log.info($scope.videofile);
        $http.post($rootScope.base_url+'home/video_uploads2/', { "videofile" : $scope.videofile, "data" : fields})
            .success(function (data) {
                if(data!=null){
                    $log.info(data);
                    //$('.process_video').hide();
                    $scope.check_cond = false;
                    $state.go('video', {slug: data});
                    //alert('sucess');
                }
            })
            .error(function (data,status,code) {
                $log.debug(data);
                //$state.go('meinevideos');
                alert('failur');
            });
    }
	//video uploader code goes here
		//end video uploader code
}]);

