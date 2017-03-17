(function()
{
    'use strict';

    var IndexCtr = function ($scope, $sce, IndexFactory) {

        $scope.email = '';
        $scope.fname = '';
        $scope.lname = '';
        //$scope.password = '';

        $scope.alert = {
            error : false,
            message: ''
        };


        /*-----------------------------------------------
                User Login
         -----------------------------------------------*/
        // $scope.DoLogin = function()
        // {
        //     if($scope.useremail.length == 0) {
        //         $scope.alert = {error: true, message: 'Email is required'};
        //         return;
        //     }
        //
        //     if($scope.userpassword.length == 0) {
        //         $scope.alert = {error: true, message: 'Password is required'};
        //         return;
        //     }
        //
        //     //otherwise proceed with the login
        //     IndexFactory.DoLogin($scope.useremail, $scope.userpassword)
        //     .then(function(result){
        //         var data = result.data;
        //
        //         //successfull login
        //         if(data.is_success == true)
        //             window.location.href = '/';
        //         else if(data.is_success == false){
        //             $scope.alert = {
        //                 error : true,
        //                 message : data.errors[0]
        //             }
        //         }
        //     });
        // }


        /*-----------------------------------------------------------
                Generate random password
         -----------------------------------------------------------*/
        $scope.MakePassword = function()
        {
            var count = 8;
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

            for( var i=0; i < count; i++ )
                text += possible.charAt(Math.floor(Math.random() * possible.length));

            $('#password').val(text);
            //return text;
        }
    }


    angular.module('Membership')
        .controller("IndexCtr", ['$scope', '$sce', 'IndexFactory', IndexCtr]);
})();
