/**
 * Created by Shah on 4/23/2016.
 */
//angular.module("kp_clothes").requires.push('owlcarousel');

angular.module("kp_clothes").filter('commentfilter', function() {
    return function(input) {
      var out = []; 
      for(i in input){
        out.push(input[i]);
      }
      return out;
    }
  }).controller('videodetailController',['$scope','$rootScope','$state','$http','$stateParams','$log',function ($scope,$rootScope,$state,$http,$stateParams,$log) {
    $log.info("Video Detail Controller");
	
	//$log.info($stateParams);
    // $state.current.data.pageTitle = "Hello";

    //angular.element(".selecter_1").selecter();
   // $log.debug(Products.test);
    $scope.owlConfigSingle = {
        slideSpeed : 300,
        paginationSpeed : 400,
        singleItem:true,
        autoPlay: 4500,
        lazyLoad : true
    };
	
    $scope.videos = {};
	$scope.get_videos = function(){
		$http.get($rootScope.base_url+'home/get_single_videos/'+$stateParams.slug)
			.success(function (data) {
				if(data!=null){
				   $scope.videos = data.videos;
				}
			})
			.error(function (data,status,code) {
				$log.debug(data);
				$log.info("line32");
			});
	};
	$scope.get_videos();
	
	//get comments of this video
	$scope.comments = {};
	$scope.get_comments = function(){
		$http.get($rootScope.base_url+'home/get_video_comments/'+$stateParams.slug)
			.success(function (data) {
				if(data!=null){
				   $scope.comments = data.comments;
				}
			})
			.error(function (data,status,code) {
				$log.debug(data);
				$log.info("line48");
			});
	};
	$scope.get_comments();
	$scope.url = $rootScope.base_url+'home/post_comments/'; // The url of our search
	$scope.post_comments_request = {};
	$scope.commnet_data = {
			video_id: null,//$scope.videos.id,
			user_id: null,//$scope.videos.user_id,
			parent_id:0
		};
	$scope.post_comments = function(){
		$scope.commnet_data.video_id = $scope.videos.id;
		$scope.commnet_data.user_id = $scope.videos.user_id;
	
		$http.post($scope.url, { "data" : $scope.commnet_data})
			.success(function (data) {
				if(data!=null){
				   $scope.post_comments_request = data.post_comments_request;
					$scope.comments = [].concat($scope.comments , data.comments)
					$scope.commnet_data.comment_text = null;
				}
			})
			.error(function (data,status,code) {
				$log.debug(data);
			});
	};
   //$scope.post_comments();
   
   
    $scope.comment_submit_function = function(event) {
	 if(event.which === 13) {
		  if(event.shiftKey){
		  }
		  else
		  {
			$scope.post_comments();
			event.preventDefault();
		  }
		}
    }
	
	//like unlike functions
	$scope.like_data = {
			video_id: null,
			user_id: null
		};
    $scope.like_video = function(like) {
		$scope.like_data.video_id = $scope.videos.id;
		$scope.like_data.user_id = $scope.videos.user_id;
		$scope.like_data.like = like;
	    $http.post($rootScope.base_url+'home/like_video/', { "data" : $scope.like_data})
			.success(function (data) {
				if(data!=null){
					//$log.debug($scope.like_data);
					$scope.video_likes_count   =  data.video_likes_count;
					$scope.video_unlikes_count =  data.video_unlikes_count;
				}
			})
			.error(function (data,status,code) {
				$log.debug(data);
			});
    }

	//like count function
	$scope.video_likes_count = {};
	$scope.likes_count = function(){
		$http.get($rootScope.base_url+'home/get_video_likes_count/'+$stateParams.slug)
			.success(function (data) {
				if(data!=null){
					$scope.video_likes_count = data.video_likes_count;
				}
			})
			.error(function (data,status,code) {
				$log.debug(data);
				$log.info("line131");
			});
	};
	$scope.likes_count();

	//unlikes count function
	$scope.video_unlikes_count = {};
	$scope.unlikes_count = function(){
		$http.get($rootScope.base_url+'home/get_video_likes_count/'+$stateParams.slug+'/unlike')
			.success(function (data) {
				if(data!=null){
					$scope.video_unlikes_count = data.video_unlikes_count;
				}
			})
			.error(function (data,status,code) {
				$log.debug(data);
				$log.info("line148");
			});
	};
	$scope.unlikes_count();
   // $log.info($scope.video_likes_count);


}]);

