<?php

use App\Http\Controllers\LanguageController;
use App\Permission;
use App\Role;

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

Auth::routes(['verify' => true]);

Route::resource('users', 'userController');
route::get('test',function (){
    $admin_permissions = Permission::all();
    Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
    $user_permissions = $admin_permissions->filter(function ($permission) {
        return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
    });
});

// Dashboard Route
Route::get('/', 'DashboardController@dashboardModern');
Route::get('/modern', 'DashboardController@dashboardModern');
Route::get('/ecommerce', 'DashboardController@dashboardEcommerce');
Route::get('/analytics', 'DashboardController@dashboardAnalytics');

// Application Route
Route::get('/app-email', 'ApplicationController@emailApp');
Route::get('/app-email/content', 'ApplicationController@emailContentApp');
Route::get('/app-chat', 'ApplicationController@chatApp');
Route::get('/app-todo', 'ApplicationController@todoApp');
Route::get('/app-kanban', 'ApplicationController@kanbanApp');
Route::get('/app-file-manager', 'ApplicationController@fileManagerApp');
Route::get('/app-contacts', 'ApplicationController@contactApp');
Route::get('/app-calendar', 'ApplicationController@calendarApp');
Route::get('/app-invoice-list', 'ApplicationController@invoiceList');
Route::get('/app-invoice-view', 'ApplicationController@invoiceView');
Route::get('/app-invoice-edit', 'ApplicationController@invoiceEdit');
Route::get('/app-invoice-add', 'ApplicationController@invoiceAdd');
Route::get('/eCommerce-products-page', 'ApplicationController@ecommerceProduct');
Route::get('/eCommerce-pricing', 'ApplicationController@eCommercePricing');

// User profile Route
Route::get('/user-profile-page', 'UserProfileController@userProfile');

// Page Route
Route::get('/page-contact', 'PageController@contactPage');
Route::get('/page-blog-list', 'PageController@pageBlogList');
Route::get('/page-search', 'PageController@searchPage');
Route::get('/page-knowledge', 'PageController@knowledgePage');
Route::get('/page-knowledge/licensing', 'PageController@knowledgeLicensingPage');
Route::get('/page-knowledge/licensing/detail', 'PageController@knowledgeLicensingPageDetails');
Route::get('/page-timeline', 'PageController@timelinePage');
Route::get('/page-faq', 'PageController@faqPage');
Route::get('/page-faq-detail', 'PageController@faqDetailsPage');
Route::get('/page-account-settings', 'PageController@accountSetting');
Route::get('/page-blank', 'PageController@blankPage');
Route::get('/page-collapse', 'PageController@collapsePage');

// Media Route
Route::get('/media-gallery-page', 'MediaController@mediaGallery');
Route::get('/media-hover-effects', 'MediaController@hoverEffect');

// User Route
Route::get('/page-users-list', 'UserController@usersList');
Route::get('/page-users-view', 'UserController@usersView');
Route::get('/page-users-edit', 'UserController@usersEdit');

// Authentication Route
Route::get('/user-login', 'AuthenticationController@userLogin');
Route::get('/user-register', 'AuthenticationController@userRegister');
Route::get('/user-forgot-password', 'AuthenticationController@forgotPassword');
Route::get('/user-lock-screen', 'AuthenticationController@lockScreen');

// Misc Route
Route::get('/page-404', 'MiscController@page404');
Route::get('/page-maintenance', 'MiscController@maintenancePage');
Route::get('/page-500', 'MiscController@page500');

// Card Route
Route::get('/cards-basic', 'CardController@cardBasic');
Route::get('/cards-advance', 'CardController@cardAdvance');
Route::get('/cards-extended', 'CardController@cardsExtended');

// Css Route
Route::get('/css-typography', 'CssController@typographyCss');
Route::get('/css-color', 'CssController@colorCss');
Route::get('/css-grid', 'CssController@gridCss');
Route::get('/css-helpers', 'CssController@helpersCss');
Route::get('/css-media', 'CssController@mediaCss');
Route::get('/css-pulse', 'CssController@pulseCss');
Route::get('/css-sass', 'CssController@sassCss');
Route::get('/css-shadow', 'CssController@shadowCss');
Route::get('/css-animations', 'CssController@animationCss');
Route::get('/css-transitions', 'CssController@transitionCss');

