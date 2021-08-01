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

        $subCategory = Articles::where('id', $request->post('articleId'))->first();

        if (empty($subCategory)) {
            throw new Exception (
                'Article not founded or already deleted',
                Response::HTTP_BAD_REQUEST
            );
        }

        $subCategory->delete();
        $subCategory->save();

        return response()->json("Article deleted with success",Response::HTTP_ACCEPTED);
    }

}
