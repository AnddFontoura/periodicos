<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\SubCategory as AppSubCategory;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubCategoryApiController extends Controller
{
    public function delete(Request $request): JsonResponse
    {
        $this->validate($request, [
            'subCategoryId' => 'required|int'
        ]);

        $subCategory = AppSubCategory::where('id', $request->post('subCategoryId'))->first();

        if (empty($subCategory)) {
            throw new Exception (
                'Subcategory not founded or already deleted',
                Response::HTTP_BAD_REQUEST
            );
        }

        $subCategory->delete();
        $subCategory->save();

        return response()->json("Subcategory deleted with success",Response::HTTP_ACCEPTED);
    }
}
