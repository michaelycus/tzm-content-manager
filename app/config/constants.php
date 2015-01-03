<?php


// - TASKS - 

define('TASK_VIDEO_ADDED',           20);
define('TASK_VIDEO_TRANSLATING',     21);
define('TASK_VIDEO_SYNCHRONIZING',   22);
define('TASK_VIDEO_PROOFREADING',    23);
define('TASK_VIDEO_FINISHED',        24);
define('TASK_VIDEO_MOV_PROOFREADING',25);
define('TASK_VIDEO_MOV_PUBLISHED',   26);
define('TASK_VIDEO_RET_AVAILABLE',   27);
define('TASK_VIDEO_RET_PROOFREADING',28);
define('TASK_VIDEO_DELETED',         29);
define('TASK_VIDEO_COMMENT',         30);

define('TASK_ARTICLE_ADDED',         40);
define('TASK_ARTICLE_APPROVED',      41);
define('TASK_ARTICLE_NEED_ADJUST',   42);
define('TASK_ARTICLE_MOV_SCHEDULED', 43);
define('TASK_ARTICLE_MOV_PUBLISHED', 44);
define('TASK_ARTICLE_RET_AVAILABLE', 45);
define('TASK_ARTICLE_RET_SCHEDULED', 46);
define('TASK_ARTICLE_DELETED',       47);
define('TASK_ARTICLE_COMMENT',       48);


// - MEDIAS STATUS - 

define('MEDIA_VIDEO_AVAILABLE',    10);
define('MEDIA_VIDEO_PROOFREADING', 11);
define('MEDIA_VIDEO_PUBLISHED',    12);

define('MEDIA_ARTICLE_AVAILABLE',  20);
define('MEDIA_ARTICLE_SCHEDULED',  21);
define('MEDIA_ARTICLE_PUBLISHED',  22);


// - USER AUTH - 

define('USER_NOT_AUTHORIZED',    0);
define('USER_AUTH_OPERATOR',     1);
define('USER_AUTH_ADMIN',        2);
define('USER_AUTH_OWNER',        3);


// define('MEDIA_TYPE_ARTICLE',        1);
// define('MEDIA_TYPE_ARTICLE_PANEL',  2);
// define('MEDIA_TYPE_VIDEO',          3);
// define('MEDIA_TYPE_VIDEO_PANEL',    4);


// define('VIDEO_FOR_APPROVAL',		  	 0);
// define('VIDEO_STATUS_TRANSLATING',   1);
// define('VIDEO_STATUS_SYNCHRONIZING', 2);
// define('VIDEO_STATUS_PROOFREADING',  3);
// define('VIDEO_STATUS_FINISHED',  		 4);
// define('VIDEO_STATUS_REJECTED',  		 5);

// define('VIDEO_STATUS_LABEL', serialize(array('Need to be approved',
// 										     'Open for translations', 
// 										     'Synchronizing',									   
// 										     'Open for proofreading',
// 										     'Finished',
// 										     'Rejected')));




// define('TASK_REJECTED_VIDEO',    5); // VIDEO_STATUS_REJECTED
// define('TASK_APPROVED_VIDEO',    6);

// define('TASK_ADVANCE_TO_SYNC',   7);
// define('TASK_ADVANCE_TO_PROOF', 8);
// define('TASK_FINISHED_VIDEO',   9);

// define('TASK_BACK_TO_TRANS',  10);
// define('TASK_BACK_TO_SYNC',   11);
// define('TASK_BACK_TO_PROOF',  12);





// define('TASK_SUGGESTED_VIDEO', 	0); // VIDEO_FOR_APPROVAL
// define('TASK_IS_TRANSLATING', 	1); // VIDEO_STATUS_TRANSLATING
// define('TASK_IS_SYNCHRONIZING', 2); // VIDEO_STATUS_SYNCHRONIZING
// define('TASK_IS_PROOFREADING', 	3); // VIDEO_STATUS_PROOFREADING
// define('TASK_IS_FINISHED', 	    4); // VIDEO_STATUS_FINISHED

// define('TASK_REJECTED_VIDEO', 	5); // VIDEO_STATUS_REJECTED
// define('TASK_APPROVED_VIDEO', 	6);

// define('TASK_ADVANCE_TO_SYNC', 	7);
// define('TASK_ADVANCE_TO_PROOF', 8);
// define('TASK_FINISHED_VIDEO',   9);

// define('TASK_BACK_TO_TRANS', 	10);
// define('TASK_BACK_TO_SYNC', 	11);
// define('TASK_BACK_TO_PROOF', 	12);

// define('TASKS_TYPE_LABEL', serialize(
//                               array('suggested the video.',
//                                     'is translating.',
//                                     'is helping to sync.',
//                                     'is proofreading the video.',
//                                     'finished the video.',
//                                     'rejected the video',
//                                     'approved the video.',
//                                     'move the video to synchronization.',
//                                     'move the video to proofreading.',
//                                     'finish the video.',
//                                     'return the video to translating.',
//                                     'return the video to synchronization',
//                                     'return the video to proofreading')));

define('TASKS_TYPE_LABEL_DASHBOARD', serialize(
                                       array('suggested',
                                             'is translating',
                                             'is helping to sync',
                                             'is proofreading',
                                             'finished',
                                             'rejected',
                                             'approved',
                                             'moved to synchronization',
                                             'moved to proofreading',
                                             'finished',
                                             'returned to translating',
                                             'returned to synchronization',
                                             'returned to proofreading')));


// define('IMG_VIDEO_STATUS', serialize(
//                               array('fa-star', 
//               										  'fa-text-width',										   
//               										  'fa-clock-o',
//               										  'fa-eye',
//               										  'fa-check',
//               										  'fa-thumbs-down',
//               										  'fa-thumbs-up',
//                                     'fa-arrow-right',
//                                     'fa-arrow-right',
//                                     'fa-check',
//                                     'fa-arrow-left',
//                                     'fa-arrow-left',
//                                     'fa-arrow-left')));

// define('VIDEO_MARKS', serialize(
//                           array('I need some assistence!', 
//                                 'It need a review!',                       
//                                 'I do not know how to synchronize!',
//                                 'It deserves a better synchronization!',
//                                 'It needs one more review!',
//                                 'It needs two more reviews!',
//                                 'I believe it is done!')));


// define('VIDEO_MARK_I_NEED_SOME_ASSISTENCE',   0);


// define('ARTICLE_STATUS_AVAILABLE',  0);
// define('ARTICLE_STATUS_REVIEWED',   1);
// define('ARTICLE_STATUS_SCHEDULED',  2);
// define('ARTICLE_STATUS_PUBLISHED',  3);


// define('USER_SCORE_TRANSLATED',   0);
// define('USER_SCORE_SYNCHRONIZED', 1);
// define('USER_SCORE_PROOFREADED',  2);
// define('USER_SCORE_SUGGESTED',    3);
// define('USER_SCORE_OPENED',       4);
// define('USER_SCORE_WORKED_IN',    5);
// define('USER_SCORE_TOTAL',        6);

// define('SCORE_TRANSLATED',        30);
// define('SCORE_SYNCHRONIZED',      20);
// define('SCORE_PROOFREADED',       15);


