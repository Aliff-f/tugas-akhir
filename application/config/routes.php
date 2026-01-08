<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Indonesian Routes
$route['tentang'] = 'about';
$route['keranjang'] = 'cart';
$route['keranjang/add/(:any)'] = 'cart/add/$1';
$route['keranjang/delete/(:any)'] = 'cart/delete/$1';
$route['keranjang/(:any)'] = 'cart/$1';
$route['kasir'] = 'checkout';
$route['kasir/(:any)'] = 'checkout/$1';
$route['kontak'] = 'contact';
$route['masuk'] = 'login';
$route['masuk/(:any)'] = 'login/$1';
$route['pembayaran'] = 'payment';
$route['pembayaran/(:any)'] = 'payment/$1';
$route['produk'] = 'products';
$route['produk/(:any)'] = 'products/$1';
$route['detail_produk/(:num)'] = 'product_detail/index/$1';
$route['produk/filter/(:any)/(:num)'] = 'products/index/$1/$2';
$route['daftar'] = 'register';
$route['daftar/(:any)'] = 'register/$1';
$route['berlangganan'] = 'subscribe';
$route['berlangganan/(:any)'] = 'subscribe/$1';
$route['akun'] = 'user';
$route['akun/(:any)'] = 'user/$1';

// Keep English routes working (optional, or remove if strict replacement is needed) 
// but user said "ubah", assuming we want the links to be Indonesian, 
// the controllers are still the same. 
// We are mapping Indonesian URI -> English Controller.

$route['product_detail/(:num)'] = 'product_detail/index/$1';
$route['products/filter/(:any)/(:num)'] = 'products/index/$1/$2';

