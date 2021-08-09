<?php 
namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
	public function getAll(): ?Collection;
}