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

Route::get('/logout', [
    'uses' => '\App\Http\Controllers\Auth\LoginController@logout'
]);

	Route::get('/',[
		'as'=> 'home',
		'uses'=> '\App\Http\Controllers\Dashboard\DashboardController@index',
	])->middleware('auth');


  //Route::get('/', [App\Http\Controllers\FreearticlesController::class, 'home'])->name('home');

  /*
  | Stripe Subscription Routes
  */
	Route::get('/subscription',[
		'as'=> '/subscription',
		'uses'=> '\App\Http\Controllers\SubscriptionController@index',
	]);

	Route::get('/subscription/subscribe',[
		'as'=> '/subscription/subscribe',
		'uses'=> '\App\Http\Controllers\SubscriptionController@notSubscribed',
	]);

	Route::get('/subscription/stripe/{plan_id}',[
		'as'=> '/subscription/stripe',
		'uses'=> '\App\Http\Controllers\SubscriptionController@stripeCheckout',
	]);

	Route::post('/subscription/stripe/subscribe',[
		'as'=> '/subscription/stripe/subscribe',
		'uses'=> '\App\Http\Controllers\SubscriptionController@stripeSubscribe',
	]);

  Route::get('/subscription-invoice/{invoiceId}',[
    'uses' => '\App\Http\Controllers\SubscriptionController@stripeInvoice',
  ]);

  Route::get('/subscription-cancel/{subscriptionId}',[
    'uses' => '\App\Http\Controllers\SubscriptionController@cancelSubscription',
  ]);
	/*
	| Stripe Subscription Routes
	*/

  /*
  | Premium Content Routes
  */
  Route::resource('/premium-content', '\App\Http\Controllers\PremiumContent\PremiumContentController')
  ->middleware('premium');
  /*
  | Premium Content Routes
  */

	/*
	|  Activitylog Route
	*/
	Route::resource('activity-log', '\App\Http\Controllers\Activitylog\ActivitylogController');
  /*
  |  Activitylog Route
  */


	/*
	| Profile Routes
	*/

  Route::resource('profile', '\App\Http\Controllers\Profile\ProfileController');

	Route::get('update-avatar/{id}',[
		'as' => 'update-avatar',
		'uses'=> '\App\Http\Controllers\Profile\ProfileController@showAvatar'
	]);

	Route::post('update-avatar/{id}', '\App\Http\Controllers\Profile\ProfileController@updateAvatar');

	Route::post('update-profile-login/{id}',[
		'uses'=> '\App\Http\Controllers\Profile\ProfileController@updateLogin',
		'as' => 'update-login',
	]);

/*
| Profile Routes
*/

// Socialite Authentication Route
//{provider}', '\App\Http\Controllers\Auth\LoginController@redirectToProvider');
//Route::get('login/{provider}/callback', '\App\Http\Controllers\Auth\LoginController@handleProviderCallback');

#####################################ADMIN MANAGED SECTION##########################################
// Users Route
	Route::resource('user', '\App\Http\Controllers\UserController');
	Route::post('update-user-login/{id}',[
    'as' => 'user-login',
	'uses'=> '\App\Http\Controllers\UserController@userLogin']);
	Route::get('user/{id}/activity-log/',[
    'as' => 'user-activitlog',
	'uses'=> '\App\Http\Controllers\UserController@userActivityLog']);
  // Users Route


// Roles Route
	Route::resource('role', '\App\Http\Controllers\Role\RoleController');
	Route::post('/role-permission/{id}',[
		'as' => 'roles_permit',
		'uses' => '\App\Http\Controllers\Role\RoleController@assignPermission',
	]);
// Roles Route


// Permission Route
	Route::resource('permission', '\App\Http\Controllers\Permission\PermissionController');
  // Permission Route


// Payment Gateway Route
          Route::get('/subscription/plan',[
              'as' => '/subscription/plan',
              'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@viewStripePlans',
          ]);

          Route::get('/subscription/plan/create',[
              'as' => '/subscription/plan/create',
              'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@createStripePlan',
          ]);

          Route::post('/subscription/plan/create',[
              'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@storeStripePlan',
          ]);

          Route::get('/stripe/plan/edit/{plan_id}',[
              'as' => '/stripe/plan/edit',
              'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@editStripePlan',
          ]);

          Route::post('/stripe/plan/edit/{id}/{plan_id}',[
              'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@updateStripePlan',
          ]);

          Route::post('/stripe/plan/delete/{id}',[
            'as' => '/stripe/plan/delete',
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@deleteStripePlan',
          ]);

          Route::get('/subscribed-users',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@manageSubscribedUser',
          ]);

          Route::get('/user-subscription-invoice/{invoiceId}',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@subscriptionInvoice',
          ]);

          Route::get('/user-subscription-cancel/{subscription_id}',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@cancelSub',
          ]);

          Route::get('/subscription-income',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@manageIncome',
          ]);

          Route::get('/checkout-sample',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@checkoutSamples',
          ]);

          Route::get('/checkout-sample/article',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@download',
          ]);

          Route::get('/checkout-sample/response/{session_id}',[
            'uses' => '\App\Http\Controllers\PaymentGateway\PaymentGatewayController@responseCheckout',
            'as' => '/checkout-sample/response'
          ]);

// Payment Gateway Route

      	Route::resource('settings','\App\Http\Controllers\Settings\SettingsController');

      	Route::post('settings/app-name/update',[
      		'as' => 'settings/app-name/update',
      		'uses' => '\App\Http\Controllers\Settings\SettingsController@appNameUpdate',
      	]);
      	Route::post('settings/app-logo/update',[
      		'as' => 'settings/app-logo/update',
      		'uses' => '\App\Http\Controllers\Settings\SettingsController@appLogoUpdate',
      	]);

      	Route::post('settings/app-theme/update',[
      		'as' => 'settings/app-theme/update',
      		'uses' => '\App\Http\Controllers\Settings\SettingsController@appThemeUpdate',
      	]);

      	Route::post('settings/stripe-payment/update',[
      		'as' => 'settings/stripe-payment/update',
      		'uses' => '\App\Http\Controllers\Settings\SettingsController@stripePaymentUpdate',
      	]);

        Route::post('settings/auth-settings/update',[
      		'as' => 'settings/auth-settings/update',
      		'uses' => '\App\Http\Controllers\Settings\SettingsController@authSettingsUpdate',
      	]);

        // Premium Content
        Route::resource('/article', '\App\Http\Controllers\Article\ArticleController');
        Route::post('/article-image', '\App\Http\Controllers\Article\ArticleController@articleImageUpload');
        Route::resource('/category-article', '\App\Http\Controllers\Article\ArticleCategoryController');

#####################################WEBHOOK ROUTE##########################################
Route::stripeWebhooks('stripe-webhook');
#####################################WEBHOOK ROUTE##########################################

Route::impersonate();
Auth::routes(['verify' => true]);


Route::resource('freearticles', App\Http\Controllers\FreearticlesController::class);