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
use Illuminate\Support\Facades\Artisan;
Route::get('/','DashboardController@index')->name('test');

Auth::routes();

Route::get('/home', 'DashboardController@index')->name('home');

Route::get("/reboot",function (){
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    file_put_contents(storage_path('logs/laravel.log'),'');
    Artisan::call('key:generate');
    Artisan::call('config:cache');
    return '<center><h1>System Rebooted!</h1></center>';
})->name('reboot');


/* MR Inventory Start */
// Route::get('Employee/roles-add','DashboardController@roles')->name('user.roles.index');
// Route::post('Employee/roles-store','DashboardController@storeRole')->name('user.roles.store');
// Route::get('Employee/roles-edit/{id}','DashboardController@editRoles')->name('users.roles.edit');
// Route::post('Employee/roles-update/{id}','DashboardController@updateRoles')->name('users.role.update');
// Route::post('Employee/roles-destroy','DashboardController@destroyRoles')->name('users.roles.destroy');
// Route::get('/permission','DashboardController@assignPermissionToRole')->name('assignPermissionToRole');

Route::group(['middleware'=>['check_permission']],function() {
    Route::get('/','DashboardController@index')->name('test');


    Route::get('Employee/roles-add','DashboardController@roles')->name('user.roles.index');
    Route::post('Employee/roles-store','DashboardController@storeRole')->name('user.roles.store');
    Route::get('Employee/roles-edit/{id}','DashboardController@editRoles')->name('users.roles.edit');
    Route::post('Employee/roles-update/{id}','DashboardController@updateRoles')->name('users.role.update');
    Route::post('Employee/roles-destroy','DashboardController@destroyRoles')->name('users.roles.destroy');


    Route::get('/api_data', 'Inventory\ProductController@dataViaApi')->name('api_data');
    Route::get("add-warehouse","WarehouseController@index")->name('warehouse.add');
    Route::post("store-warehouse","WarehouseController@store")->name('warehouse.store');
    Route::get("edit-warehouse/{id}","WarehouseController@show")->name('warehouse.edit');
    Route::post("destroy-warehouse","WarehouseController@destroy")->name('warehouse.destroy');
    Route::post("update-warehouse/{id}","WarehouseController@update")->name('warehouse.update');
    /* Warehouse End */


    /* Cost Purpose Setup Start */
    Route::get("add-cost","CostController@index")->name('cost.add');
    Route::post("store-cost","CostController@store")->name('cost.store');
    Route::get("edit-cost/{id}","CostController@show")->name('cost.edit');
    Route::post("destroy-cost","CostController@destroy")->name('cost.destroy');
    Route::post("update-cost/{id}","CostController@update")->name('cost.update');
    /* Cost Purpose Setup End  */


    /* Inventory Department start */
    Route::get("Inventory/add-inventory-department","Inventory\InventoryDepartmentController@index")->name('inventory.department.add');
    Route::post("Inventory/store-inventory-department","Inventory\InventoryDepartmentController@store")->name('inventory.department.store');
    Route::get("Inventory/edit-inventory-department/{id}","Inventory\InventoryDepartmentController@edit")->name('inventory.department.edit');
    Route::post("Inventory/update-inventory-department/{id}","Inventory\InventoryDepartmentController@update")->name('inventory.department.update');
    Route::post("Inventory/destroy-inventory-department","Inventory\InventoryDepartmentController@destroy")->name('inventory.department.destroy');
    /* Inventory Department End */

    /* Inventory Group Start */
    Route::get("Inventory/add-inventory-group","Inventory\InventoryGroupController@index")->name('inventory.group.add');
    Route::post("Inventory/store-inventory-group","Inventory\InventoryGroupController@store")->name('inventory.group.store');
    Route::get("Inventory/edit-inventory-group/{id}","Inventory\InventoryGroupController@edit")->name('inventory.group.edit');
    Route::post("Inventory/update-inventory-group/{id}","Inventory\InventoryGroupController@update")->name('inventory.group.update');
    Route::post("Inventory/destroy-inventory-group","Inventory\InventoryGroupController@destroy")->name('inventory.group.destroy');
    /* Inventory Group End */


    /* Inventory Unit Start */
    Route::get("Inventory/add-inventory-unit","Inventory\InventoryUnitController@index")->name('inventory.unit.add');
    Route::post("Inventory/store-inventory-unit","Inventory\InventoryUnitController@store")->name('inventory.unit.store');
    Route::get("Inventory/edit-inventory-unit/{id}","Inventory\InventoryUnitController@edit")->name('inventory.unit.edit');
    Route::post("Inventory/update-inventory-unit/{id}","Inventory\InventoryUnitController@update")->name('inventory.unit.update');
    Route::post("Inventory/destroy-inventory-unit","Inventory\InventoryUnitController@destroy")->name('inventory.unit.destroy');
    /* Inventory Unit End */

    /* Inventory Supplier / Party Start */
    Route::get("Inventory/add-inventory-supplier","Inventory\InventorySupplierController@index")->name('inventory.supplier.add');
    Route::post("Inventory/store-inventory-supplier","Inventory\InventorySupplierController@store")->name('inventory.supplier.store');
    Route::get("Inventory/edit-inventory-supplier/{id}","Inventory\InventorySupplierController@edit")->name('inventory.supplier.edit');
    Route::post("Inventory/update-inventory-supplier/{id}","Inventory\InventorySupplierController@update")->name('inventory.supplier.update');
    Route::post("Inventory/destroy-inventory-supplier","Inventory\InventorySupplierController@destroy")->name('inventory.supplier.destroy');
    /* Inventory Supplier / Party End */

    /* Item Create Start */

    Route::get("Inventory/add-inventory-item","Inventory\ProductController@index")->name('inventory.item.add');
    Route::post("Inventory/store-inventory-item","Inventory\ProductController@store")->name('inventory.item.store');
    Route::get("Inventory/edit-inventory-item/{id}","Inventory\ProductController@edit")->name('inventory.item.edit');
    Route::post("Inventory/update-inventory-item/{id}","Inventory\ProductController@update")->name('inventory.item.update');
    Route::post("Inventory/destroy-inventory-item","Inventory\ProductController@destroy")->name('inventory.item.destroy');

    /* Group Wise Product List Start */

    Route::post("Inventory/group-wise-product-list","Inventory\ProductController@groupWiseProducts")->name('groupwise.productList');

    /* Group Wise Product List End */

    /* Item Create End */

    /* Requisition Start */
    Route::get("Inventory/add-inventory-requisition","Inventory\InventoryRequisitionController@index")->name('inventory.requisition.add');
    Route::get("Inventory/list-inventory-requisition","Inventory\InventoryRequisitionController@lists")->name('inventory.requisition.lists');

    /* product inforation according to product code or name - id */
    Route::post("Inventory/product-info-inventory-requisition","Inventory\InventoryRequisitionController@findProduct")->name('inventory.item.info');
    Route::post("Inventory/store-requisition-product-info-inventory-requisition","Inventory\InventoryRequisitionController@storeTempRequisitionInfo")->name('inventory.purchase.temp.store');

    /* Requisition product list retrive from TempData start */
    Route::get('pendingProductLists','Inventory\InventoryRequisitionController@productLists')->name('inventory.requisition.pending.products');
    Route::post('Inventory/product-remove-from-requisition-lists','Inventory\InventoryRequisitionController@removeItemFromList')->name('inventory.requisition.item.remove');
    /* R*/

    /* Requisition list store start */
    Route::post('store-purchase-requisition','Inventory\InventoryRequisitionController@storePurchaseRequisition')->name('inventory.store.requisition');
    /* Requisition list store End */
    /* Requisition List View in Front Page Start */
    Route::get("Inventory/view-purchase-requisition","Inventory\InventoryRequisitionController@requisitions")->name('inventory.purchase-requisition.view');
    Route::get("Inventory/view-single-purchase-requisition/{id}","Inventory\InventoryRequisitionController@singleRequisition")->name('inventory.purchase-requisition.single');
    Route::post("Inventory/single-item-approval-purchase-requisition/{id}",'Inventory\InventoryRequisitionController@checkingApproval')->name('inventory.requisition-item.checking-approval');
    Route::get("Inventory/view-approved-purchase-requisition/{id}","Inventory\InventoryRequisitionController@viewApprovedItems")->name('inventory.requisition.approved-items');
    /* Requisition List View in Front Page End */

    /* After Check Purchase Requisition List start*/
    Route::get('Inventory/after-check-purchase-requisition','Inventory\InventoryRequisitionController@AftercheckingItemLists')->name('purchase.requisition.after.check');
    /* After Check Purchase Requisition List end*/


    /* ========================== Purchase Requisition Start  ========================*/
    Route::get("Inventory/add-inventory-requisition-purchase","Inventory\InventoryPurchaseController@index")->name('inventory.requisition.purchase');
    Route::get("Inventory/purchase-order","Inventory\InventoryPurchaseController@order")->name('inventory.order.purchase');
    Route::post("Inventory/invoice-requisition/quotation-list","Inventory\InventoryPurchaseController@requisitionQuotationList")->name('inventory.ajax-quotation-list');
    Route::post("Inventory/purchase-store","Inventory\InventoryPurchaseController@store")->name('inventory.purchase.store');
    Route::get('Inventory/purchase-summary','Inventory\InventoryPurchaseController@summaryPurchase')->name('inventory.purchase.summary');
    Route::get('Inventory/purchase-order/print/{id}','Inventory\InventoryPurchaseController@printPurchaseOrder')->name('inventory.purchase.print');

    /* ========================== Purchase Requisition End  ==========================*/

    /* Quotation taking start */
    Route::get('Inventory/quotation-make/{id}','Inventory\InventoryPurchaseController@makeQuotation')->name('inventory.quotation.add');
    Route::post('Inventory/quotation-store/{id}','Inventory\InventoryPurchaseController@storeQuotation')->name('inventory.quotation.store');
    /* Quotation taking end */

    /* Quotation List start */
    Route::get('Inventory/requisition-quotation','Inventory\InventoryPurchaseController@quotationLists')->name('inventory.requisition.quotation.list');
    Route::get('Inventory/view-requisition-quotation/{id}','Inventory\InventoryPurchaseController@allQuotations')->name('quotations.list');
    Route::get('Inventory/comparative-statement-of-requisition-quotations/{id}','Inventory\InventoryPurchaseController@comparativeStatementQuotations')->name('quotations.comparative-statement');


    /* Quotation List End */


    /* Excel File Read Start */

    Route::get("file-read","Inventory\FileUploadController@index")->name('excel.read');
    Route::post("file-upload","Inventory\FileUploadController@store")->name('file.store');

    /* Excel File Read End */

     /* Goods in Start */
     Route::get("add-goodsin","GoodsinController@index")->name('goodsin.add');
     Route::post("store-goodsin","GoodsinController@store")->name('goodsin.store');
     Route::get('lc-cost','GoodsinController@lcCost')->name('lc.cost');
     Route::post('store-lc-cost','GoodsinController@storeLcCost')->name('lccost.store');
     Route::get('lc-report','GoodsinController@lcReport')->name('lc.report');

     Route::get('lc-report/{id}','GoodsinController@editLC')->name('lc.edit');
     Route::post('lc-report/{id}','GoodsinController@updateLC')->name('lc.update');

     Route::get('lc-report/{lc_id}/delete','GoodsinController@deleteLC')->name('lc.delete');
     Route::post('find-lc-report','GoodsinController@lcReportFind')->name('lc.reportFind');

     Route::post('find-quotation-products','GoodsinController@findQuotationProducts')->name('purchase.productList');

     /* Goods in End */
     /* Stock Management Start */

     Route::get('view-stock','StockController@index')->name('stock.view');
     Route::post('stock-info','StockController@productWise')->name('stock.retrive');
     Route::post('stock-report-cdf','StockController@stockReport')->name('cdf.stockreport');


        Route::get('Employee/add','EmployeeController@index')->name('employee.add');
        Route::post('Employee/save','EmployeeController@store')->name('employee.store');
        Route::get('Employee/edit/{id}','EmployeeController@show')->name('employee.edit');
        Route::post('Employee/update','EmployeeController@update')->name('employee.update');
        Route::post('Employee/erase','EmployeeController@destroy')->name('employee.destroy');

     /* Stock Management End */


    //Sales And Marketing Employee Dashboard Start
    ///////////////////////////////////////////////////////////////////////////////

    Route::get('dashboard-employee', 'Marketing\EmployeeDashboardController@index')->name('dashboard-employee');
    Route::get('daily-log', 'Marketing\EmployeeDashboardController@dailyLog')->name('daily-log');
    Route::get('daily-report', 'Marketing\EmployeeDashboardController@dailyReport')->name('daily-report');
    Route::get('monthly-log', 'Marketing\EmployeeDashboardController@monthlyLog')->name('monthly-log');


    Route::post('store-daily-log', 'Inventory\SalesControler@storeOrder')->name('store-daily-log');
    Route::get('Sales/view-order', 'Inventory\SalesControler@showOrder')->name('view-order');
    Route::get('Sales/invoice-show/{id}', 'Inventory\SalesControler@showInvoice')->name('invoice-show');
    Route::get('Sales/invoice-return/{id}', 'Inventory\SalesControler@returnInvoice')->name('invoice-return');
    Route::post('Sales/store/', 'Inventory\SalesControler@store')->name('sales.store');
    Route::post('Sales/returnStore/', 'Inventory\SalesControler@returnStore')->name('invoice.returnStore');
    ///////////////////////////////////////////////////////////////////////////////
    //Sales And Marketing Employee Dashboard End
    Route::get('Report/invoiceList/', 'InvoiceController@index')->name('invoice.list');

    Route::get('Report/invoicePrint/{id}', 'InvoiceController@printInvoice')->name('invoice.print');

    Route::get('/admin_permission','DashboardController@admin_permission')->name('admin_permission');
    Route::get('/goodsin_out_create','Inventory\InventoryGoodsOutController@convertRawToFinishedGoods')->name('inventory.goodsin_out.create');
    Route::post('/goodsin_out','Inventory\InventoryGoodsOutController@storeRawToFinishedGoods')->name('inventory.goodsin_out.store');

    Route::get('Report/Dues-Status','Inventory\InventoryReportController@partiesStatus')->name('parties.status');
    Route::post('Report/Laod-Parties-Data','Inventory\InventoryReportController@customerSupplierLoad')->name('report.load_parties');
    Route::post('/ChangeDues-Status','Inventory\InventoryReportController@partyCollection')->name('parties.changeDuesStatus');
    Route::get('Report/Income-Status','Inventory\InventoryReportController@incomeReport')->name('income.status');
    Route::get('Report/IncomeExpense-Status','Inventory\InventoryReportController@incomeExpenseReport')->name('income_expense.status');
});
// Route::prefix('UserManagement')->group(function(){
//     Route::get('/user-create','backend\UserController@index')->name('user.create');
//     Route::post('/user-store','backend\UserController@store')->name('user.store');
//     Route::get('/edit/{id}','backend\UserController@edit')->name('user.edit');
//     Route::post('/erase','backend\UserController@destroy')->name('user.destroy');
//     Route::post('/update-user/{id}','backend\UserController@update')->name('user.update');
//     Route::get('/role-create','backend\RoleController@index')->name('role.create');
//     Route::get('/role-view','backend\RoleController@view')->name('role.view');
//     Route::post('/role-store','backend\RoleController@store')->name('role.store');
//     Route::get('/role/edit/{id}','backend\RoleController@edit')->name('role.edit');
//     Route::patch('/role/{id}/update','backend\RoleController@update')->name('role.update');
// });

