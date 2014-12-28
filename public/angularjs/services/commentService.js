angular.module('commentService', [])

	.factory('Comment', function($http) {

		return {
			get : function(media_type, media_id) {
				return $http.get('/api/comments/' + media_type + '/' + media_id);
			},
			show : function(id) {
				return $http.get('/api/comments/' + id);
			},
			save : function(commentData) {
				return $http({
					method: 'POST',
					url: '/api/comments',
					headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
					data: $.param(commentData)
				});
			},
			destroy : function(id) {
				return $http.delete('/api/comments/' + id);
			}
		}
	})

	// .factory('VideoComment', function($http) {

	// 	return {
	// 		get : function(video_id) {
	// 			return $http.get('/api/videos/' + video_id + '/comments');
	// 		},
	// 		show : function(id) {
	// 			return $http.get('/api/comments/' + id);
	// 		},
	// 		save : function(commentData) {
	// 			return $http({
	// 				method: 'POST',
	// 				url: '/api/comments',
	// 				headers: { 'Content-Type' : 'application/x-www-form-urlencoded' },
	// 				data: $.param(commentData)
	// 			});
	// 		},
	// 		destroy : function(id) {
	// 			return $http.delete('/api/comments/' + id);
	// 		}
	// 	}
	// });

