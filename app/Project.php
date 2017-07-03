<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProjectPricingHistory;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;
use DB;

class Project extends Model
{
   use SoftDeletes;

   protected $fillable = [
      'customer_id', 'name', 'project_terms', 'source', 'address_1', 'contact_person_1', 'contact_number_1', 'email_1',
      'consultant', 'address_2', 'contact_person_2', 'contact_number_2', 'email_2', 'shorted_list_epc', 'address_3',
      'contact_person_3', 'contact_number_3', 'email_3', 'approved_vendors_list', 'requirement', 'epc_award',
      'award_date', 'implementation_date', 'execution_date', 'bu', 'bu_reference', 'wpc_reference', 'affinity_reference',
      'reference_number', 'drawing_number', 'material_number', 'serial_number', 'tag_number', 'value', 'vendors', 'epc', 'final_result', 'scanned_file'
   ];

   protected $dates = ['deleted_at'];

   public function customer()
   {
      return $this->belongsTo(Customer::class);
   }

   public function project_pricing_history()
   {
      return $this->hasMany(ProjectPricingHistory::class)->latest();
   }

   public function upload_projects()
   {
      return $this->hasMany(UploadProject::class)->latest();
   }

   public static function createProject($createProjectRequest)
   {
      $project = new Project();
      $project->customer_id = $createProjectRequest->get('customer_id');
      $project->name = trim(ucwords($createProjectRequest->get('name'), " "));
      $project->project_terms = trim(strtoupper($createProjectRequest->get('project_terms')));
      $project->source = trim(strtoupper($createProjectRequest->get('source')));
      $project->address_1 = trim(strtoupper($createProjectRequest->get('address_1')));
      $project->contact_person_1 = trim(strtoupper($createProjectRequest->get('contact_person_1')));
      $project->contact_number_1 = trim(strtoupper($createProjectRequest->get('contact_number_1')));
      $project->email_1 = trim(strtoupper($createProjectRequest->get('email_1')));
      $project->consultant = trim(strtoupper($createProjectRequest->get('consultant')));
      $project->address_2 = trim(strtoupper($createProjectRequest->get('address_2')));
      $project->contact_person_2 = trim(strtoupper($createProjectRequest->get('contact_person_2')));
      $project->contact_number_2 = trim(($createProjectRequest->get('contact_number_2')));
      $project->email_2 = trim(strtoupper($createProjectRequest->get('email_2')));
      $project->shorted_list_epc = trim(strtoupper($createProjectRequest->get('shorted_list_epc')));
      $project->address_3 = trim(strtoupper($createProjectRequest->get('address_3')));
      $project->contact_person_3 = trim(strtoupper($createProjectRequest->get('contact_person_3')));
      $project->contact_number_3 = trim(($createProjectRequest->get('contact_number_3')));
      $project->email_3 = trim(strtoupper($createProjectRequest->get('email_3')));
      $project->approved_vendors_list = trim(strtoupper($createProjectRequest->get('approved_vendors_list')));
      $project->requirement = trim(strtoupper($createProjectRequest->get('requirement')));
      $project->epc_award = trim(strtoupper($createProjectRequest->get('epc_award')));
      $project->award_date = date('Y-m-d', strtotime(trim($createProjectRequest->get('award_date'))));
      $project->implementation_date = date('Y-m-d', strtotime(trim($createProjectRequest->get('implementation_date'))));
      $project->execution_date = date('Y-m-d', strtotime(trim($createProjectRequest->get('execution_date'))));
      $project->bu = trim(strtoupper($createProjectRequest->get('bu')));
      $project->bu_reference = trim(strtoupper($createProjectRequest->get('bu_reference')));
      $project->wpc_reference = trim(strtoupper($createProjectRequest->get('wpc_reference')));
      $project->affinity_reference = trim(strtoupper($createProjectRequest->get('affinity_reference')));
      $project->value = trim(strtoupper($createProjectRequest->get('value')));
      $project->status = trim(strtoupper($createProjectRequest->get('status')));
      $project->reference_number = trim(strtoupper($createProjectRequest->get('reference_number')));
      $project->drawing_number = trim(strtoupper($createProjectRequest->get('drawing_number')));
      $project->material_number = trim(strtoupper($createProjectRequest->get('material_number')));
      $project->serial_number = trim(strtoupper($createProjectRequest->get('serial_number')));
      $project->tag_number = trim(strtoupper($createProjectRequest->get('tag_number')));
      $project->value = trim(strtoupper($createProjectRequest->get('value')));
      $project->epc = trim(strtoupper($createProjectRequest->get('epc')));
      $project->vendors = trim(strtoupper($createProjectRequest->get('vendors')));
      $project->final_result = trim(strtoupper($createProjectRequest->get('final_result')));

      if ($project->save()) {
         return redirect()->route('admin_project_show', $project->id)->with('message', 'Project "'.$project->name.'" was successfully created');
      } else {
         return redirect()->back()->with('message', 'An error occured when saving the Project.');
      }
   }

