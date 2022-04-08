<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\CategoryService;
use App\Http\Controllers\Controller;


class CategoryController extends Controller
{
    /**
     * @var \App\Services\Category\CategoryService $categoryService
     */
    protected $categoryService;

    /**
     * @var \App\Services\QrCode\QrCodeService $qrCodeService
     */
    protected $qrCodeService;
    
    public function __construct(
        CategoryService $categoryService
    )
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return int $sectionId
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $code = 200;
            $response = $this->categoryService->getAll();

        } catch (\PDOException $e) {
            $code = 500;
            $response = 'Database error: ' . $e->getCode();

        } catch (\Exception $e) {
            $code = $e->getCode();
            $response = $e->getMessage();

        }

        return response()->json([
            'code' => $code,
            'response' => $response,
        ], $code); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $this->categoryService->create($request->all());
            $code = 200;
            $response = 'Category created.';

        } catch (\PDOException $e) {
            $code = 500;
            $response = 'Database error: ' . $e->getCode();

        } catch (\Exception $e) {
            $code = $e->getCode();
            $response = $e->getMessage();

        }

        return response()->json([
            'code' => $code,
            'response' => $response,
        ], $code); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $code = 200;
            $response = $this->categoryService->findById($id);

        } catch (\PDOException $e) {
            $code = 500;
            $response = 'Database error: ' . $e->getCode();

        } catch (\Exception $e) {
            $code = $e->getCode();
            $response = $e->getMessage();

        }

        return response()->json([
            'code' => $code,
            'response' => $response,
        ], $code); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $categoryId)
    {
        try {
            $this->categoryService->update($categoryId, $request->all());

            $code = 200;
            $response = 'Category updated.';

        } catch (\PDOException $e) {
            $code = 500;
            $response = 'Database error: ' . $e->getCode();

        } catch (\Exception $e) {
            $code = $e->getCode();
            $response = $e->getMessage();

        }

        return response()->json([
            'code' => $code,
            'response' => $response,
        ], $code);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $categoryId)
    {
        try {
            $this->categoryService->delete($categoryId);

            $code = 200;
            $response = 'Category deleted.';

        } catch (\PDOException $e) {
            $code = 500;
            $response = 'Database error: ' . $e->getCode();

        } catch (\Exception $e) {
            $code = $e->getCode();
            $response = $e->getMessage();

        }

        return response()->json([
            'code' => $code,
            'response' => $response,
        ], $code);
    }

}
