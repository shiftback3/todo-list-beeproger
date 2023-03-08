<?php


namespace App\Traits;


use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

trait ManagesResponse
{
    /**
     * success response method.
     *
     * @param $result
     * @param $message
     * @param string $status
     * @return JsonResponse
     */
    public function sendResponse($result, $message, $status = 'success')
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
            'status' => $status,
        ];

        return response()->json($response, 200, ["X-CORRELATION-ID" => request()->header("X-CORRELATION-ID")], JSON_INVALID_UTF8_SUBSTITUTE );
    }

    public function sendResponseCreated($result, $message, $status = 'success')
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
            'status' => $status,
        ];

        return response()->json($response, 201, ["X-CORRELATION-ID" => request()->header("X-CORRELATION-ID")], JSON_INVALID_UTF8_SUBSTITUTE );
    }

    /**
     * return error response.
     *
     * @param $error
     * @param array $errorMessages
     * @param int $code
     * @return JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
            'status' => 'error',
        ];

        if(!empty($errorMessages)){
            $response['errors'] = $errorMessages;
        }

        return response()->json($response, $code, ["X-CORRELATION-ID" => request()->header("X-CORRELATION-ID")], JSON_INVALID_UTF8_SUBSTITUTE );
    }

    /**
     * structured response returned for methods
     *
     * @param $data
     * @param string $error
     * @return mixed
     */
    public function returnResponse($data, $error = [])
    {
        $response['data'] = $data; $response['errors'] = null;
        if ($error) {
            $response['errors'] = $error;
        }
        return $response;
    }

}