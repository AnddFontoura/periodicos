<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoryApiController extends Controller
{
    public function delete(Request $request): JsonResponse
    {
        $this->validate($request, [
            'categoryId' => 'required|int'
        ]);

        $category = Category::where('id', $request->post('categoryId'))->first();

        if (empty($category)) {
            throw new Exception (
                'Category not founded or already deleted',
                Response::HTTP_BAD_REQUEST
            );
        }

        $category->delete();
        $category->save();

        return response()->json("Category deleted with success",Response::HTTP_ACCEPTED);
    }
}
