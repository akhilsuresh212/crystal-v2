<?php

/**
 * @Author Deepak
 * @Class Parameters Validate Class
 * @Date 23/01/2016  
 */
class Parameters extends Service
{

	public static function required($vars)
	{
		$postedVars = Service::getVars();
		$postedVarsKeys = array_keys(Service::getVars());
		//$diff = array_merge(array_diff($vars,$postedVars),array_diff($postedVars,$vars));
		$diff = array_diff($vars, $postedVarsKeys);

		if (empty($diff)) {

			$requiredDiff = array_diff($postedVarsKeys, $vars);

			foreach ($requiredDiff as $var) {
				unset($postedVars[$var]);
			}

			// Empty values passed in request for a required parameter
			$requestVars = array_map('trim', $postedVars);

			if (in_array("", $requestVars)) {
				$result = array_filter($requestVars, 'strlen');
				$requestVars = array_keys($result);
				$diff = array_merge(array_diff($vars, $requestVars), array_diff($requestVars, $vars));

				$message = "Please enter " . implode(', ', $diff);
				header('HTTP/1.0 400 Bad Request');
				header('Content-Type: application/json');
				$response = array(
					'status' => 'error',
					'message' => $message
				);
				echo json_encode($response);
				exit;
			}
			return true;
		} else {
			$message = implode(', ', $diff) . " are required";
			header('HTTP/1.0 400 Bad Request');
			header('Content-Type: application/json');
			$response = array(
				'status' => 'error',
				'message' => $message
			);
			echo json_encode($response);
			exit;
		}
	}

	/************
	 * validate parameters from the request.
	 * @param Array $values Values to be validated
	 * @param Array $rules Rules for validation 
	 */
	public static function validate($values, $rules)
	{
		if (empty($values))
			return;
		if (empty($rules))
			return;
		$fields = array_keys($values);

		foreach ($fields as $field) {
			if (count($rules[$field]) == 1) {
				Parameters::validate_rule($rules[$field], $values[$field], $field);
			} else {
				foreach ($rules[$field] as $i => $rule) {
					$single_rule[$i] = $rule;
					Parameters::validate_rule($single_rule, $values[$field], $field);
					unset($single_rule);
				}
			}
		}
	}

	private static function validate_rule($rule, $value, $field)
	{
		$rule_key = end(array_keys($rule));
		switch ($rule_key) {
			case 'email':
				if ($rule['email'] == 1) {
					if (!(filter_var($value, FILTER_VALIDATE_EMAIL)))
						Response::error($field . ' is not valid');
				}
				break;
			case 'minlength':
				if (strlen($value) < $rule['minlength']) {
					Response::error($field . " size should be greater than " . $rule['minlength']);
				}
				break;
			case 'maxlength':
				if (strlen($value) > $rule['maxlength'])
					Response::error($field . " size should be less than " . $rule['maxlength']);
				break;
			case 'number':
				if (!ctype_digit($value))
					Response::error($field . " Must be a number");
				break;
			case 'letter':
				if ($rule['letter'] == 1) {
					if (!ctype_alpha($value))
						Response::error($field . " must be letters");
				}
		}
	}
}
