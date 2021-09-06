<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Page;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PageApiController extends Controller
{
    public function delete(Request $request): JsonResponse
    {
        $this->validate($request, [
            'articleId' => 'required|int'
        ]);

        $page = Page::where('id', $request->post('pageId'))->first();

        if (empty($page)) {
            throw new Exception (
                'Page not founded or already deleted',
                Response::HTTP_BAD_REQUEST
            );
        }

        $page->delete();
        $page->save();

        return response()->json("Page deleted with success",Response::HTTP_ACCEPTED);
    }
}
