<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
   //

   public static function createGroup($createGroupRequest)
   {
      $group = new Group();
      $group->name = $createGroupRequest->get('name');

      if($group->save()) {
         return redirect()->back()->with('message', $group->name . ' was successfully saved');
      }
   }
}
