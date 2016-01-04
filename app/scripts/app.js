'use strict';

/**
 * @ngdoc overview
 * @name supporterApp
 * @description
 * # supporterApp
 *
 * Main module of the application.
 */
angular
    .module('supporterApp', [
        'ngAnimate',
        'ngTouch',
        'ui.router',
    ])
    .config(function ($stateProvider, $urlRouterProvider) {
        //
        // For any unmatched url, redirect to /state1
        $urlRouterProvider.otherwise('/overview');
        //
        // Now set up the states
        $stateProvider
            .state('overview', {
                url: '/overview',
                views: {
                    '': {
                        templateUrl: 'views/overview.html'
                    },
                    'coursesearch@overview': {
                        templateUrl: 'views/coursesearch.html'
                    },
                    'courseinfo@overview': {
                        templateUrl: 'views/courseinfo.html'
                    },
                    'usersearch@overview': {
                        templateUrl: 'views/usersearch.html'
                    },
                    'userinfo@overview': {
                        templateUrl: 'views/userinfo.html'
                    },
                }
            });
    });
