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

// SUPER ADMIN ACCOUNT
Route::group(['middleware' => 'check_if_user_is_super_admin'], function() {
    Route::group(['prefix' => 'super_admin'], function() {
        Route::get('/dashboard', 'UserController@superAdminDashboard')->name('super_admin_dashboard');

        Route::get('/users', 'UserController@superAdminUserIndex')->name('super_admin_user_index');
    });
});


// COLLECTION
Route::group(['middleware' =>['verify_if_user_is_collection']], function(){
    Route::group(['prefix' => 'collection'], function () {

    #DASHBOARD
        Route::get('/dashboard', 'Collection\UserController@collectionDashboard')->name('collection_dashboard');

    #PROPOSALS
        Route::get('/indented_proposals', 'Collection\ProposalController@indexIndentedProposal')->name('index_indented_proposal');
        Route::get('/indented_proposal/{indentedProposal}/collect', 'Collection\ProposalController@forCollection')->name('for_collection');
        Route::post('/indented_proposal/{indentedProposal}/collect', 'Collection\ProposalController@collectIndentedProposal')->name('collect_indented_proposal');
    });
});



// ADMIN ACCOUNT
Route::group(['middleware' => ['verify_if_user_is_admin']], function() {
    Route::group(['prefix' => 'admin'], function() {
        # DASHBOARD
        Route::get('/dashboard', 'Admin\UserController@adminDashboard')->name('admin_dashboard');

        # USERS
        Route::get('/users', 'Admin\UserController@adminUserIndex')->name('admin_user_index');
        Route::get('/create/user/', 'Admin\UserController@adminCreateUser')->name('admin_create_user');
        Route::post('/create/user/', 'Admin\UserController@adminPostUser')->name('post_create_user');
        Route::get('/sales_engineers', 'Admin\UserController@showSalesEngineers')->name('admin_sales_engineer_index');
        Route::get('/sales_engineer/{sales_engineer}', 'Admin\UserController@showSalesEngineer')->name('admin_show_sales_engineer');
        Route::get('/sales_engineer/{sales_engineer}/edit', 'Admin\UserController@adminEditSalesEngineer')->name('admin_edit_sales_engineer_information');

        # ITEMS
        Route::get('/items', 'Admin\ItemController@index')->name('items');
        Route::get('/item/create/group', 'Admin\ItemController@adminCreateGroup')->name('admin_create_group');
        Route::post('/item/create/group', 'Admin\ItemController@adminPostGroup')->name('admin_post_group');

        # AFTERMARKETS
        Route::get('/after_markets', 'Admin\ItemController@afterMarketIndex')->name('after_market_index');
        Route::get('/aftermarket/create', 'Admin\ItemController@createAfterMarket')->name('create_after_market');
        Route::get('/aftermarket/{afterMarket}', 'Admin\ItemController@showAfterMarket')->name('admin_after_market_show');
        Route::get('/aftermarkets', 'Admin\ItemController@indexAftermarket')->name('admin_after_market_index');
        Route::post('/aftermarket/create', 'Admin\ItemController@postAfterMarket')->name('post_after_market');
        Route::get('/aftermarket/{afterMarket}/information', 'Admin\ItemController@adminAfterMarketInformation')->name('admin_after_market_information');
        Route::get('/aftermarket/{afterMarket}/pricing_history', 'Admin\ItemController@adminAfterMarketPricingHistoryIndex')->name('admin_after_market_pricing_history_index');
        Route::get('/after_markets/{afterMarket}/pricing_history/create', 'Admin\ItemController@adminAfterMarketPricingHistoryCreate')->name('admin_after_market_pricing_history_create');
        Route::patch('/aftermarket/{afterMarket}/update', 'Admin\ItemController@adminUpdateAfterMarketInformation')->name('admin_after_market_information_update');
        Route::post('/aftermarket/{afterMarket}/pricing_history/create', 'Admin\ItemController@adminAddAfterMarketPricingHistory')->name('admin_add_after_market_pricing_history');

        # PROJECT
        Route::get('/create/project', 'Admin\ItemController@createProject')->name('create_project');
        Route::get('/projects', 'Admin\ItemController@indexProject')->name('admin_project_index');
        Route::get('/project/{project}', 'Admin\ItemController@showProject')->name('admin_project_show');
        Route::get('/project/{project}/information', 'Admin\ItemController@adminProjectInformation')->name('admin_project_information');
        Route::get('/project/{project}/pricing_history', 'Admin\ItemController@adminProjectPricingHistoryIndex')->name('admin_project_pricing_history_index');
        Route::get('/projects/{project}/pricing_history/create', 'Admin\ItemController@adminProjectPricingHistoryCreate')->name('admin_project_pricing_history_create');
        Route::post('/project/{project}/pricing_history/create', 'Admin\ItemController@postAdminProjectPricingHistory')->name('post_admin_project_pricing_history');
        Route::post('/project/{project}/pricing_history/create', 'Admin\ItemController@adminAddProjectPricingHistory')->name('admin_add_project_pricing_history');
        Route::patch('/project/{project}/update', 'Admin\ItemController@adminUpdateProjectInformation')->name('admin_project_information_update');
        Route::post('/create/project', 'Admin\ItemController@postProject')->name('post_project');
        Route::get('/project/dashboard', 'Admin\ItemController@adminProjectDashboard')->name('admin_project_dashboard');
        Route::get('/project/{project}/aftermarket/create', 'Admin\ItemController@adminCreateAfterMarketOnProject')->name('admin_create_aftermarket_on_project');

        # SEAL
        Route::get('/seal/create/{project}', 'Admin\ItemController@adminSealCreate')->name('admin_seal_create');
        Route::post('/seal/create', 'Admin\ItemController@adminPostSealCreate')->name('admin_post_seal_create');
        Route::get('/seals', 'Admin\ItemController@indexSeal')->name('admin_seal_index');
        Route::get('/seal/{seal}', 'Admin\ItemController@showSeal')->name('admin_seal_show');
        Route::get('/seal/{seal}/information', 'Admin\ItemController@adminSealInformation')->name('admin_seal_information');
        Route::patch('/seal/update', 'Admin\ItemController@adminUpdateSealInformation')->name('admin_seal_information_update');

        # PRICING HISTORY
        Route::get('/pricing_history', 'Admin\ItemController@adminPricingHistoryIndex')->name('admin_pricing_history_index');

        /*
         * JSONS for Items
         */
        Route::get('/get_projects', 'Admin\ItemController@getProjects')->name('fetch_projects');
        Route::get('/item/{category}', 'Admin\ItemController@getItemBasedOnCategory')->name('get_item_based_on_category');

        # CUSTOMERS
        Route::get('/customers', 'Admin\CustomerController@adminCustomerIndex')->name('admin_customer_index');
        Route::get('/create/customer', 'Admin\CustomerController@adminCreateCustomer')->name('admin_customer_create');
        Route::post('/create/customer', 'Admin\CustomerController@adminPostCustomer')->name('post_create_customer');
        Route::get('/customer/{customer}', 'Admin\CustomerController@adminShowCustomerProfile')->name('admin_show_customer');
        Route::get('/customer/{customer}/branch/create', 'Admin\BranchController@adminCreateBranch')->name('admin_create_branch');
        Route::post('/customer/{customer}/branch/create', 'Admin\BranchController@adminPostCreateBranch')->name('admin_post_create_branch');
        Route::get('/customer/{customer}/edit', 'Admin\CustomerController@adminEditCustomerInformation')->name('admin_edit_customer_information');
        Route::get('/customer/{customer}/branches', 'Admin\CustomerController@adminCustomerBranchList')->name('admin_customer_branch_list');
        Route::patch('/customer/{customer}/edit', 'Admin\CustomerController@adminPostEditCustomerInformation')->name('admin_post_edit_customer_information');
        Route::get('fetch_customers', 'Admin\CustomerController@adminFetchCustomers');
        Route::post('save_customer', 'Admin\CustomerController@adminSaveCustomer')->name('admin_save_customer');

        # BRANCHES
        Route::get('/branches', 'Admin\BranchController@adminBranchIndex')->name('admin_branch_index');
        Route::get('/branch/{branch}/edit', 'Admin\BranchController@adminBranchEdit')->name('admin_branch_edit');
        Route::get('/branch/{branch}', 'Admin\BranchController@adminBranchShow')->name('admin_branch_show');

        # PROPOSALS
        Route::get('/indented_proposal', 'Admin\ProposalController@adminIndentedProposalIndex')->name('admin_indented_proposal_index');
        Route::get('/indented_proposal/{indented_proposal}', 'Admin\ProposalController@adminShowPendingProposal')->name('admin_show_pending_proposal');
        Route::patch('/indented_proposal/{indented_proposal}/accept', 'Admin\ProposalController@adminAcceptProposal')->name('admin_accept_indented_proposal');

        Route::get('/buy_and_sell_proposals', 'Admin\ProposalController@adminBuyAndSellProposalIndex')->name('admin_buy_and_sell_proposal_index');
        Route::post('/buy_and_sell_proposal/create', 'Admin\ProposalController@adminPostCreateBuyAndSellProposal');
        Route::get('/buy_and_sell_proposal/{buyAndSellProposal}', 'Admin\ProposalController@adminBuyAndSellProposalView');
        Route::post('/buy_and_sell_proposal/submit', 'Admin\ProposalController@adminSubmitBuyAndSellProposal')->name('admin_submit_buy_and_sell_proposal');
        Route::get('/buy_and_sell_proposal/{buy_and_sell_proposal}', 'Admin\ProposalController@adminShowPendingBuyAndSellProposal')->name('admin_show_pending_buy_and_sell_proposal');
    });
});

