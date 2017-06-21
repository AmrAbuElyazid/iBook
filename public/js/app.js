var app = angular.module('booksApp', []);

app.controller('usersController', function ($scope, $http, $rootScope) {
	$rootScope.baseUrl = 'http://sa-book.com/admin/public';
	$scope.newUser = function (ev) {
		ev.preventDefault();
		if($scope.user.password == $scope.user.password_confirmation) {
			$http.post($rootScope.baseUrl + '/new_user', {
				name: $scope.user.name,
				email: $scope.user.email,
				password: $scope.user.password
			}).then(function (results) {
				if(results.data.state == true) {
					swal('Done!');
					$scope.user = {};
				}else{
					swal('User already exists!');
				}
			})
		}else{
			swal('Passwords doesn\'t match!');
		}
	}

});
