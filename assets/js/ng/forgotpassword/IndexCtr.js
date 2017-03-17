(function() {
    'use strict';

    var IndexCtr = function ($scope, $sce, IndexFactory) {
        $scope.useremail = '';

        $scope.alert = {
            error : false,
            success: false,
            message: ''
        };

        /*-----------------------------------------------
         User Login
         -----------------------------------------------*/
        $scope.GetPassword = function()
        {
            //reset alert message //if any shown
            $scope.alert = { error : false, success: false, message : '' };

            //on empty email field
            if($scope.useremail.length == 0) {
                $scope.alert = {error: true, message: 'Email is required'};
                return;
            }

            //if everything is ok than proceed
            var csrf = $('#csrf').val();
            $('#loader').show(); //show loader

            IndexFactory.GetPassword($scope.useremail, csrf)
                .then(function (result) {
                    var data = result.data;

                    //successfull login
                    if (data.is_success == true) {
                        $scope.alert = { success: true, message: data.message };
                    }
                    else if (data.is_success == false) {
                        $scope.alert = { error: true, message: data.message };
                    }

                    $('#loader').hide();
                });
        };


        //initialize controller
        init();
        function init() {
            $('#loader').hide();
        }
    };

    angular.module('Membership')
        .controller("IndexCtr", ['$scope', '$sce', 'IndexFactory', IndexCtr]);
})();