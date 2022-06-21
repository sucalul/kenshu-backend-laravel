<?php

namespace App\Services;

use App\Models\ArticleImage as ArticleImageModel;

class ThumbnailService
{
    private ArticleImageModel $articleImageModel;

    public function __construct(ArticleImageModel $articleImageModel)
    {
        $this->articleImageModel = $articleImageModel;
    }

    public function execute($request): array
    {
        return $this->checkThumbnail($request);
    }

    private function checkThumbnail(object $request): array
    {
        $resources = array();
        $thumbnail_resource = '';
        // 更新時かつ、もうすでにarticle_imagesテーブルに存在する画像がサムネイルとして選択されている時この処理は実行される
        if (!is_null($request['id'])
            && !is_null($this->articleImageModel->where('resource_id', $request->get('is-thumbnail'))->first('id'))
        ) {
            $thumbnail_resource = $request->get('is-thumbnail');
        }
        for ($i = 0; $i < count($request->file('upload_image')); $i++) {
            $resource_id = uniqid();
            $ext = $request->file('upload_image')[$i]->getClientOriginalExtension();
            $resource = $resource_id . '.' . $ext;
            $resources[] = $resource;
            if (empty($thumbnail_resource) && $request->has('is-thumbnail') && $request->get('is-thumbnail') == $request->file('upload_image')[$i]->getClientOriginalName()) {
                $thumbnail_resource = $resource;
                $index = array_search($thumbnail_resource, $resources);
                array_splice($resources, $index, 1);
            }
            // upload先指定
            $uploaded_path = 'img/' . $resource;
            // fileの移動
            move_uploaded_file($request->file('upload_image')[$i], $uploaded_path);
        }
        if (empty($thumbnail_resource)) {
            $thumbnail_resource = current($resources);
            $index = array_search($thumbnail_resource, $resources);
            array_splice($resources, $index, 1);
        }
        return [$resources, $thumbnail_resource];
    }
}
