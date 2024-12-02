<?php

use App\Http\Controllers\ProcessTransactionController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Enums\FileType;
use App\Http\Middleware\CheckUserRole;
use App\Http\Middleware\SomeOtherMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function() {
    return 'Welcome to dashboard';
});

Route::get('/users', function(){
    return ['kiran', 'sunita', 'snv'];
});

Route::match(['get','post'], '/testroute', function(){
    return 'Both get and post method request';
});

Route::any('/testroute2', function(){
    return 'Both get and post method request';
});

Route::redirect('/home', '/dashboard');

Route::get('/transanctionsold', function(){
    return 'Showing payment details for transaction ';
});
//http://localhost:8081/transanctionsold

Route::get('/transanctionsold/{transactionId}', function($id){
    return 'Showing payment details for transaction id: ' . $id;
});
//http://localhost:8081/transanctionsold/123

Route::get('/transanctionsold/{transactionId}/files/{fileId}', function($id, $fileId){
    return 'Showing with file id: ' . $fileId . ' for transaction id: ' . $id;
});
//http://localhost:8081/transanctionsold/123/files/1

// Route::get('/report/{year}/{month?}', function($year, $month = null){
//     return 'Showing report for the year: ' . $year . ' and month: ' . $month;
// });
//http://localhost:8081/report/2024/02


Route::get('/report/{reportId}', function(Request $request, $reportId){
    
    $year = $request->get('year');
    $month = $request->get('month');

    return 'Showing report for report id ' . $reportId . ' the year: ' . $year . ' and month: ' . $month;
});
//http://localhost:8081/report/3455?year=2024&month=2

Route::get('/transanctionstype/{transactionId}', function(int $id){
    return 'Showing payment details for transaction id with strict type: ' . $id;
})->where('transactionId','[0-9]+');
//http://localhost:8081/transanctionstype/22.22 => not found and 404 error will throw
//http://localhost:8081/transanctionstype/22 => found and result we will be shown

Route::get('/transanctionstype/{transactionId}/files/{fileId}', function(int $id, int $fileId){
    return 'Showing with strict type file id: ' . $fileId . ' for transaction id: ' . $id;
})->where('transactionId','[0-9]+')
    ->where('fileId','[0-9]+');

//http://localhost:8081/transanctionstype/22.20/files/55.55   => not found 
//http://localhost:8081/transanctionstype/22/files/55   =>  found 


// Route::get('/transanctionstypewhere/{transactionId}/files/{fileId}', function(int $id, int $fileId){
//     return 'Showing with strict type file id: ' . $fileId . ' for transaction id: ' . $id;
// })->whereNumber(['transactionId','fileId']);

//http://localhost:8081/transanctionstypewhere/22.20/files/55.55   => not found 
//http://localhost:8081/transanctionstypewhere/22/files/55   =>  found 


Route::get('/transanctionstypewhere/{transactionId}/files/{fileType}', function(int $id, FileType $fileType){
    return 'Showing with strict type file type: ' . $fileType->value . ' for transaction id: ' . $id;
});
//http://localhost:8081/transanctionstypewhere/22/files/receipt


// Route::get('/transanctions', [TransactionController::class, 'index']);
// //http://localhost:8081/transanctions
// Route::get('/transanctions/create', [TransactionController::class, 'create']);
// //http://localhost:8081/transanctions/create
// Route::get('/transanctions/{transactionId}', [TransactionController::class, 'show']);
// //http://localhost:8081/transanctions/12334

// Route::post('/transanctions', [TransactionController::class, 'store']);

// //single action controller route (it must be used for post route here only for demo purpose it is used.)
// Route::get('transanctions/{transactionId}/process', [ProcessTransactionController::class, '__invoke']);

Route::get('/documents', [DocumentController::class, 'index'])->name('documents');
//grouping transactions
Route::prefix('transanctions')->group(function(){
    Route::controller(TransactionController::class)->group(function(){
        Route::get('/','index')->name('home');
        //http://localhost:8081/transanctions/home
        Route::get('/create','create')->name('create');
        //http://localhost:8081/transanctions/create
        Route::get('/{transactionId}','show')->name('show');
        //http://localhost:8081/transanctions/122/
        Route::post('/', 'store')->name('store');
        //http://localhost:8081/transanctions/ => post methoid
        Route::get('/{transactionId}/documents','documents')->name('documents');
        //http://localhost:8081/transanctions/122/documents
    });

    Route::get('/{transactionId}/process', ProcessTransactionController::class); 
});
//http://localhost:8081/transanctions/12334/process
//http://localhost:8081/transanctions/12334
//http://localhost:8081/transanctions/
//http://localhost:8081/transanctions/create
//http://localhost:8081/transanctions/  =>for store 

Route::get('/administration', function(){
    return 'Secret Admin Page';
})->middleware(CheckUserRole::class);

//=>you will see 404 error if your run route:http://localhost:8081/administration
//$user = ['id'=>1, 'name'=> 'Gio', 'role'=>'admin'];
//=>you will see Secret Admin Page if your run route:http://localhost:8081/administration

//using group middleware route
Route::prefix('/administrationgroup')->middleware(CheckUserRole::class)->group(function(){
    Route::get('/', function(){
        return 'Secret administrationgroup Page';
    });
    Route::get('/other', function(){
        return 'Secret administrationgroup other Page';
    });
});
//http://localhost:8081/administrationgroup
//http://localhost:8081/administrationgroup/other


//using group multiple middleware route and exclude any middleware 
Route::prefix('/administrationgroupmultiplemiddleware')->middleware([CheckUserRole::class, SomeOtherMiddleware::class])->group(function(){
    Route::get('/', function(){
        return 'Secret administrationgroupmultiplemiddleware Page';
    });
    Route::get('/other', function(){
        return 'Secret administrationgroupmultiplemiddleware other Page';
    })->withoutMiddleware(SomeOtherMiddleware::class);
});
//http://localhost:8081/administrationgroupmultiplemiddleware
//http://localhost:8081/administrationgroupmultiplemiddleware/other


//using group multiple without middleware route and exclude any middleware 
Route::prefix('/administrationgroupmultiplewithoutmiddleware')->middleware([CheckUserRole::class, SomeOtherMiddleware::class])->group(function(){
    Route::get('/', function(){
        return 'Secret administrationgroupmultiplewithoutmiddleware Page';
    });

    Route::withoutMiddleware(SomeOtherMiddleware::class)->group(function(){
        Route::get('/other', function(){
            return 'Another admin page';
        });
    });
});
//http://localhost:8081/administrationgroupmultiplewithoutmiddleware
//http://localhost:8081/administrationgroupmultiplewithoutmiddleware/other