<?php

namespace Modules\Tag\Repositories\Eloquent;

use Log;
use Modules\Core\Constants\CoreConstant;
use Modules\Tag\Jobs\IndexTagElasticsearch;
use Modules\Tag\Repositories\Abstracts\TagRepositoryAbstract;
use Illuminate\Support\Str;

class TagRepository extends TagRepositoryAbstract
{

    public function saveFromNames(array $names = [])
    {
        $ids = [];
        foreach ($names as $name) {
            $name = trim($name);
            $tag = $this->findByAttributes(['name' => $name]);
            if (empty($tag)) {
                $tag = $this->create([
                    'name' => $name,
                    'status' => CoreConstant::STATUS_ACTIVE,
                    'slug' => $this->generateSlug($name)
                ]);
                dispatch(new IndexTagElasticsearch($tag->id));
            }
            $ids[] = $tag->id;
        }
        return $ids;
    }

    private function generateSlug($name)
    {
        $slug = toSlug($name);
        for ($i = 0; $i <= 100; $i++) {
            if (!empty($this->findByAttributes(['slug' => $slug]))) {
                $slug = strtolower($slug . '-' . Str::random(6));
            } else {
                break;
            }
            if ($i == 100) {
                Log::error("Can't generate slug for TAG with name $name");
            }
        }
        return $slug;
    }
}
