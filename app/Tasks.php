<?php

namespace TodoApp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tasks extends Model
{
	public static function getAll(){
		$userID = auth()->id();

		if ($userID) {
			$tasks = DB::select('SELECT * FROM tasks WHERE owner = ? AND status != ? ORDER BY created_at DESC' , [$userID, 1]);
			return $tasks;
		}
	}

	public static function getDoneTasks(){
		$userID = auth()->id();

		if ($userID) {
			$tasks = DB::select('SELECT * FROM tasks WHERE owner = ? AND status = ? ORDER BY updated_at ASC' , [$userID, 1]);
			return $tasks;
		}
	}
}
