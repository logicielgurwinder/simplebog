<?php 

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\PostRepositoryInterface;
use App\Models\Post;
use Illuminate\Support\Collection;


class PostRepository extends BaseRepository implements PostRepositoryInterface
{
	
	public function __construct(Post $model)
	{
		parent::__construct($model);
	}

	public function getAll(): ?Collection
	{
		return $this->model->latest()->get();
	}
}