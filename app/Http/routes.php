<?php


Route::get('/', function () {
    if(Auth::guard()->guest()) {
        return redirect()->to('login');
    } else {
        return redirect()->to(Auth::user()->role . '/dashboard');
    }
});

Route::auth();

Route::get('/home', 'HomeController@index')->name('home');

// Super Admin Account

Route::group(['middleware' => 'check_if_user_is_super_admin'], function() {
    Route::group(['prefix' => 'super_admin'], function() {
        Route::get('/dashboard', 'UserController@superAdminDashboard')->name('super_admin_dashboard');

        Route::get('/users', 'UserController@superAdminUserIndex')->name('super_admin_user_index');
    });
});

// Admin Account
Route::group(['middleware' => ['verify_if_user_is_admin']], function() {
    Route::group(['prefix' => 'admin'], function() {
        # DASHBOARD
            Route::get('/dashboard', 'UserController@adminDashboard')->name('admin_dashboard');

        # USERS
            Route::get('/users', 'UserController@adminUserIndex')->name('admin_user_index');
            Route::get('/create/user/', 'UserController@adminCreateUser')->name('admin_create_user');
            Route::post('/create/user/', 'UserController@adminPostUser')->name('post_create_user');
            Route::get('/sales_engineers', 'UserController@showSalesEngineers')->name('admin_sales_engineer_index');

        # ITEMS
            Route::get('/items', 'ItemController@index')->name('items');
            Route::get('/item/create/group', 'ItemController@adminCreateGroup')->name('admin_create_group');
            Route::post('/item/create/group', 'ItemController@adminPostGroup')->name('admin_post_group');

        # AFTERMARKETS
            Route::get('/after_markets', 'ItemController@afterMarketIndex')->name('after_market_index');
            Route::get('/aftermarket/create', 'ItemController@createAfterMarket')->name('create_after_market');
            Route::get('/aftermarket/{afterMarket}', 'ItemController@showAfterMarket')->name('admin_after_market_show');
            Route::get('/aftermarkets', 'ItemController@indexAftermarket')->name('admin_after_market_index');
            Route::post('/aftermarket/create', 'ItemController@postAfterMarket')->name('post_after_market');
            Route::get('/aftermarket/{afterMarket}/information', 'ItemController@adminAfterMarketInformation')->name('admin_after_market_information');
            Route::get('/aftermarket/{afterMarket}/pricing_history', 'ItemController@adminAfterMarketPricingHistoryIndex')->name('admin_after_market_pricing_history_index');
            Route::get('/after_markets/{afterMarket}/pricing_history/create', 'ItemController@adminAfterMarketPricingHistoryCreate')->name('admin_after_market_pricing_history_create');
            Route::patch('/aftermarket/{afterMarket}/update', 'ItemController@adminUpdateAfterMarketInformation')->name('admin_after_market_information_update');
            Route::post('/aftermarket/{afterMarket}/pricing_history/create', 'ItemController@adminAddAfterMarketPricingHistory')->name('admin_add_after_market_pricing_history');

        # PROJECT
            Route::get('/create/project', 'ItemController@createProject')->name('create_project');
            Route::get('/projects', 'ItemController@indexProject')->name('admin_project_index');
            Route::get('/project/{project}', 'ItemController@showProject')->name('admin_project_show');
            Route::get('/project/{project}/information', 'ItemController@adminProjectInformation')->name('admin_project_information');
            Route::get('/project/{project}/pricing_history', 'ItemController@adminProjectPricingHistoryIndex')->name('admin_project_pricing_history_index');
            Route::get('/projects/{project}/pricing_history/create', 'ItemController@adminProjectPricingHistoryCreate')->name('admin_project_pricing_history_create');
            Route::post('/project/{project}/pricing_history/create', 'ItemController@postAdminProjectPricingHistory')->name('post_admin_project_pricing_history');
            Route::post('/project/{project}/pricing_history/create', 'ItemController@adminAddProjectPricingHistory')->name('admin_add_project_pricing_history');
            Route::patch('/project/{project}/update', 'ItemController@adminUpdateProjectInformation')->name('admin_project_information_update');
            Route::post('/create/project', 'ItemController@postProject')->name('post_project');
            Route::get('/project/dashboard', 'ItemController@adminProjectDashboard')->name('admin_project_dashboard');

        # PRICING HISTORY
            Route::get('/pricing_history', 'ItemController@adminPricingHistoryIndex')->name('admin_pricing_history_index');

            /*
             * JSONS for Items
             */
                Route::get('/get_projects', 'ItemController@getProjects')->name('fetch_projects');
                Route::get('/item/{category}', 'ItemController@getItemBasedOnCategory')->name('get_item_based_on_category');

        # CUSTOMERS
            Route::get('/customers', 'CustomerController@adminCustomerIndex')->name('admin_customer_index');
            Route::get('/create/customer', 'CustomerController@adminCreateCustomer')->name('admin_customer_create');
            Route::post('/create/customer', 'CustomerController@adminPostCustomer')->name('post_create_customer');
            Route::get('/customer/{customer}', 'CustomerController@adminShowCustomerProfile')->name('admin_show_customer');
            Route::get('/customer/{customer}/branch/create', 'BranchController@adminCreateBranch')->name('admin_create_branch');
            Route::post('/customer/{customer}/branch/create', 'BranchController@adminPostCreateBranch')->name('admin_post_create_branch');
            Route::get('/customer/{customer}/edit', 'CustomerController@adminEditCustomerInformation')->name('admin_edit_customer_information');
            Route::get('/customer/{customer}/branches', 'CustomerController@adminCustomerBranchList')->name('admin_customer_branch_list');
            Route::patch('/customer/{customer}/edit', 'CustomerController@adminPostEditCustomerInformation')->name('admin_post_edit_customer_information');

        # BRANCHES
            Route::get('/branches', 'BranchController@adminBranchIndex')->name('admin_branch_index');

        # PROPOSALS
            Route::post('/proposal/create', 'ProposalController@adminCreateProposal')->name('admin_create_proposal');
            Route::post('/indented_proposal/create', 'ProposalController@adminPostCreateIndentedProposal')->name('admin_post_indented_proposal');
            Route::get('/indented_proposal/{indentedProposal}', 'ProposalController@adminIndentProposalView')->name('admin_indented_proposal');
            Route::post('/indented_proposal/submit', 'ProposalController@adminSubmitIndentedProposal')->name('admin_submit_indented_proposal');

        # SEARCH
            Route::get('/search', function() { return view('search.admin.index'); })->name('search');
    });
});
