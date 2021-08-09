<?php 

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\RepositoryInterface;


class BaseRepository implements RepositoryInterface
{
	
	public function __construct(Model $model)
	{
		$this->model=$model;
	}

	public function find($id): ?Model
	{
		return $this->model->find($id);
	}
}