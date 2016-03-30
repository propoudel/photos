<?php

Route::group(['namespace' => 'Front', 'middleware' => ['web','auth:customers']], function () {
    Route::auth();
    Route::get('/account/dashboard', ['as' => 'customer.dashboard', 'uses' => 'CustomerController@dashboard']);
    Route::get('/checkout/delivery', ['as' => 'basket.delivery', 'uses' => 'BasketController@delivery']);
    Route::get('/account/logout', ['as' => 'customer.logout', 'uses' => 'CustomerController@getLogout']);

});


Route::group(['namespace' => 'Front', 'middleware' => ['web']], function () {
    #Pages
    Route::get('/', ['as' => 'home', 'uses' => 'PageController@index']);
    Route::get('/category/{slug?}', ['as' => 'category.item', 'uses' => 'PageController@category']);
    Route::get('/item/{id?}', ['as' => 'show.item', 'uses' => 'PageController@item']);
    Route::get('/search/', ['as' => 'page.search', 'uses' => 'PageController@search']);

    #Customer
    Route::get('/account/register', ['as' => 'customer.register', 'uses' => 'CustomerController@getRegister']);
    Route::get('/account/login', ['as' => 'customer.login', 'uses' => 'CustomerController@getLogin']);
    Route::post('/account/login', ['as' => 'customer.login.post', 'uses' => 'CustomerController@postLogin']);
    Route::post('/account/register', ['as' => 'customer.register.post', 'uses' => 'CustomerController@postRegister']);



    #Basket
    Route::post('/basket/add', ['as' => 'basket.add', 'uses' => 'BasketController@add']);
    Route::post('/basket/update', ['as' => 'basket.update', 'uses' => 'BasketController@update']);
    Route::get('/basket/remove/{rowid?}', ['as' => 'basket.remove', 'uses' => 'BasketController@remove']);
    Route::get('/checkout/basket', ['as' => 'basket.basket', 'uses' => 'BasketController@basket']);
    Route::post('/checkout/delivery/save', ['as' => 'basket.delivery.save', 'uses' => 'BasketController@deliverySave']);
    Route::get('/checkout/payment', ['as' => 'basket.payment', 'uses' => 'BasketController@payment']);
    Route::post('/checkout/payment/save', ['as' => 'basket.payment.save', 'uses' => 'BasketController@paymentSave']);
    Route::get('/checkout/payment/save', ['as' => 'basket.payment.save', 'uses' => 'BasketController@paymentSave']);
    Route::get('/checkout/success', ['as' => 'basket.success', 'uses' => 'BasketController@success']);
    Route::get('/checkout/notification', ['as' => 'basket.notification', 'uses' => 'BasketController@notification']);






    Route::get('{provider}/authorize', function ($provider) {
        return SocialAuth::authorize($provider);
    });

    Route::get('{provider}/login', function ($provider) {
        try {
            SocialAuth::login($provider, function ($user, $userDetails) {
                $user->email = $userDetails->email;
                $user->name = $userDetails->full_name;
                $user->save();
                Auth::login($user);

            });

        } catch (ApplicationRejectedException $e) {
            dump($e);

        } catch (InvalidAuthorizationCodeException $e) {
            dump($e);
        }
        //return Redirect::intended();
        return redirect('account/dashboard');
    });


});





Route::group(['middleware' => ['web']], function () {
    Route::group(['namespace' => 'Control', 'prefix' => 'admin'], function () {
        Route::get('/', 'AdminController@login');
        Route::post('/', 'AdminController@postLogin');
        Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'AdminController@logout']);
    });
});


Route::group(['middleware' => ['web', 'auth']], function () {

    Route::auth();

    Route::group(['namespace' => 'Control', 'prefix' => 'admin'], function () {

        #Dashboard
        Route::get('/dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);

        #Account
        Route::get('/account/{id}/update', ['as' => 'admin.account', 'uses' => 'AdminController@account']);
        Route::post('/account/{id}/update', ['as' => 'admin.account', 'uses' => 'AdminController@accountUpdate']);

        #Setting
        Route::get('/setting', 'SettingController@index');

        #Category
        Route::get('/category', ['as' => 'admin.category', 'uses' => 'CategoryController@index']);
        Route::get('/category/add', ['as' => 'admin.category.add', 'uses' => 'CategoryController@add']);
        Route::post('/category/store', ['as' => 'admin.category.store', 'uses' => 'CategoryController@store']);
        Route::get('/category/{id}/edit', ['as' => 'admin.category.edit', 'uses' => 'CategoryController@edit']);
        Route::get('/category/{id}/delete', ['as' => 'admin.category.delete', 'uses' => 'CategoryController@delete']);
        Route::post('/category/{id}/update', ['as' => 'admin.category.update', 'uses' => 'CategoryController@update']);

        #Item
        Route::get('/item', ['as' => 'admin.item', 'uses' => 'ItemController@index']);
        Route::get('/item/add', ['as' => 'admin.item.add', 'uses' => 'ItemController@add']);
        Route::post('/item/store', ['as' => 'admin.item.store', 'uses' => 'ItemController@store']);
        Route::get('/item/{id}/edit', ['as' => 'admin.item.edit', 'uses' => 'ItemController@edit']);
        Route::get('/item/{id}/delete', ['as' => 'admin.item.delete', 'uses' => 'ItemController@delete']);
        Route::post('/item/{id}/update', ['as' => 'admin.item.update', 'uses' => 'ItemController@update']);


        #Banner
        Route::get('/banner', ['as' => 'admin.banner', 'uses' => 'BannerController@index']);
        Route::get('/banner/add', ['as' => 'admin.banner.add', 'uses' => 'BannerController@add']);
        Route::post('/banner/store', ['as' => 'admin.banner.store', 'uses' => 'BannerController@store']);
        Route::get('/banner/{id}/edit', ['as' => 'admin.banner.edit', 'uses' => 'BannerController@edit']);
        Route::get('/banner/{id}/delete', ['as' => 'admin.banner.delete', 'uses' => 'BannerController@delete']);
        Route::post('/banner/{id}/update', ['as' => 'admin.banner.update', 'uses' => 'BannerController@update']);
    });


});