// SALES ENGINEER ACCOUNT
Route::group(['middleware' => ['verify_if_user_is_sales_engineer']], function() {
    Route::group(['prefix' => 'sales_engineer'], function() {
        # DASHBOARD
            Route::get('/dashboard', 'SalesEngineer\UserController@dashboard')->name('se_dashboard');

        # AFTERMARKETS
            Route::get('/after_markets', 'SalesEngineer\ItemController@indexAftermarket')->name('aftermarket_index');
            Route::get('/aftermarket/{afterMarket}', 'SalesEngineer\ItemController@showAftermarket')->name('se_aftermarket_show');
            Route::get('/aftermarkets', 'SalesEngineer\ItemController@indexAftermarket')->name('se_after_market_index');
            Route::get('/aftermarket/{afterMarket}/information', 'SalesEngineer\ItemController@adminAfterMarketInformation')->name('se_after_market_information');
            Route::get('/aftermarket/{afterMarket}/pricing_history', 'SalesEngineer\ItemController@afterMarketPricingHistoryIndex')->name('se_aftermarket_pricing_history_index');

        # PROJECT
            Route::get('/projects', 'SalesEngineer\ItemController@salesEngineerProjectIndex')->name('se_project_index');
            Route::get('/project/{project}', 'SalesEngineer\ItemController@salesEngineerProjectShow')->name('se_project_show');
            Route::get('/project/{project}/information', 'SalesEngineer\ItemController@adminProjectInformation')->name('se_project_information');
            Route::get('/project/{project}/pricing_history', 'SalesEngineer\ItemController@salesEngineerProjectPricingHistoryIndex')->name('se_project_pricing_history_index');
            Route::get('/project/dashboard', 'SalesEngineer\ItemController@adminProjectDashboard')->name('se_project_dashboard');


        # PRICING HISTORY
            Route::get('/pricing_history', 'SalesEngineer\ItemController@adminPricingHistoryIndex')->name('admin_pricing_history_index');

                Route::get('/get_projects', 'SalesEngineer\ItemController@getProjects')->name('fetch_projects');
                Route::get('/item/{category}', 'SalesEngineer\ItemController@getItemBasedOnCategory')->name('get_item_based_on_category');

        # CUSTOMERS
            Route::get('/customers', 'SalesEngineer\CustomerController@index')->name('customer_index');
            Route::get('/customer/{customer}', 'SalesEngineer\CustomerController@show')->name('show_customer');
            Route::get('/customer/{customer}/branches', 'SalesEngineer\CustomerController@customerBranchList')->name('customer_branch_list');
            Route::get('/fetch_branches/{customer_id}/', 'SalesEngineer\CustomerController@fetchBranchesById');

        # BRANCHES
            Route::get('/branches', 'SalesEngineer\BranchController@adminBranchIndex')->name('se_branch_index');
            Route::get('/branch/{branch}', 'SalesEngineer\BranchController@adminBranchShow')->name('se_branch_show');

        # PROPOSALS
            Route::post('/proposal/create', 'SalesEngineer\ProposalController@adminCreateProposal')->name('se_create_proposal');
            Route::post('/indented_proposal/create', 'SalesEngineer\ProposalController@salesEngineerPostCreateIndentedProposal');
            Route::get('/indented_proposal/{indentedProposal}', 'SalesEngineer\ProposalController@salesEngineerIndentProposalView');
            Route::post('/indented_proposal/submit', 'SalesEngineer\ProposalController@salesEngineerSubmitIndentedProposal')->name('se_submit_indented_proposal');
            Route::post('/buy_and_sell_proposal/create', 'SalesEngineer\ProposalController@salesEngineerPostCreateBuyAndSellProposal');
            Route::get('/buy_and_sell_proposal/{buyAndSellProposal}', 'SalesEngineer\ProposalController@salesEngineerBuyAndSellProposalView');
            Route::post('/buy_and_sell/create', 'SalesEngineer\ProposalController@salesEngineerPostCreateBuyAndSellProposal')->name('se_create_buy_and_sale_proposal');
            Route::get('/indented_proposals', 'ProposalController@adminIndexIndentedProposal')->name('admin_index_indented_proposal');
            Route::get('/indented_proposal/{indentedProposal}/sent', 'SalesEngineer\ProposalController@showSentIndentedProposal');
            Route::post('/buy_and_sell_proposal/submit', 'SalesEngineer\ProposalController@salesEngineerSubmitBuyAndSellProposal')->name('se_submit_buy_and_sell_proposal');

        # SEARCH
            Route::get('/search', function() { return view('search.sales_engineer.index'); })->name('search');
            Route::get('/fetch_customers', 'SalesEngineer\CustomerController@fetchCustomers')->name('fetch_customers');
    });
});