<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Storage;


Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('all_books', function() {
	$books = App\Book::all();
    return view('all_books', compact('books'));
});

Route::get('problems', function() {
    $problems = App\Problem::all();
    return view('problems', compact('problems'));
});

Route::get('categories', function() {
    return DB::table('cats')->get();
});

Route::get('upload_books', function() {
    return view('upload');
});

Route::post('removeBook', function(Request $request) {
	$book = App\Book::find($request['book_id']);
	$book->delete();
	return ['state' => true];
});

Route::post('upload_books', function(Request $request) {

	if($request->hasFile('book_file')) {
		$file = $request->file('book_file');

	    if ($file->getClientOriginalExtension() != 'pdf') {
		    return '<script>alert("Only PDFs are allowed!"); window.location="/upload_books";</script>';
	    }

	    $name = str_random(100) . '.' . $file->getClientOriginalExtension();
	    
	    Storage::disk('s3')->put($name, file_get_contents($file->getRealPath()));
	    $book = new App\Book;
	    $book->book_name = $request['book_name'];
	    $book->book_author = $request['book_author'];
	    $book->book_desc = $request['book_desc'];
	    $book->book_date = $request['book_date'];
	    $book->book_url = 'https://s3-us-west-2.amazonaws.com/pdfbooksproject/' . $name;
        $book->category = $request['category'];
	    $book->save();

	    return '<script>alert("تم!"); window.location="/upload_books";</script>';
	}else{
		echo 'No file';
	}

});

Route::get('new_user', function() {
    return view('new_user');
});


Route::post('/new_user', function (Request $request, User $user) {
    $checkExisting = User::whereEmail($request['email'])->first();
    if(count($checkExisting) > 0) {
    	return ['state' => false];
    }
    $user->email = $request['email'];
    $user->name = $request['name'];
    $user->password = bcrypt($request['password']);
    $user->save();

    return ['state' => true];
});

Route::group(['prefix' => 'users'], function() {
    Route::get('get', ['uses' => 'UserController@get']);
    Route::post('update', ['uses' => 'UserController@update']);
    Route::post('delete', ['uses' => 'UserController@delete']);
});

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');


Route::post('/check_cred', function(Request $request) {
    if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']], true)) {
	    return 'true';
    }

    return 'false';
});


Route::get('find_books/{query}', function($query) {
    $books = App\Book::where('book_name', 'like', '%' . $query . '%')->orWhere('book_author', 'like', '%' . $query . '%')
    ->orWhere('category', 'like', '%' . $query . '%')->get();
    return $books;
});


Route::get('getBook/{id}', function($id) {
	$book = App\Book::find($id);
    return $book->book_url;
});

Route::get('getAllBooks', function() {
    return App\Book::all();
});

Route::post('report', function(Request $request) {
    $report = new App\Problem([
    	'body' => $request['body']
    ]);
    $report->user()->associate(User::whereEmail($request['email'])->first());
    $report->book()->associate(App\Book::find($request['book_id']));
    $report->save();
    return ['state' => true];
});