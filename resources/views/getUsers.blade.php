@extends('layouts.app')

@section('content')
<script type="text/javascript">
	app.controller('usersCtrl', function ($scope, $http, $rootScope) {
		$scope.users = {!! $users !!};
		$rootScope.baseUrl = 'http://sa-book.com/admin/public';
		$scope.submit = function (user, field) {
			$http.post($rootScope.baseUrl + '/users/update', {
				user: user,
				field: field
			}).then(function (res) {
				if(res.data.state) {
					swal('تم!');
					user.editName = false;
					user.editEmail = false;
				}else{
					swal('خطأ, حاول مره اخري!')
				}
			})
		}

		$scope.removeUser = function (user_id) {

			swal({
			  title: "هل انت متأكد؟",
			  text: "هذه العمليه غير قابله للاستعاده!",
			  type: "error",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "نعم, قم بالمسح!",
			  cancelButtonText: "الغاء",
			  closeOnConfirm: false
			},
			function(){
				$http.post($rootScope.baseUrl + '/users/delete', {
					user_id: user_id
				}).then(function (res) {
					if(res.data.state) {
						for (var i = $scope.users.length - 1; i >= 0; i--) {
							if($scope.users[i].id == user_id) {
								$scope.users.splice(i, 1);
								break;
							} 
						}
						swal("تم المسح بنجاح!", "", 'success');
					}else{
						swal('خطأ, حاول مره اخري!')
					}
				})
			});

		}
	})
</script>
	
<div ng-app="booksApp" ng-controller="usersCtrl">
	<div class="list" style="margin-top: -10%;">

	  <div class="item item-input-inset">
	    <label>
	      <input type="text" placeholder="بحث عن عضو.." size="100%" style="text-align: center" ng-model="search">
	    </label>
	  </div>

	</div>
	<div style="background: white;" class="text-right">
		<table class="table table-bordered">
			<tr><td id="caption" colspan="4"><center>اداره جميع الاعضاء</center></td></tr>
			<th>
				<td>كلمه المرور</td>
				<td>البريد الالكتروني</td>
				<td>الاسم</td>
				{{-- <td></td> --}}
			</th>
			<tr ng-repeat="user in users | filter:search">
				<td>
					<center>
						<button ng-click="removeUser(user.id)" class="button button-assertive" style="zoom: 0.5">
						  <span style="zoom: 1.5">X</span>
						</button>
					</center>
				</td>
				<td ng-click="user.editPassword = true;">
					<center>
						<button ng-show="!user.editPassword" class="button button-calm" style="zoom: 0.7">
						  <span style="zoom: 1.3">تغيير كلمه المرور</span>
						</button>
						<input ng-show="user.editPassword" type="password" ng-model="user.password" ng-keyup="$event.keyCode == 13 ? submit(user, field = 'password') : null" autofocus>
					</center>
				</td>
				<td class="pointer" ng-click="user.editEmail = true">
					<span ng-show="!user.editEmail">@{{user.email}}</span>
					<input ng-show="user.editEmail" type="text" ng-model="user.email" ng-keyup="$event.keyCode == 13 ? submit(user, field = 'email') : null" autofocus>
				</td>
				<td class="pointer" ng-click="user.editName = true">
					<span ng-show="!user.editName">@{{user.name}}</span>
					<input ng-show="user.editName" type="text" ng-model="user.name" ng-keyup="$event.keyCode == 13 ? submit(user, field = 'name') : null" autofocus>
				</td>
			</tr>
		</table>
	</div>
</div>
@stop