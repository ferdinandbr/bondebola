<?php
use App\Models\User;

function validRules($data, $rules, $customErrors)
{
	$validator = \Validator::make($data,$rules,$customErrors);

	if(!$validator->passes()) {
		$messages = $validator->errors()->first();
		abort(409, $messages);
	}

  return $validator->validated();
}

function checkCanCreate($userId) {
  $user = new User();
  $user = $user->with('ownedGroups')
    ->where('id', $userId)
    ->first();
    
  abort_if(count($user->ownedGroups) >=2, 409, 'Você já atingiu o número máximo de rachas criado !');

  return true;
}