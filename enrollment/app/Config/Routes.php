<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index',['filter' => 'auth']);

$routes->post('/handleLogin', 'Auth::handleLogin');
$routes->post('/reset', 'Home::reset');

$routes->get('/handleLogout', 'Auth::logout',['as' => 'logout']);

$routes->post('/displaySubjects', 'Enrollment::displaySubjects',['namespace' => 'App\Controllers\enrollment']);
$routes->post('/saveStud', 'Enrollment::saveStud',['namespace' => 'App\Controllers\enrollment']);
$routes->post('/enroll_now', 'Enrollment::enroll_now',['namespace' => 'App\Controllers\enrollment']);

$routes->group('enrollment', function($routes) {
	$routes->get('enroll', 'Enrollment::index',['as' => 'Enroll','namespace' => 'App\Controllers\enrollment','filter' => 'auth']);
	$routes->add('result', 'Enrollment::studyload',['as' => 'result','namespace' => 'App\Controllers\enrollment','filter' => 'auth']);

});

// $routes->get('/sell', 'Sales::index',['filter' => 'auth']);
// $routes->get('/sales', 'SalesData::index',['filter' => 'auth']);
// $routes->get('/daily_sales_report', 'SalesData::dailySales');
// $routes->group('admin', function($routes) {
// 	$routes->get('/', 'Inventory::index',['as' => 'Inventory','namespace' => 'App\Controllers\admin']);
// 	$routes->get('order', 'Order::index',['as' => 'Orders','namespace' => 'App\Controllers\admin']);
// 	$routes->post('/viewOrder_demo1', 'Order::viewOrder',['namespace' => 'App\Controllers\admin']);
// 	$routes->post('/updateStatus', 'Order::updateStatus',['namespace' => 'App\Controllers\admin']);
// });

// $routes->get('/automplete', 'Sales::automplete');
// $routes->get('/logout', 'Auth::logout');
//
// $routes->post('/handleLogin', 'Auth::handleLogin');
// $routes->post('/handleLogin', 'Auth::handleLogin');
//
// $routes->post('/createItem', 'Admin::create');
// $routes->post('/viewItem', 'Admin::view');
// $routes->post('/getItem', 'Admin::getSpecific');
// $routes->post('/addStock', 'Admin::addStock');
// $routes->post('/getSpecificItem', 'Admin::getSpecificItem');
// $routes->post('/update', 'Admin::updateItem');
// $routes->post('/remove', 'Admin::remove');
//
// $routes->post('/getItemSales', 'Sales::getItem');
// $routes->post('/addCart', 'Sales::addCart');
// $routes->post('/viewCart', 'Sales::viewCart');
// $routes->post('/getItemCart', 'Sales::getItemCart');
// $routes->post('/editCart', 'Sales::editCart');
// $routes->post('/removeItemCart', 'Sales::removeItemCart');
// $routes->post('/submitSale', 'Sales::submitSale');
//
// $routes->post('/viewSales', 'SalesData::view');
// $routes->post('/viewSalesItem', 'SalesData::viewItem');
// $routes->post('/viewDailyReport', 'SalesData::viewDailyReport');
// $routes->post('/viewItemCount', 'SalesData::itemNumber');





/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
