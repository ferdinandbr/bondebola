<?php

function validRules($data, $rules, $customErrors)
{
	$validator = \Validator::make($data,$rules,$customErrors);

	if(!$validator->passes()) {
		$messages = $validator->errors()->first();
		abort(409, $messages);
	}

  return $validator->validated();
}