   public static function addProjectPricingHistory($addProjectPricingHistoryRequest, $project)
   {
      DB::transaction(function() {
         $project_pricing_history = new ProjectPricingHistory();
         $project_pricing_history->project_id = $project->id;
         $project_pricing_history->po_number = strtoupper($addProjectPricingHistoryRequest->get('po_number'));
         $project_pricing_history->pricing_date = trim(strtoupper($addProjectPricingHistoryRequest->get('pricing_date')));
         $project_pricing_history->price = str_replace(',', '', trim($addProjectPricingHistoryRequest->get('price')));
         $project_pricing_history->terms = trim(strtoupper($addProjectPricingHistoryRequest->get('terms')));
         $project_pricing_history->delivery = trim(strtoupper($addProjectPricingHistoryRequest->get('delivery')));
         $project_pricing_history->fpd_reference = trim(strtoupper($addProjectPricingHistoryRequest->get('fpd_reference')));
         $project_pricing_history->wpc_reference = trim(strtoupper($addProjectPricingHistoryRequest->get('wpc_reference')));

         if($project_pricing_history->save()) {
            $project = Project::find($project_pricing_history->project_id);
            $project->update(['price' => $project_pricing_history->price]);

            return redirect()->back()->with('message', 'Pricing History for Project ['.$project->name.'] was successfully saved');
         }
      });
   }

