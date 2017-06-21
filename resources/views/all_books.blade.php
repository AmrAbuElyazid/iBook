@extends('layouts.app')

@section('content')
	
	<script type="text/javascript">
		app.controller('allBooksCtrl', function ($scope, $http) {
			$scope.books = {!! $books !!};
			$scope.removeBook = function (book_id) {

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
					$http.post('/removeBook', {
						book_id: book_id
					}).then(function (res) {
						if(res.data.state) {
							for (var i = $scope.books.length - 1; i >= 0; i--) {
								if($scope.books[i].id == book_id) {
									$scope.books.splice(i, 1);
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

	<div ng-app="booksApp" ng-controller="allBooksCtrl">
		<div class="panel panel-default" ng-repeat="book in books">
			<!-- Default panel contents -->
			<div class="panel-heading">
				<div id="orangeBox" ng-click="removeBook(book.id)">
				  <span id="x">X</span>
				</div>
				<center>
					@{{book.book_name}} - @{{book.book_date}}
				</center>
			</div>
			<div class="panel-body">
			@{{book.book_desc}}
			</div>
		
			<!-- Table -->
			<table class="table">
				<thead>
					<tr>
						<th>
							<center>
								<p><a style="color: grey !important" target="_blank" href="@{{book.book_url}}">فتح الكتاب</a></p>
							</center>
						</th>
					</tr>
				</thead>
			</table>
		</div>
	</div>
@stop