// Basic Ui Route
Route::get('/ui-basic-buttons', 'BasicUiController@basicButtons');
Route::get('/ui-extended-buttons', 'BasicUiController@extendedButtons');
Route::get('/ui-icons', 'BasicUiController@iconsUI');
Route::get('/ui-alerts', 'BasicUiController@alertsUI');
Route::get('/ui-badges', 'BasicUiController@badgesUI');
Route::get('/ui-breadcrumbs', 'BasicUiController@breadcrumbsUI');
Route::get('/ui-chips', 'BasicUiController@chipsUI');
Route::get('/ui-chips', 'BasicUiController@chipsUI');
Route::get('/ui-collections', 'BasicUiController@collectionsUI');
Route::get('/ui-navbar', 'BasicUiController@navbarUI');
Route::get('/ui-pagination', 'BasicUiController@paginationUI');
Route::get('/ui-preloader', 'BasicUiController@preloaderUI');

// Advance UI Route
Route::get('/advance-ui-carousel', 'AdvanceUiController@carouselUI');
Route::get('/advance-ui-collapsibles', 'AdvanceUiController@collapsibleUI');
Route::get('/advance-ui-toasts', 'AdvanceUiController@toastUI');
Route::get('/advance-ui-tooltip', 'AdvanceUiController@tooltipUI');
Route::get('/advance-ui-dropdown', 'AdvanceUiController@dropdownUI');
Route::get('/advance-ui-feature-discovery', 'AdvanceUiController@discoveryFeature');
Route::get('/advance-ui-media', 'AdvanceUiController@mediaUI');
Route::get('/advance-ui-modals', 'AdvanceUiController@modalUI');
Route::get('/advance-ui-scrollspy', 'AdvanceUiController@scrollspyUI');
Route::get('/advance-ui-tabs', 'AdvanceUiController@tabsUI');
Route::get('/advance-ui-waves', 'AdvanceUiController@wavesUI');
Route::get('/fullscreen-slider-demo', 'AdvanceUiController@fullscreenSlider');

// Extra components Route
Route::get('/extra-components-range-slider', 'ExtraComponentsController@rangeSlider');
Route::get('/extra-components-sweetalert', 'ExtraComponentsController@sweetAlert');
Route::get('/extra-components-nestable', 'ExtraComponentsController@nestAble');
Route::get('/extra-components-treeview', 'ExtraComponentsController@treeView');
Route::get('/extra-components-ratings', 'ExtraComponentsController@ratings');
Route::get('/extra-components-tour', 'ExtraComponentsController@tour');
Route::get('/extra-components-i18n', 'ExtraComponentsController@i18n');
Route::get('/extra-components-highlight', 'ExtraComponentsController@highlight');

// Basic Tables Route
Route::get('/table-basic', 'BasicTableController@tableBasic');

// Data Table Route
Route::get('/table-data-table', 'DataTableController@dataTable');

// Form Route
Route::get('/form-elements', 'FormController@formElement');
Route::get('/form-select2', 'FormController@formSelect2');
Route::get('/form-validation', 'FormController@formValidation');
Route::get('/form-masks', 'FormController@masksForm');
Route::get('/form-editor', 'FormController@formEditor');
Route::get('/form-file-uploads', 'FormController@fileUploads');
Route::get('/form-layouts', 'FormController@formLayouts');
Route::get('/form-wizard', 'FormController@formWizard');

// Charts Route
Route::get('/charts-chartjs', 'ChartController@chartJs');
Route::get('/charts-chartist', 'ChartController@chartist');
Route::get('/charts-sparklines', 'ChartController@sparklines');


// locale route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);


Route::group([ 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    Route::post('updateRolePermissions','roleController@update');
    Route::post('updateRoleUsers','userController@update');
    // Roles
    Route::delete('roles/destroy', 'roleController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'roleController');

    // Users
    Route::delete('users/destroy', 'userController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'userController');

    // Categories
    Route::delete('categories/destroy', 'CategoriesController@massDestroy')->name('categories.massDestroy');
    Route::resource('categories', 'CategoriesController');
});