   public static function adminUpdateProject($request, $updateProjectInformationRequest)
   {
      $path = storage_path() . '/uploads/projects/';
      if(! $updateProjectInformationRequest->hasFile('scanned_file') ) {
         $scannedProject = "<N/A>";
      } else {
         $file = $updateProjectInformationRequest->file('scanned_file');
         $file->move($path, $file->getClientOriginalName());
         $scannedProject = $path . $file->getClientOriginalName();
      }

      $project = Project::find($request->get('project_id'));
      $project->update([
         'customer_id' => trim($createProjectRequest->get('customer_id')),
         'name' => trim(ucwords($createProjectRequest->get('name'), " ")),
         'project_terms' => trim(strtoupper($createProjectRequest->get('project_terms'))),
         'source' => trim(strtoupper($createProjectRequest->get('source'))),
         'address_1' => trim(strtoupper($createProjectRequest->get('address_1'))),
         'contact_person_1' => trim(strtoupper($createProjectRequest->get('contact_person_1'))),
         'contact_number_1' => trim(strtoupper($createProjectRequest->get('contact_number_1'))),
         'email_1' => trim(strtoupper($createProjectRequest->get('email_1'))),
         'consultant' => trim(strtoupper($createProjectRequest->get('consultant'))),
         'address_2' => trim(strtoupper($createProjectRequest->get('address_2'))),
         'contact_person_2' => trim(strtoupper($createProjectRequest->get('contact_person_2'))),
         'contact_number_2' => trim(($createProjectRequest->get('contact_number_2'))),
         'email_2' => trim(strtoupper($createProjectRequest->get('email_2'))),
         'shorted_list_epc' => trim(strtoupper($createProjectRequest->get('shorted_list_epc'))),
         'address_3' => trim(strtoupper($createProjectRequest->get('address_3'))),
         'contact_person_3' => trim(strtoupper($createProjectRequest->get('contact_person_3'))),
         'contact_number_3' => trim(($createProjectRequest->get('contact_number_3'))),
         'email_3' => trim(strtoupper($createProjectRequest->get('email_3'))),
         'approved_vendors_list' => trim(strtoupper($createProjectRequest->get('approved_vendors_list'))),
         'requirement' => trim(strtoupper($createProjectRequest->get('requirement'))),
         'epc_award' => trim(strtoupper($createProjectRequest->get('epc_award'))),
         'award_date' => date('Y-m-d', strtotime(trim($createProjectRequest->get('award_date')))),
         'implementation_date' => date('Y-m-d', strtotime(trim($createProjectRequest->get('implementation_date')))),
         'execution_date' => date('Y-m-d', strtotime(trim($createProjectRequest->get('execution_date')))),
         'bu' => trim(strtoupper($createProjectRequest->get('bu'))),
         'bu_reference' => trim(strtoupper($createProjectRequest->get('bu_reference'))),
         'wpc_reference' => trim(strtoupper($createProjectRequest->get('wpc_reference'))),
         'affinity_reference' => trim(strtoupper($createProjectRequest->get('affinity_reference'))),
         'value' => trim(strtoupper($createProjectRequest->get('value'))),
         'status' => trim(strtoupper($createProjectRequest->get('status'))),
         'reference_number' => trim(strtoupper($updateProjectInformationRequest->get('reference_number'))),
         'drawing_number' => trim(strtoupper($updateProjectInformationRequest->get('drawing_number'))),
         'material_number' => trim(strtoupper($updateProjectInformationRequest->get('material_number'))),
         'serial_number' => trim(strtoupper($updateProjectInformationRequest->get('serial_number'))),
         'tag_number' => trim(strtoupper($updateProjectInformationRequest->get('tag_number'))),
         'final_result' => trim(strtoupper($createProjectRequest->get('final_result'))),
         'scanned_file' => $scannedProject
      ]);

      return redirect()->back()->with('message', 'Project "'.$project->name.'" was successfully updated');
   }

   public static function adminUploadFileOnProject($request)
   {
      $uploadedProject = new UploadProject();
      $projectId = $request->get('project_id');
      $path = storage_path('uploads/projects/' . $projectId . '/');
      $file = $request->file('file');

      if(!File::exists($path)) {
         File::makeDirectory($path, 0777, true, true);

         $uploadedProject->project_id = $projectId;
         $uploadedProject->original_filename = $file->getClientOriginalName();
         $uploadedProject->file_type = strtoupper($file->getClientOriginalExtension());
         $uploadedProject->filepath = $path;

         if($uploadedProject->save()) {
            $file->move($path, $file->getClientOriginalName());
         }
      }

      $uploadedProject->project_id = $projectId;
      $uploadedProject->original_filename = $file->getClientOriginalName();
      $uploadedProject->file_type = strtoupper($file->getClientOriginalExtension());
      $uploadedProject->filepath = $path;

      if($uploadedProject->save()) {
         $file->move($path, $file->getClientOriginalName());
      }
   }

   /*
   * JSON Section
   * */

   public static function fetchProjects()
   {
      $jsonProject = array();
      $projects = Project::all();

      foreach($projects as $project) {
         $jsonProject['suggestions'][] = [
            'data' => $project->id,
            'value' => $project->name
         ];
      }

      return json_encode($jsonProject);
   }
}
