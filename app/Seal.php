<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use File;

class Seal extends Model
{
   use SoftDeletes;

   protected $fillable = [
      'name', 'drawing_number', 'bom_number', 'end_user', 'seal_type', 'size', 'material_number', 'code', 'model', 'serial_number','tag', 'price', 'scanned_file'
   ];

   protected $dates = ["deleted_at"];

   public function seal_pricing_history()
   {
      return $this->hasMany(SealPricingHistory::class);
   }

   public function upload_seals()
   {
      return $this->hasMany(UploadSeal::class);
   }

   public static function adminPostSealCreate($adminCreateSealRequest, $request)
   {
      $seal = new Seal();
      $seal->name = strtoupper($adminCreateSealRequest->get('name'));
      $seal->drawing_number = strtoupper($adminCreateSealRequest->get('drawing_number'));
      $seal->bom_number = strtoupper($adminCreateSealRequest->get('bom_number'));
      $seal->end_user = strtoupper($adminCreateSealRequest->get('end_user'));
      $seal->seal_type = strtoupper($adminCreateSealRequest->get('seal_type'));
      $seal->material_number = strtoupper($adminCreateSealRequest->get('material_number'));
      $seal->code = strtoupper($adminCreateSealRequest->get('code'));
      $seal->model = strtoupper($adminCreateSealRequest->get('model'));
      $seal->serial_number = strtoupper($adminCreateSealRequest->get('serial_number'));
      $seal->tag = strtoupper($adminCreateSealRequest->get('tag'));
      $seal->size = strtoupper($adminCreateSealRequest->get('size'));
      $seal->price = str_replace(',', '', $adminCreateSealRequest->get('price'));

      if($seal->save())
      {
         return redirect()->back()->with('message', 'Seal Successfully Added')->with('msg_icon', 'fa-check')->with('alert', 'alert-success');
      }
      return redirect()->back()->with('message', 'Seal Not Added')->with('msg_icon', 'fa-check')->with('alert', 'alert-success');
   }

   public static function adminUpdateSeal($request, $updateSealInformationRequest)
   {

      $seal = Seal::find($request->get('seal_id'));
      $seal->update([
         'name' => $updateSealInformationRequest->get('name'),
         'drawing_number' => $updateSealInformationRequest->get('drawing_number'),
         'bom_number' => $updateSealInformationRequest->get('bom_number'),
         'end_user' => $updateSealInformationRequest->get('end_user'),
         'seal_type' => $updateSealInformationRequest->get('seal_type'),
         'size' => $updateSealInformationRequest->get('size'),
         'material_number' => $updateSealInformationRequest->get('material_number'),
         'code' => $updateSealInformationRequest->get('code'),
         'model' => $updateSealInformationRequest->get('model'),
         'serial_number' => $updateSealInformationRequest->get('serial_number'),
         'tag' => $updateSealInformationRequest->get('tag'),
         'price' => str_replace(',', '', $request->get('price')),
      ]);

      return redirect()->back()->with('message', 'Seal ['.$seal->name.'] was successfully updated');
   }

   public static function adminUploadFileOnSeal($request)
   {
      $uploadedSeal = new UploadSeal();
      $sealId = $request->get('seal_id');
      $path = storage_path('uploads/seal/' . $sealId . '/');
      $file = $request->file('file');

      if(!File::exists($path)) {
         File::makeDirectory($path, 0777, true, true);

         $uploadedSeal->seal_id = $sealId;
         $uploadedSeal->original_filename = $file->getClientOriginalName();
         $uploadedSeal->file_type = strtoupper($file->getClientOriginalExtension());
         $uploadedSeal->filepath = $path;

         if($uploadedSeal->save()) {
            $file->move($path, $file->getClientOriginalName());
         }
      }

      $uploadedSeal->seal_id = $sealId;
      $uploadedSeal->original_filename = $file->getClientOriginalName();
      $uploadedSeal->file_type = strtoupper($file->getClientOriginalExtension());
      $uploadedSeal->filepath = $path;

      if($uploadedSeal->save()) {
         $file->move($path, $file->getClientOriginalName());
      }
   }
}
