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

Route::group(['middlewareGroups' => ['web']], function() {
   Route::get('patches', function() {
      return view('auth.patches');
   })->name('patch_notes');

   set_time_limit(0);

   Route::get('export/indented_proposal/{indented_proposal}', function(\App\IndentedProposal $indented_proposal) {
      $excel = Excel::create('Test Files', function($excel) use($indented_proposal) {
         $excel->sheet('WorthRand Inventory PO', function($sheet) use ($indented_proposal, $excel) {
            $ctr = 0;

            $selectedItems = DB::table('indented_proposal_item')
            ->select('projects.*',
            DB::raw('wr_crm_projects.name as "project_name"'),
            DB::raw('wr_crm_projects.model as "project_md"'),
            DB::raw('wr_crm_projects.serial_number as "project_sn"'),
            DB::raw('wr_crm_projects.part_number as "project_pn"'),
            DB::raw('wr_crm_projects.drawing_number as "project_dn"'),
            DB::raw('wr_crm_projects.tag_number as "project_tn"'),
            DB::raw('wr_crm_projects.material_number as "project_mn"'),
            DB::raw('wr_crm_projects.price as "project_price"'),
            'after_markets.*',
            DB::raw('wr_crm_after_markets.name as "after_market_name"'),
            DB::raw('wr_crm_after_markets.model as "after_market_md"'),
            DB::raw('wr_crm_after_markets.part_number as "after_market_pn"'),
            DB::raw('wr_crm_after_markets.drawing_number as "after_market_dn"'),
            DB::raw('wr_crm_after_markets.material_number as "after_market_mn"'),
            DB::raw('wr_crm_after_markets.material_number as "after_market_sn"'),
            DB::raw('wr_crm_after_markets.tag_number as "after_market_tn"'),
            DB::raw('wr_crm_after_markets.price as "after_market_price"'),
            'seals.*',
            DB::raw('wr_crm_seals.name as "seal_name"'),
            DB::raw('wr_crm_seals.bom_number as "seal_bom_number"'),
            DB::raw('wr_crm_seals.model as "seal_model"'),
            DB::raw('wr_crm_seals.drawing_number as "seal_drawing_number"'),
            DB::raw('wr_crm_seals.tag as "seal_tag_number"'),
            DB::raw('wr_crm_seals.price as "seal_price"'),
            'indented_proposal_item.*',
            DB::raw('wr_crm_indented_proposal_item.id as "indented_proposal_item_id"'),
            DB::raw('wr_crm_indented_proposal_item.quantity as "indented_proposal_item_quantity"'),
            DB::raw('wr_crm_indented_proposal_item.delivery as "indented_proposal_item_delivery"'),
            DB::raw('wr_crm_indented_proposal_item.price as "indented_proposal_item_price"'),
            DB::raw('wr_crm_indented_proposal_item.notify_me_after as "indented_proposal_item_notify_me_after"'))
            ->leftJoin('projects', function($join) {
               $join->on('indented_proposal_item.item_id', '=', 'projects.id')
               ->where('indented_proposal_item.type', '=', 'projects');
            })
            ->leftJoin('after_markets', function($join) {
               $join->on('indented_proposal_item.item_id', '=', 'after_markets.id')
               ->where('indented_proposal_item.type', '=', 'after_markets');
            })
            ->leftJoin('seals', function($join) {
               $join->on('indented_proposal_item.item_id', '=', 'seals.id')
               ->where('indented_proposal_item.type', '=', 'seals');
            })
            ->where('indented_proposal_item.indented_proposal_id', '=', $indented_proposal->id)->get();
            $total_count = 14 + count($selectedItems);
            $sheet->cell('A14:E'. $total_count, function($cells) {

               $cells->setValignment(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
               // Set vertical alignment to middle
               $cells->setAlignment(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

            });

            $sheet->loadView('proposal.admin.indented_proposal.proposal_to_xls', array('indented_proposal' => $indented_proposal, 'selectedItems' => $selectedItems, 'ctr' => $ctr));
         });
         $lastrow= $excel->getActiveSheet()->getHighestRow();
         $excel->getActiveSheet()->getStyle('A1:J'.$lastrow)->getAlignment()->setWrapText(true);
      })->export('xlsx');
   })->name('admin_export_pending_proposal');

   Route::get('export/order_entry/{indented_proposal}', function(\App\IndentedProposal $indented_proposal) {
      $excel = Excel::create('Test Files', function($excel) use($indented_proposal) {
         $excel->sheet('WorthRand Inventory PO', function($sheet) use ($indented_proposal, $excel) {
            $ctr = 0;

            $selectedItems = DB::table('indented_proposal_item')
            ->select('projects.*',
            DB::raw('wr_crm_projects.name as "project_name"'),
            DB::raw('wr_crm_projects.model as "project_md"'),
            DB::raw('wr_crm_projects.serial_number as "project_sn"'),
            DB::raw('wr_crm_projects.part_number as "project_pn"'),
            DB::raw('wr_crm_projects.drawing_number as "project_dn"'),
            DB::raw('wr_crm_projects.tag_number as "project_tn"'),
            DB::raw('wr_crm_projects.material_number as "project_mn"'),
            DB::raw('wr_crm_projects.price as "project_price"'),
            'after_markets.*',
            DB::raw('wr_crm_after_markets.name as "after_market_name"'),
            DB::raw('wr_crm_after_markets.model as "after_market_md"'),
            DB::raw('wr_crm_after_markets.part_number as "after_market_pn"'),
            DB::raw('wr_crm_after_markets.drawing_number as "after_market_dn"'),
            DB::raw('wr_crm_after_markets.material_number as "after_market_mn"'),
            DB::raw('wr_crm_after_markets.material_number as "after_market_sn"'),
            DB::raw('wr_crm_after_markets.tag_number as "after_market_tn"'),
            DB::raw('wr_crm_after_markets.price as "after_market_price"'),
            'seals.*',
            DB::raw('wr_crm_seals.name as "seal_name"'),
            DB::raw('wr_crm_seals.bom_number as "seal_bom_number"'),
            DB::raw('wr_crm_seals.model as "seal_model"'),
            DB::raw('wr_crm_seals.drawing_number as "seal_drawing_number"'),
            DB::raw('wr_crm_seals.tag as "seal_tag_number"'),
            DB::raw('wr_crm_seals.price as "seal_price"'),
            'indented_proposal_item.*',
            DB::raw('wr_crm_indented_proposal_item.id as "indented_proposal_item_id"'),
            DB::raw('wr_crm_indented_proposal_item.quantity as "indented_proposal_item_quantity"'),
            DB::raw('wr_crm_indented_proposal_item.delivery as "indented_proposal_item_delivery"'),
            DB::raw('wr_crm_indented_proposal_item.price as "indented_proposal_item_price"'),
            DB::raw('wr_crm_indented_proposal_item.notify_me_after as "indented_proposal_item_notify_me_after"'))
            ->leftJoin('projects', function($join) {
               $join->on('indented_proposal_item.item_id', '=', 'projects.id')
               ->where('indented_proposal_item.type', '=', 'projects');
            })
            ->leftJoin('after_markets', function($join) {
               $join->on('indented_proposal_item.item_id', '=', 'after_markets.id')
               ->where('indented_proposal_item.type', '=', 'after_markets');
            })
            ->leftJoin('seals', function($join) {
               $join->on('indented_proposal_item.item_id', '=', 'seals.id')
               ->where('indented_proposal_item.type', '=', 'seals');
            })
            ->where('indented_proposal_item.indented_proposal_id', '=', $indented_proposal->id)->get();
            $total_count = 14 + count($selectedItems);
            $sheet->cell('A14:E'. $total_count, function($cells) {

               $cells->setValignment(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
               // Set vertical alignment to middle
               $cells->setAlignment(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

            });

            $sheet->loadView('auth.sales_engineer.order_entry', array('indented_proposal' => $indented_proposal, 'selectedItems' => $selectedItems, 'ctr' => $ctr));
         });
         $lastrow= $excel->getActiveSheet()->getHighestRow();
         $excel->getActiveSheet()->getStyle('A1:J'.$lastrow)->getAlignment()->setWrapText(true);
      })->export('xlsx');
   })->name('se_export_order_entry');


   Route::get('export/buy_and_sell_proposal/{buyAndSellProposal}', function(\App\BuyAndSellProposal $buyAndSellProposal) {
      $excel = Excel::create('Test Files', function($excel) use($buyAndSellProposal) {
         $excel->sheet('WorthRand Inventory PO', function($sheet) use ($buyAndSellProposal, $excel) {
            $ctr = 0;

            $selectedItems = DB::table('buy_and_sell_proposal_item')
            ->select('projects.*',
            DB::raw('wr_crm_projects.name as "project_name"'),
            DB::raw('wr_crm_projects.model as "project_md"'),
            DB::raw('wr_crm_projects.serial_number as "project_sn"'),
            DB::raw('wr_crm_projects.part_number as "project_pn"'),
            DB::raw('wr_crm_projects.drawing_number as "project_dn"'),
            DB::raw('wr_crm_projects.tag_number as "project_tn"'),
            DB::raw('wr_crm_projects.material_number as "project_mn"'),
            DB::raw('wr_crm_projects.price as "project_price"'),
            'after_markets.*',
            DB::raw('wr_crm_after_markets.name as "after_market_name"'),
            DB::raw('wr_crm_after_markets.model as "after_market_md"'),
            DB::raw('wr_crm_after_markets.part_number as "after_market_pn"'),
            DB::raw('wr_crm_after_markets.drawing_number as "after_market_dn"'),
            DB::raw('wr_crm_after_markets.material_number as "after_market_mn"'),
            DB::raw('wr_crm_after_markets.material_number as "after_market_sn"'),
            DB::raw('wr_crm_after_markets.tag_number as "after_market_tn"'),
            DB::raw('wr_crm_after_markets.price as "after_market_price"'),
            'seals.*',
            DB::raw('wr_crm_seals.name as "seal_name"'),
            DB::raw('wr_crm_seals.bom_number as "seal_bom_number"'),
            DB::raw('wr_crm_seals.model as "seal_model"'),
            DB::raw('wr_crm_seals.drawing_number as "seal_drawing_number"'),
            DB::raw('wr_crm_seals.tag as "seal_tag_number"'),
            DB::raw('wr_crm_seals.price as "seal_price"'),
            DB::raw('wr_crm_seals.material_number as "seal_material_number"'),
            'buy_and_sell_proposal_item.*',
            DB::raw('wr_crm_buy_and_sell_proposal_item.id as "buy_and_sell_proposal_item_id"'),
            DB::raw('wr_crm_buy_and_sell_proposal_item.quantity as "buy_and_sell_proposal_item_quantity"'),
            DB::raw('wr_crm_buy_and_sell_proposal_item.delivery as "buy_and_sell_proposal_item_delivery"'),
            DB::raw('wr_crm_buy_and_sell_proposal_item.price as "buy_and_sell_proposal_item_price"'),
            DB::raw('wr_crm_buy_and_sell_proposal_item.notify_me_after as "buy_and_sell_proposal_item_notify_me_after"'))
            ->leftJoin('projects', function($join) {
               $join->on('buy_and_sell_proposal_item.item_id', '=', 'projects.id')
               ->where('buy_and_sell_proposal_item.type', '=', 'projects');
            })
            ->leftJoin('after_markets', function($join) {
               $join->on('buy_and_sell_proposal_item.item_id', '=', 'after_markets.id')
               ->where('buy_and_sell_proposal_item.type', '=', 'after_markets');
            })
            ->leftJoin('seals', function($join) {
               $join->on('buy_and_sell_proposal_item.item_id', '=', 'seals.id')
               ->where('buy_and_sell_proposal_item.type', '=', 'seals');
            })
            ->where('buy_and_sell_proposal_item.buy_and_sell_proposal_id', '=', $buyAndSellProposal->id)->get();
            $total_count = 14 + count($selectedItems);
            $sheet->cell('A14:E'. $total_count, function($cells) {

               $cells->setValignment(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
               // Set vertical alignment to middle
               $cells->setAlignment(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

            });

            $sheet->loadView('proposal.admin.buy_and_sell_proposal.bns_proposal_to_xls', array('buyAndSellProposal' => $buyAndSellProposal, 'selectedItems' => $selectedItems, 'ctr' => $ctr));
         });
         $lastrow= $excel->getActiveSheet()->getHighestRow();
         $excel->getActiveSheet()->getStyle('A1:J'.$lastrow)->getAlignment()->setWrapText(true);
      })->export('xlsx');
   })->name('admin_export_pending_bns_proposal');

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

         # DASHBOARD
         Route::get('/dashboard', 'Collection\UserController@collectionDashboard')->name('collection_dashboard');
         Route::get('/profile', 'Collection\UserController@collectionProfile')->name('collection_user_profile');
         Route::patch('/profile/update', 'Collection\UserController@updateProfile')->name('collection_update_profile');

         # PROPOSALS
         Route::get('/indented_proposals', 'Collection\ProposalController@indexIndentedProposal')->name('index_indented_proposal');
         Route::get('/indented_proposal/{indentedProposal}/collect', 'Collection\ProposalController@forCollection')->name('for_collection');
         Route::post('/indented_proposal/{indentedProposal}/collect', 'Collection\ProposalController@collectIndentedProposal')->name('collect_indented_proposal');
         Route::get('/indented_proposal/{indentedProposal}/completed', 'Collection\ProposalController@collectionViewCompletedIndentedProposal')->name('collection_view_completed_indented_proposal');
         Route::get('/proposal/buy_and_resale/{buyAndSellProposal}/collect', 'Collection\ProposalController@showForCollectionBuyAndSellProposal')->name('collection_show_pending_buy_and_sell_proposal');
         Route::patch('/proposal/buy_and_resale/{buyAndSellProposal}/collection', 'Collection\ProposalController@collectBuyAndSellProposal')->name('collect_buy_and_sell_proposal');
      });
   });



   // ADMIN ACCOUNT
   Route::group(['middleware' => ['verify_if_user_is_admin']], function() {
      Route::group(['prefix' => 'admin'], function() {
         Route::any('/open/project/{project}', 'Admin\ItemController@openProjectPDF')->name('project_open_pdf');

         # DASHBOARD
         Route::get('/dashboard', 'Admin\UserController@adminDashboard')->name('admin_dashboard');
         Route::get('/profile', 'Admin\UserController@profile')->name('admin_user_profile');
         Route::patch('/profile/update', 'Admin\UserController@updateProfile')->name('admin_update_profile');

         # USERS
         Route::get('/users', 'Admin\UserController@adminUserIndex')->name('admin_user_index');
         Route::get('/create/user/', 'Admin\UserController@adminCreateUser')->name('admin_create_user');
         Route::post('/create/user/', 'Admin\UserController@adminPostUser')->name('post_create_user');
         Route::get('/sales_engineers', 'Admin\UserController@showSalesEngineers')->name('admin_sales_engineer_index');

         Route::get('/sales_engineer/{sales_engineer}', 'Admin\UserController@showSalesEngineer')->name('admin_show_sales_engineer');
         Route::get('/sales_engineer/{sales_engineer}/edit', 'Admin\UserController@adminEditSalesEngineer')->name('admin_edit_sales_engineer_information');
         Route::post('/sales_engineer/{salesEngineer}/update', 'Admin\UserController@adminUpdateSalesEngineer')->name('admin_update_sales_engineer');
         Route::post('/sales_engineer/{salesEngineer}/set_target_revenue', 'Admin\UserController@adminSetTargetRevenue')->name('admin_set_se_target_revenue');
         Route::delete('/sales_engineer/{salesEngineer}/delete', 'Admin\UserController@deleteSalesEngineer')->name('admin_delete_se');
         Route::patch('/sales_engineer/{salesEngineer}/deactivate', 'Admin\UserController@deactivateSalesEngineer')->name('admin_deactivate_se');
         Route::patch('/sales_engineer/{salesEngineer}/activate', 'Admin\UserController@activateSalesEngineer')->name('admin_activate_se');

         Route::group(['prefix' => 'user'], function() {
            Route::get('/{user}/edit', 'Admin\UserController@adminEditUser')->name('admin_edit_user');
            Route::get('/{user}/profile', 'Admin\UserController@showUserProfile')->name('show_user_profile');
            Route::patch('/{user}/update', 'Admin\UserController@updateUserProfile')->name('admin_update_user');
            Route::patch('/{user}/reset_password', 'Admin\UserController@adminResetPasswordUser')->name('admin_reset_password_user');
         });

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
         Route::delete('/aftermarket/{afterMarket}/delete', 'Admin\ItemController@adminAftermarketDelete')->name('admin_aftermarket_delete');

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
         Route::delete('/project/{project}/delete', 'Admin\ItemController@adminProjectDelete')->name('admin_project_delete');

         # SEAL
         Route::get('/seal/create', 'Admin\ItemController@adminSealCreate')->name('admin_seal_create');
         Route::post('/seal/create', 'Admin\ItemController@adminPostSealCreate')->name('admin_post_seal_create');
         Route::get('/seals', 'Admin\ItemController@indexSeal')->name('admin_seal_index');
         Route::get('/seal/{seal}', 'Admin\ItemController@showSeal')->name('admin_seal_show');
         Route::get('/seal/{seal}/information', 'Admin\ItemController@adminSealInformation')->name('admin_seal_information');
         Route::patch('/seal/update', 'Admin\ItemController@adminUpdateSealInformation')->name('admin_seal_information_update');
         Route::get('/seal/{seal}/pricing_history', 'Admin\ItemController@adminShowSealPricingHistory')->name('admin_seal_pricing_history_index');
         Route::get('/seal/{seal}/pricing_history/create', 'Admin\ItemController@showSealPricingHistory')->name('admin_seal_pricing_history_create');
         Route::post('/seal/{seal}/pricing_history/create', 'Admin\ItemController@postSealPricingHistory')->name('admin_add_seal_pricing_history');
         Route::delete('/seal/{seal}/delete', 'Admin\ItemController@adminSealDelete')->name('admin_seal_delete');

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
         Route::get('fetch_customers', 'Admin\CustomerController@adminFetchCustomers')->name('admin_fetch_customers');
         Route::post('sales_engineer/{salesEngineer}/save_customer', 'Admin\CustomerController@adminSaveCustomer')->name('admin_save_customer');
         Route::delete('/customer/{customer}/delete', 'Admin\CustomerController@adminDeleteCustomer')->name('admin_delete_customer');
         Route::patch('/customer/{customer}/disassociate', 'Admin\CustomerController@adminDisassociateCustomerToSalesEngineer')->name('disassociate_customer');

         # BRANCHES
         Route::get('/branches', 'Admin\BranchController@adminBranchIndex')->name('admin_branch_index');
         Route::get('/branch/{branch}/edit', 'Admin\BranchController@adminBranchEdit')->name('admin_branch_edit');
         Route::get('/branch/{branch}', 'Admin\BranchController@adminBranchShow')->name('admin_branch_show');

         # PROPOSALS
         Route::get('/indented_proposal', 'Admin\ProposalController@adminIndentedProposalIndex')->name('admin_indented_proposal_index');
         Route::get('/indented_proposal/{indented_proposal}', 'Admin\ProposalController@adminShowPendingIndentedProposal')->name('admin_show_pending_proposal');

         Route::patch('/indented_proposal/{indented_proposal}/accept', 'Admin\ProposalController@adminAcceptProposal')->name('admin_accept_indented_proposal');
         Route::get('/indented_proposal/{indentedProposal}/completed', 'Admin\ProposalController@adminCompletedIndentedProposal')->name('admin_completed_indented_proposal');
         Route::get('/buy_and_resale_proposals', 'Admin\ProposalController@adminBuyAndSellProposalIndex')->name('admin_buy_and_sell_proposal_index');
         Route::post('/buy_and_resale_proposal/create', 'Admin\ProposalController@adminPostCreateBuyAndSellProposal');
         Route::get('/buy_and_resale_proposal/{buyAndSellProposal}', 'Admin\ProposalController@adminBuyAndSellProposalView');
         Route::patch('/buy_and_resale_proposal/{buyAndSellProposal}/accept', 'Admin\ProposalController@adminAcceptBuyAndSellProposal')->name('admin_accept_buy_and_sell_proposal');
         Route::get('/buy_and_resale_proposal/{buy_and_sell_proposal}/pending', 'Admin\ProposalController@adminShowPendingBuyAndSellProposal')->name('admin_show_pending_buy_and_sell_proposal');


         Route::any('proposal/indented/{indentedProposal}/uploaded_po/open', function(App\IndentedProposal $indentedProposal) {
            $file = storage_path() . '/uploads/users/' . $indentedProposal->user_id . '/indented_proposals/' . $indentedProposal->file_name;
            $filename = $indentedProposal->file_name;
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $filename . '"');
            header('Content-Transfer-Encoding: binary');
            header('Accept-Ranges: bytes');
            readfile($file);
         })->name('open_uploaded_po');
      });
   });

   // SALES ENGINEER ACCOUNT
   Route::group(['middleware' => ['verify_if_user_is_sales_engineer']], function() {
      Route::group(['prefix' => 'sales_engineer'], function() {
         # DASHBOARD
         Route::get('/dashboard', 'SalesEngineer\UserController@dashboard')->name('se_dashboard');
         Route::get('/profile', 'SalesEngineer\UserController@profile')->name('sales_engineer_user_profile');
         Route::patch('/profile/update', 'SalesEngineer\UserController@updateProfile')->name('se_update_profile');

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

         # SEALS
         Route::get('/seals', 'SalesEngineer\ItemController@salesEngineerSealIndex')->name('se_seal_index');
         Route::group(['prefix' => 'seal'], function() {
            Route::get('/{seal}', 'SalesEngineer\ItemController@salesEngineerShowSeal')->name('se_show_seal');
         });

         # PRICING HISTORY
         Route::get('/pricing_history', 'SalesEngineer\ItemController@adminPricingHistoryIndex')->name('admin_pricing_history_index');

         Route::get('/get_projects', 'SalesEngineer\ItemController@getProjects')->name('fetch_projects');
         Route::get('/item/{category}', 'SalesEngineer\ItemController@getItemBasedOnCategory')->name('get_item_based_on_category');

         # CUSTOMERS
         Route::get('/customers', 'SalesEngineer\CustomerController@index')->name('customer_index');
         Route::get('/customer/{customer}', 'SalesEngineer\CustomerController@show')->name('show_customer');
         Route::get('/customer/{customer}/branches', 'SalesEngineer\CustomerController@customerBranchList')->name('customer_branch_list');
         // Route::get('/fetch_customers', 'SalesEngineer\CustomerController@fetchCustomers')->name('se_fetch_customers');

         # BRANCHES
         Route::get('/branches', 'SalesEngineer\BranchController@adminBranchIndex')->name('se_branch_index');
         Route::get('/branch/{branch}', 'SalesEngineer\BranchController@adminBranchShow')->name('se_branch_show');

         # PROPOSALS
         Route::post('/proposal/create', 'SalesEngineer\ProposalController@adminCreateProposal')->name('se_create_proposal');
         Route::post('/indented_proposal/create', 'SalesEngineer\ProposalController@salesEngineerPostCreateIndentedProposal');
         Route::get('/indented_proposal/{indentedProposal}', 'SalesEngineer\ProposalController@salesEngineerIndentProposalView');
         Route::post('/indented_proposal/submit', 'SalesEngineer\ProposalController@salesEngineerSubmitIndentedProposal')->name('se_submit_indented_proposal');
         Route::get('/indented_proposals', 'ProposalController@adminIndexIndentedProposal')->name('admin_index_indented_proposal');
         Route::get('/indented_proposal/{indentedProposal}/sent', 'SalesEngineer\ProposalController@showSentIndentedProposal')->name('se_sent_indented_proposal');
         Route::get('/indented_proposal/{indentedProposal}/draft', 'SalesEngineer\ProposalController@showDraftIndentedProposal')->name('show_draft_proposal');
         Route::post('/indented_proposal/{indentedProposal}/resend', 'SalesEngineer\ProposalController@resendDraftIndentedProposal')->name('se_resend_draft_indented_proposal');

         Route::post('/buy_and_resale_proposal/create', 'SalesEngineer\ProposalController@salesEngineerPostCreateBuyAndSellProposal');
         Route::get('/buy_and_resale_proposal/{buyAndSellProposal}', 'SalesEngineer\ProposalController@salesEngineerBuyAndSellProposalView');
         Route::post('/buy_and_sell/create', 'SalesEngineer\ProposalController@salesEngineerPostCreateBuyAndSellProposal')->name('se_create_buy_and_sale_proposal');
         Route::post('/buy_and_resale_proposal/submit', 'SalesEngineer\ProposalController@salesEngineerSubmitBuyAndSellProposal')->name('se_submit_buy_and_sell_proposal');
         Route::get('/buy_and_resale_proposal/{buyAndSellProposal}/draft', 'SalesEngineer\ProposalController@showDraftBuyAndResaleProposal')->name('se_show_draft_buy_and_sell_proposal');
         Route::get('/buy_and_resale_proposal/{buyAndSellProposal}/sent', 'SalesEngineer\ProposalController@showSentBuyAndResaleProposal')->name('se_sent_buy_and_sell_proposal');

         # SEARCH
         Route::get('/search', function() { return view('search.sales_engineer.index'); })->name('search');
         Route::get('/fetch_customers', 'SalesEngineer\CustomerController@fetchCustomers')->name('se_fetch_customers');
      });
   });

   // ASSISTANT ACCOUNT
   Route::group(['middleware' => ['verify_if_user_is_assistant']], function() {
      Route::group(['prefix' => 'assistant'], function() {
         # DASHBOARD
         Route::get('/dashboard', 'Assistant\UserController@dashboard')->name('assistant_dashboard');
         Route::get('/profile', 'Assistant\UserController@profile')->name('assistant_user_profile');
         Route::patch('/profile/update', 'Assistant\UserController@updateProfile')->name('assistant_update_profile');

         # PROPOSALS
         Route::get('/proposal/indented/{indentedProposal}/accepted', 'Assistant\ProposalController@showAcceptedIndentedProposal')->name('assistant_show_pending_proposal');
         Route::patch('/proposal/indented/{indentedProposal}/update', 'Assistant\ProposalController@updateIndentedProposal')->name('assistant_update_accepted_proposal');
         Route::get('/proposal/buy_and_sell/{buyAndSellProposal}/accepted', 'Assistant\ProposalController@assistantShowPendingBuyAndSellProposal')->name('assistant_show_pending_buy_and_sell_proposal');
         Route::patch('/proposal/buy_and_sell/{buyAndSellProposal}/update', 'Assistant\ProposalController@acceptBuyAndSellProposal')->name('assistant_accept_buy_and_sell_proposal');
         Route::patch('/proposal/indented/item/{indentedProposalItem}/delivery/change_status', 'Assistant\ProposalController@changeItemDeliveryStatus')->name('change_indented_item_delivery_status');
         Route::patch('/proposal/buy_and_resale/item/{buyAndSellProposalItem}/delivery/change_status', 'Assistant\ProposalController@buyAndSellProposalChangeItemStatus')->name('change_buy_and_sell_item_delivery_status');
         Route::patch('/proposal/buy_and_resale/item/{buyAndSellProposalItem}/delivery/change_notification', 'Assistant\ProposalController@buyAndSellProposalChangeItemNotifyMeDate')->name('change_item_notify_me_date');
         Route::patch('/proposal/indented/item/{indentedProposalItem}/delivery/change_notification', 'Assistant\ProposalController@indentedProposalChangeItemNotifyMeDate')->name('change_indented_proposal_notify_me_date');
         Route::patch('/proposal/indented/item/{indentedProposalItem}/delivery/status', 'Assistant\ProposalController@indentedProposalChangeDeliveryStatusToDelayed')->name('change_indented_proposal_delivery_status_to_delayed');
         Route::patch('/proposal/buy_and_resale/item/{buyAndSellProposalItem}/delivery/status', 'Assistant\ProposalController@buyAndSellProposalChangeDeliveryStatusToDelayed')->name('change_buy_and_sell_proposal_delivery_status_to_delayed');
      });
   });


   // SECRETARY ACCOUNT
   Route::group(['middleware' => ['verify_if_user_is_secretary']], function() {
      Route::group(['prefix' => 'secretary'], function() {
         # DASHBOARD
         Route::get('/dashboard', 'Secretary\UserController@dashboard')->name('secretary_dashboard');
         Route::get('/profile', 'Secretary\UserController@profile')->name('secretary_user_profile');
         Route::patch('/profile/update', 'Secretary\UserController@updateProfile')->name('secretary_update_profile');

         # PROPOSAL
         Route::get('/proposal/indented/{indentedProposal}/approved', 'Secretary\ProposalController@pendingIndentedProposal')->name('secretary_pending_proposal');
         Route::patch('/proposal/indented/{indentedProposal}/accept', 'Secretary\ProposalController@acceptIndentedProposal')->name('secretary_accept_indented_proposal');
         Route::get('/proposal/buy_and_resale/{buyAndSellProposal}/accept', 'Secretary\ProposalController@viewAcceptedBuyAndSellProposal')->name('secretary_show_pending_buy_and_sell_proposal');
         Route::patch('/proposal/buy_and_resale/{buyAndSellProposal}/accept', 'Secretary\ProposalController@acceptBuyAndResaleProposal')->name('secretary_accept_buy_and_resale_proposal');
      });
   });
});
