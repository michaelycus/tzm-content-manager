angular.module('mainCtrl', [])

	.controller('commentController', function($scope, $http, Comment) {
		// object to hold all the data for the new comment form
		$scope.commentData = {};

		$scope.loading = true;
		
		// get all the comments first and bind it to the $scope.comments object
		Comment.get(media_type, media_id)
			.success(function(data) {
				$scope.comments = data;
				$scope.loading = false;
		});


		$scope.reload = function() {
			$scope.loading = true;

			Comment.get(media_type, media_id)
				.success(function(data) {
					$scope.comments = data;
					$scope.loading = false;
			});
		};	


		// function to handle submitting the form
		$scope.submitComment = function() {
			$scope.loading = true;

			$scope.commentData.reply_to = 0;

			//$scope.commentData.media_type=4;

			// save the comment. pass in comment data from the form
			Comment.save($scope.commentData)
				.success(function(data) {

					// if successful, we'll need to refresh the comment list
					Comment.get(media_type, media_id)
						.success(function(getData) {
							$scope.comments = getData;
							$scope.commentData.message = '';
							$scope.loading = false;
						});

				})
				.error(function(data) {
					console.log(data);
				});
		};

		$scope.submitReply = function(replyTo) {
			$scope.loading = true;
			
			$scope.commentData.reply_to = replyTo;
			$scope.commentData.message = $scope.commentData.reply_text;
			
			$scope.commentData.reply_text = ''; // delete because it's not necessary anymore

		 	// save the comment. pass in comment data from the form
			Comment.save($scope.commentData)
				.success(function(data) {

					// if successful, we'll need to refresh the comment list
					Comment.get(media_type, media_id)
						.success(function(getData) {
							$scope.comments = getData;
							$scope.commentData.message = '';
							$scope.loading = false;
						});

				})
				.error(function(data) {
					console.log(data);
				});
		};


		// function to handle deleting a comment
		$scope.deleteComment = function(id) {
			$scope.loading = true; 

			Comment.destroy(id)
				.success(function(data) {

					// if successful, we'll need to refresh the comment list
					Comment.get(media_type,media_id)
						.success(function(getData) {
							$scope.comments = getData;
							$scope.loading = false;
						});

				});
		};

		$scope.showComment = function(comment, current_user_id) {			
			return 	comment.user_id == current_user_id;		
		};

		$scope.replyTo = -1;

		$scope.replyComment = function(comment_id) {
			$scope.replyTo = comment_id;		
		};


	})

	// .controller('videoCommentController', function($scope, $http, VideoComment) {
	// 	// object to hold all the data for the new comment form
	// 	$scope.commentData = {};
	// 	$scope.commentData.replytext = '';

	// 	// loading variable to show the spinning loading icon
	// 	$scope.loading = true;
		
	// 	// get all the comments first and bind it to the $scope.comments object
		
	// 	VideoComment.get(init_video_id)
	// 		.success(function(data) {
	// 			$scope.comments = data;
	// 			$scope.loading = false;
	// 		});

	// 	// function to handle submitting the form
	// 	$scope.submitComment = function() {
	// 		$scope.loading = true;

	// 		$scope.commentData.reply_to = 0;

	// 		// save the comment. pass in comment data from the form
	// 		VideoComment.save($scope.commentData)
	// 			.success(function(data) {

	// 				// if successful, we'll need to refresh the comment list
	// 				VideoComment.get(init_video_id)
	// 					.success(function(getData) {
	// 						$scope.comments = getData;
	// 						$scope.commentData.message = '';
	// 						$scope.loading = false;
	// 					});

	// 			})
	// 			.error(function(data) {
	// 				console.log(data);
	// 			});
	// 	};		

	// 	$scope.submitReply = function(replyTo) {
	// 		$scope.loading = true;
			
	// 		$scope.commentData.reply_to = replyTo;
	// 		$scope.commentData.message = $scope.commentData.reply_text;
			
	// 		$scope.commentData.reply_text = ''; // delete because it's not necessary anymore

	// 	 	// save the comment. pass in comment data from the form
	// 		VideoComment.save($scope.commentData)
	// 			.success(function(data) {

	// 				// if successful, we'll need to refresh the comment list
	// 				VideoComment.get(init_video_id)
	// 					.success(function(getData) {
	// 						$scope.comments = getData;
	// 						$scope.commentData.message = '';
	// 						$scope.loading = false;
	// 					});

	// 			})
	// 			.error(function(data) {
	// 				console.log(data);
	// 			});
	// 	};

	// 	// function to handle deleting a comment
	// 	$scope.deleteComment = function(id) {
	// 		$scope.loading = true; 

	// 		VideoComment.destroy(id)
	// 			.success(function(data) {

	// 				// if successful, we'll need to refresh the comment list
	// 				VideoComment.get(init_video_id)
	// 					.success(function(getData) {
	// 						$scope.comments = getData;
	// 						$scope.loading = false;
	// 					});

	// 			});
	// 	};

	// 	$scope.showComment = function(comment, current_user_id) {			
	// 		return 	comment.user_id == current_user_id;		
	// 	};

	// 	$scope.replyTo = -1;

	// 	$scope.replyComment = function(comment_id) {
	// 		$scope.replyTo = comment_id;		
	// 	};		

	// })
;