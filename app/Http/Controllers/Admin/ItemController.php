<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateGroupRequest;
use App\Group;
use App\Http\Requests\CreateAfterMarketRequest;
use App\Http\Requests\CreateProjectRequest;
use App\Project;
use App\AfterMarket;
use App\Customer;
use App\Http\Requests\UpdateProjectInformationRequest;
use DB;
use App\Http\Requests\AddProjectPricingHistoryRequest;
use App\Http\Requests\CreateAfterMarketPricingHistoryRequest;
use App\AfterMarketPricingHistory;
use App\Http\Requests\UpdateAfterMarketInformationRequest;
use App\Http\Requests\CreateSealRequest;
use App\Http\Controllers\Controller;
use App\Seal;
use App\Http\Requests\UpdateSealInformationRequest;
use App\Http\Requests\CreatePricingHistoryForSealRequest;
use App\SealPricingHistory;
use App\Http\Requests\AdminCreateSealRequest;
use App\UploadProject;
use File;
use App\AftermarketUpload;

class ItemController extends Controller
{
   /**
   * ItemController constructor.
   */
   public function __construct()
   {
      $this->middleware('verify_if_user_is_admin');
   }

   public function index()
   {
      $groups = Group::all();

      return view('item.index', compact('groups'));
   }

   public function adminCreateGroup()
   {
      return view('item.category.admin.create');
   }

   public function adminPostGroup(CreateGroupRequest $createGroupRequest)
   {
      $create_group = Group::createGroup($createGroupRequest);

      return $create_group;
   }

   public function createAfterMarket()
   {
      return view('item.after_market.admin.create');
   }

   public function postAfterMarket(Request $request, CreateAfterMarketRequest $createAfterMarketRequest)
   {
      $post_after_market = AfterMarket::postAfterMarket($request, $createAfterMarketRequest);

      return $post_after_market;
   }

   public function createProject()
   {
      $customers = Customer::all();

      return view('item.project.admin.create', compact('customers'));
   }

   public function postProject(CreateProjectRequest $createProjectRequest)
   {
      $create_project = Project::createProject($createProjectRequest);

      return $create_project;
   }

   public function getProjects()
   {
      $fetch_projects = Project::fetchProjects();

      return $fetch_projects;
   }

   public function indexProject()
   {
      $projects = Project::paginate(30);
      $projects->setPath('/');

      return view('item.project.admin.index', compact('projects'));
   }

   public function showProject(Project $project)
   {
      return view('item.project.admin.show', compact('project'));
   }

   public function adminProjectInformation(Project $project)
   {
      return view('item.project.admin.information', compact('project'));
   }

   public function showAfterMarket(AfterMarket $afterMarket)
   {
      return view('item.after_market.admin.show', compact('afterMarket'));
   }

   public function adminUpdateProjectInformation(Request $request, UpdateProjectInformationRequest $updateProjectInformationRequest)
   {
      $adminUpdateProject = Project::adminUpdateProject($request, $updateProjectInformationRequest);

      return $adminUpdateProject;
   }

   public function adminProjectPricingHistoryIndex(Project $project)
   {
      return view('item.project.admin.pricing_history.index', compact('project'));
   }

   public function adminProjectPricingHistoryCreate(Project $project)
   {
      return view('item.project.admin.pricing_history.create', compact('project'));
   }

   public function adminPricingHistoryIndex()
   {
      return view('item.pricing_history.admin.index');
   }

   public function indexAftermarket()
   {
      $aftermarkets = AfterMarket::paginate(20);
      $aftermarkets->setPath('/aftermarkets');

      return view('item.after_market.admin.index', compact('aftermarkets'));
   }

   public function adminAddProjectPricingHistory(AddProjectPricingHistoryRequest $addProjectPricingHistoryRequest, Project $project)
   {
      $add_project_pricing_history = Project::addProjectPricingHistory($addProjectPricingHistoryRequest, $project);

      return $add_project_pricing_history;
   }

   public function adminAddAfterMarketPricingHistory(CreateAfterMarketPricingHistoryRequest $createAfterMarketPricingHistoryRequest, AfterMarket $afterMarket)
   {
      $add_after_market_pricing_history = AfterMarket::addAfterMarketPricingHistory($createAfterMarketPricingHistoryRequest, $afterMarket);

      return $add_after_market_pricing_history;
   }

   public function adminProjectDashboard()
   {
      $projects = Project::all();

      return view('project.admin.dashboard', compact('projects'));
   }

   public function adminAfterMarketInformation(AfterMarket $afterMarket)
   {
      return view('item.after_market.admin.edit', compact('afterMarket'));
   }

   public function adminAfterMarketPricingHistoryIndex(AfterMarket $afterMarket)
   {
      return view('item.after_market.admin.pricing_history.index', compact('afterMarket'));
   }

   public function adminUpdateAfterMarketInformation(Request $request, UpdateAfterMarketInformationRequest $updateAfterMarketInformationRequest)
   {
      $afterMarket = AfterMarket::find($request->get('aftermarket_id'));
      $afterMarket->update($updateAfterMarketInformationRequest->except(array('_token', '_method', 'aftermarket_id')));

      return redirect()->back()->with('message', 'AfterMarket ['.$afterMarket->name.'] was successfully updated');
   }

   public function adminAfterMarketPricingHistoryCreate(AfterMarket $afterMarket)
   {
      return view('item.after_market.admin.pricing_history.create', compact('afterMarket'));
   }

