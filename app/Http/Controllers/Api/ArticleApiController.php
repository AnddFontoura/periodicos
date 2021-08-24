<?php

namespace App\Http\Controllers\Api;

use App\Articles;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleApiController extends Controller
{
    public function delete(Request $request): JsonResponse
    {
        $this->validate($request, [
            'articleId' => 'required|int'
        ]);

        $article = Articles::where('id', $request->post('articleId'))->first();

        if (empty($article)) {
            throw new Exception (
                'Article not founded or already deleted',
                Response::HTTP_BAD_REQUEST
            );
        }

        $article->delete();
        $article->save();

        return response()->json("Article deleted with success",Response::HTTP_ACCEPTED);
    }

}
