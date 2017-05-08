<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProjectPricingHistory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
   use SoftDeletes;

   protected $fillable = [
      'name', 'model', 'ccn_number', 'part_number', 'reference_number', 'drawing_number', 'material_number', 'serial_number',
      'tag_number', 'price', 'address', 'contact_person', 'consultant', 'epc', 'vendors', 'epc_award', 'implementation_date', 'bu',
      'status', 'final_result', 'value', 'scanned_file'
   ];

   protected $dates = ['deleted_at'];

   public function after_markets()
   {
      return $this->hasMany(AfterMarket::class);
   }

   public function project_pricing_history()
   {
      return $this->hasMany(ProjectPricingHistory::class)->latest();
   }

   public function seals()
   {
      return $this->hasMany(Seal::class);
   }

   public static function createProject($createProjectRequest)
   {
      $path = storage_path() . '/uploads/projects/';
      if(! $createProjectRequest->hasFile('scanned_file') ) {
         $scannedProject = "<N/A>";
      } else {
         $file = $createProjectRequest->file('scanned_file');
         $file->move($path, $file->getClientOriginalName());
         $scannedProject = $path . $file->getClientOriginalName();
      }

      $project = new Project();
      $project->name = trim(ucwords($createProjectRequest->get('name'), " "));
      $project->model = trim(strtoupper($createProjectRequest->get('model')));
      $project->ccn_number = trim(strtoupper($createProjectRequest->get('ccn_number')));
      $project->part_number = trim(strtoupper($createProjectRequest->get('part_number')));
      $project->reference_number = trim(strtoupper($createProjectRequest->get('reference_number')));
      $project->drawing_number = trim(strtoupper($createProjectRequest->get('drawing_number')));
      $project->material_number = trim(strtoupper($createProjectRequest->get('material_number')));
      $project->serial_number = trim(strtoupper($createProjectRequest->get('serial_number')));
      $project->tag_number = trim(strtoupper($createProjectRequest->get('tag_number')));
      $project->contact_person = trim(strtoupper($createProjectRequest->get('contact_person')));
      $project->address = trim(strtoupper($createProjectRequest->get('address')));
      $project->consultant = trim(strtoupper($createProjectRequest->get('consultant')));
      $project->epc = trim(strtoupper($createProjectRequest->get('epc')));
      $project->vendors = trim(strtoupper($createProjectRequest->get('vendors')));
      $project->epc_award = trim(strtoupper($createProjectRequest->get('epc_award')));
      $project->implementation_date = date('Y-m-d', strtotime(trim($createProjectRequest->get('implementation_date'))));
      $project->bu = trim(strtoupper($createProjectRequest->get('bu')));
      $project->status = trim(strtoupper($createProjectRequest->get('status')));
      $project->final_result = trim(strtoupper($createProjectRequest->get('final_result')));
      $project->value = trim(strtoupper($createProjectRequest->get('value')));
      $project->scanned_file = $scannedProject;

      if ($project->save()) {
         return redirect()->back()->with('message', 'Project "'.$project->name.'" was successfully created');
      } else {
         return redirect()->back()->with('message', 'An error occured when saving the Project.');
      }
   }

   public static function addProjectPricingHistory($addProjectPricingHistoryRequest, $project)
   {
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
         'name' => strtoupper($updateProjectInformationRequest->get('name')),
         'part_number' => strtoupper($updateProjectInformationRequest->get('part_number')),
         'ccn_number' => strtoupper($updateProjectInformationRequest->get('ccn_number')),
         'model' => strtoupper($updateProjectInformationRequest->get('model')),
         'reference_number' => strtoupper($updateProjectInformationRequest->get('reference_number')),
         'drawing_number' => strtoupper($updateProjectInformationRequest->get('drawing_number')),
         'material_number' => strtoupper($updateProjectInformationRequest->get('material_number')),
         'serial_number' => strtoupper($updateProjectInformationRequest->get('serial_number')),
         'tag_number' => strtoupper($updateProjectInformationRequest->get('tag_number')),
         'contact_person' => trim(strtoupper($updateProjectInformationRequest->get('contact_person'))),
         'consultant' => trim(strtoupper($updateProjectInformationRequest->get('consultant'))),
         'epc' => trim(strtoupper($updateProjectInformationRequest->get('epc'))),
         'vendors' => trim(strtoupper($updateProjectInformationRequest->get('vendors'))),
         'epc_award' => trim(strtoupper($updateProjectInformationRequest->get('epc_award'))),
         'implementation_date' => date('Y-m-d', strtotime(trim($updateProjectInformationRequest->get('implementation_date')))),
         'bu' => trim(strtoupper($updateProjectInformationRequest->get('bu'))),
         'status' => trim(strtoupper($updateProjectInformationRequest->get('status'))),
         'final_result' => trim(strtoupper($updateProjectInformationRequest->get('final_result'))),
         'value' => trim(strtoupper($updateProjectInformationRequest->get('value'))),
         'scanned_file' => $scannedProject
      ]);

      return redirect()->back()->with('message', 'Project ['.$project->name.'] was successfully updated');
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
