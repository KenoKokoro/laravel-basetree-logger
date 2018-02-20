<?php


namespace BaseTree\Modules\Log;


use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class BaseLogger
{
    protected function buildAttributes(Response $response, Request $request)
    {
        return [
            'client' => $request->getClientIp(),
            'url' => $request->fullUrl(),
            'method' => $request->getMethod(),
            'requestHeaders' => $request->headers->all(),
            'requestBody' => $this->requestBody($request->all()),
            'responseHeaders' => $response->headers->all(),
            'responseBody' => $this->responseBody($response->getContent()),
            'code' => $response->getStatusCode(),
        ];
    }

    protected function responseBody(string $content)
    {
        $object = json_decode($content);
        $array = json_decode($content, true);
        if ( ! empty($array['data'])) {
            $array['data'] = $this->minimizeArraysInBody($object->data);
        }

        return $array;
    }

    protected function requestBody($data)
    {
        foreach ($data as $key => $value) {
            if ($value instanceof UploadedFile) {
                $value = json_encode($value, true);
            }
            $body[$key] = $value;
        }

        return $body ?? [];
    }

    protected function minimizeArraysInBody($data)
    {
        if (is_string($data) or is_int($data)) {
            return $data;
        }

        if (is_array($data)) {
            return count($data);
        }

        if (request()->has('datatable') and ! empty($data->original->data)) {
            $data->original->data = $this->minimizeDatatableResponse($data);
        }

        return $this->minimizedResponse($data);
    }

    private function minimizeDatatableResponse($data)
    {
        return $this->minimizeArraysInBody($data->original->data ?? []);
    }

    private function minimizedResponse($data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $value = count($value);
            }
            $buildedData[$key] = $value;
        }

        return $buildedData ?? [];
    }
}