   public function adminCreateAfterMarketOnProject(Project $project)
   {
      return view('item.project.admin.create_aftermarket', compact('project'));
   }

   public function indexSeal()
   {
      $ctr = 0;
      $seals = Seal::paginate(30);
      $seals->setPath('/seals');

      return view('item.seal.admin.index', compact('seals', 'ctr'));
   }

   public function adminSealCreate()
   {
      return view('item.seal.admin.create');
   }

   public function showSeal(Seal $seal)
   {
      return view('item.seal.admin.show', compact('seal'));
   }

   public function adminSealInformation(Seal $seal)
   {
      return view('item.seal.admin.edit', compact('seal'));
   }

   public function adminUpdateSealInformation(Request $request, UpdateSealInformationRequest $updateSealInformationRequest)
   {
      $adminUpdateSeal = Seal::adminUpdateSeal($request, $updateSealInformationRequest);

      return $adminUpdateSeal;
   }

   public function showSealPricingHistory(Seal $seal)
   {
      return view('item.seal.admin.pricing_history.create', compact('seal'));
   }

   public function postSealPricingHistory(CreatePricingHistoryForSealRequest $createPricingHistoryForSealRequest, Seal $seal)
   {
      $postSealPricingHistory = SealPricingHistory::postSealPricingHistory($createPricingHistoryForSealRequest, $seal);

      return $postSealPricingHistory;
   }

   public function adminShowSealPricingHistory(Seal $seal)
   {
      $ctr = 0;
      $sealPricingHistory = $seal->seal_pricing_history()->paginate(30);
      $sealPricingHistory->setPath('/seals');

      return view('item.seal.admin.pricing_history.index', compact('sealPricingHistory', 'seal', 'ctr'));
   }

   public function adminPostSealCreate(Request $request, AdminCreateSealRequest $adminCreateSealRequest)
   {
      $adminPostSealCreate = Seal::adminPostSealCreate($request, $adminCreateSealRequest);

      return $adminPostSealCreate;
   }

   public function adminProjectDelete(Project $project)
   {
      $deletedProject = Project::find($project->id);
      $deletedProject->delete();

      return redirect()->route('admin_project_index')->with('message', 'You have successfully deleted Project "' . strtoupper($project->name) . '"');
   }

   public function adminAftermarketDelete(AfterMarket $afterMarket)
   {
      $deletedAftermarket = AfterMarket::find($afterMarket->id);
      $deletedAftermarket->delete();

      return redirect()->route('after_market_index')->with('message', 'You have successfully deleted Aftermarket "' . strtoupper($afterMarket->name) . '"');
   }

   public function adminSealDelete(Seal $seal)
   {
      $deletedSeal = Seal::find($seal->id);
      $deletedSeal->delete();

      return redirect()->route('admin_seal_index')->with('message', 'You have successfully deleted Seal "' . strtoupper($seal->name) . '"');
   }

   public function openProjectPDF(UploadProject $uploadedProject)
   {
      $file = $uploadedProject->filepath . $uploadedProject->original_filename;
      $filename = basename($uploadedProject->scanned_file . $uploadedProject->original_filename);

      header('Content-type: application/pdf');
      header('Content-Disposition: inline; filename="' . $filename . '"');
      header('Content-Transfer-Encoding: binary');
      header('Content-Length: ' . filesize($file));
      header('Accept-Ranges: bytes');

      @readfile($file);
   }

   public function adminUploadFileOnProject(Request $request)
   {
      $adminUploadFileOnProject = Project::adminUploadFileOnProject($request);

      return $adminUploadFileOnProject;
   }

   public function adminDownloadFile(UploadProject $uploadedProject)
   {
      $file_path = $uploadedProject->filepath . $uploadedProject->original_filename;
      return response()->download($file_path);
   }

   public function adminDeleteUploadProject(UploadProject $uploadedProject)
   {
      $uploadedProject->delete();
      File::delete($uploadedProject->filepath . $uploadedProject->original_filename);

      return redirect()->back();
   }

   public function adminUploadFileOnAftermarket(Request $request)
   {
      $adminUploadFileOnAftermarket = Aftermarket::adminUploadFileOnAftermarket($request);

      return $adminUploadFileOnAftermarket;
   }

   public function adminDownloadAftermarketFile(AftermarketUpload $uploadedAftermarket)
   {
      $file_path = $uploadedAftermarket->filepath . $uploadedAftermarket->original_filename;
      return response()->download($file_path);
   }

   public function adminDeleteUploadedAftermarketFile(AftermarketUpload $uploadedAftermarket)
   {
      $uploadedAftermarket->delete();
      File::delete($uploadedAftermarket->filepath . $uploadedAftermarket->original_filename);

      return redirect()->back();
   }

   public function openAftermarketPDF(AftermarketUpload $uploadedAftermarket)
   {
      $file = $uploadedAftermarket->filepath . $uploadedAftermarket->original_filename;
      $filename = basename($uploadedAftermarket->scanned_file . $uploadedAftermarket->original_filename);

      header('Content-type: application/pdf');
      header('Content-Disposition: inline; filename="' . $filename . '"');
      header('Content-Transfer-Encoding: binary');
      header('Content-Length: ' . filesize($file));
      header('Accept-Ranges: bytes');

      @readfile($file);
   }
}
