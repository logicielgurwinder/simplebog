<?php 
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

interface RepositoryInterface
{
	public function find($id): ?Model;
}