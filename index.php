<?php
//apparte include voor smarty omdat die zijn eigen map en dependancies heeft
include_once "library/smarty/libs/Smarty.class.php";

// include alle libraries
foreach (glob("library/*.php") as $filename){
    include_once $filename;
}

// include alle models
foreach (glob("models/*.php") as $filename){
    include_once $filename;
}

// include alle Controllers
foreach (glob("controllers/*.php") as $filename){
    include_once $filename;
}


ini_set('display_errors', 1);
error_reporting(E_ALL - E_NOTICE);

$route = new Route();

/*--------------------------------------*/
/* add all controllers                  */
/*--------------------------------------*/

$route->addController("Index", new Index());
$route->addController("Projecten", new Projecten());
$route->addController("Gebruikers", new Gebruikers());

/*--------------------------------------*/
/* start of routes                      */
/*--------------------------------------*/

$route->addPath("/", "Index", "index");
$route->addPath("/login", "Index", "login");
$route->addPath("/logout", "Index", "logout");

$route->addPath("/project/id/(?'id'[0-9]+)", "Index", "project");

$route->addPath("/admin(/projecten)?", "Projecten", "index");
$route->addPath("/admin/projecten/edit(/id/(?'id'[0-9]*))?", "Projecten", "edit");
$route->addPath("/admin/projecten/delete/id/(?'id'[0-9]+)", "Projecten", "delete");

$route->addPath("/admin/projecten/assets(/id/(?'id'[0-9]*))", "Projecten", "assets");
$route->addPath("/admin/projecten/upload-asset", "Projecten", "upload_asset");
$route->addPath("/admin/projecten/delete-asset", "Projecten", "delete_asset");
$route->addPath("/admin/projecten/reorder-asset", "Projecten", "reorder_assets");


$route->addPath("/admin/gebruikers", "Gebruikers", "index");
$route->addPath("/admin/gebruikers/edit(/id/(?'id'[0-9]*))?", "Gebruikers", "edit");
$route->addPath("/admin/gebruikers/delete/id/(?'id'[0-9]+)", "Gebruikers", "delete");

/*--------------------------------------*/
/* end of routes                        */
/*--------------------------------------*/

$route->submit();