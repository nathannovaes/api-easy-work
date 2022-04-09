<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Services\NoticeService;
use App\Http\Controllers\Controller;
use App\Transformers\NoticeTransformer;

class NoticeController extends Controller
{
    /**
     * @var \App\Services\Notice\NoticeService $noticeService
     */
    protected $noticeService;
    
    public function __construct(NoticeService $noticeService)
    {
        $this->noticeService = $noticeService;
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
            $response = NoticeTransformer::transform(
                $this->noticeService->getAll()
            );

        } catch (\PDOException $e) {
            $code = 500;
            $response = 'Database error: ' . $e->getCode();

        } catch (\Exception $e) {
            $code = 200;
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
            $this->noticeService->create($request->all());
            $code = 200;
            $response = 'Notice created.';

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
            $response = NoticeTransformer::transform([
                $this->noticeService->findById($id)
            ]);
            

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
    public function update(Request $request, $noticeId)
    {
        try {
            $this->noticeService->update($noticeId, $request->all());

            $code = 200;
            $response = 'Notice updated.';

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
    public function destroy(int $noticeId)
    {
        try {
            $this->noticeService->delete($noticeId);

            $code = 200;
            $response = 'Notice deleted.';

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
