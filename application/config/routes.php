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
$route['default_controller'] = 'BerandaController/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['beranda'] = 'BerandaController/index';
$route['galeri'] = 'BerandaController/galeri';
$route['faq'] = 'BerandaController/faq';

$route['pertunjukan'] = 'PertunjukanController/index';
$route['index'] = 'BerandaController/index';

//profil
$route['profil/(:any)'] = 'ProfilController/profil/$1';
$route['riwayat/(:any)'] = 'ProfilController/riwayat/$1';
$route['ubahprofil/(:any)'] = 'ProfilController/ubahprofil/$1';
$route['editProfil'] = 'ProfilController/actUbahProfil';
$route['gantipassword/(:any)'] = 'ProfilController/gantipassword/$1';
$route['editPassword'] = 'ProfilController/actGantiPassword';

//register
$route['register'] = 'AkunController/register';
$route['user/daftarAkun'] = 'UserController/daftarAkun';

$route['user/loginAkun/(:any)/(:any)'] = 'UserController/loginAkun/$1/$2';
$route['logout'] = 'UserController/logout';
$route['user/getCustomerById/(:any)'] = 'UserController/getCustomerById/$1';

$route['pilih_kursi'] = 'PertunjukanController/pilih_kursi';

$route['api/getPenggunaBayar/(:any)'] = 'UserController/getPenggunaBayar/$1';
$route['api/getPenggunaBayar2/(:any)'] = 'UserController/getPenggunaBayar2/$1';

$route['api/bayarTagihan'] = 'MidtransController/bayarTagihanMidtrans';

$route['api/updateKursi'] = 'PembelianController/updateKursi';
$route['api/updateKursi2'] = 'PembelianController/updateKursi2';

$route['api/simpanPembayaran'] = 'MidtransController/simpanPembayaranMidtrans';
$route['detail_transaksi/(:any)'] = 'ProfilController/detailTransaksi/$1';

$route['api/notifikasiPembayaran'] = 'MidtransController/notifikasiPembayaran';
$route['api/getStatusPembayaran'] = 'MidtransController/getStatusPembayaran';

$route['admin'] = 'AdminController/admin';
