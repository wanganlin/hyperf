<?php

declare(strict_types=1);

namespace App\Http;

use Hyperf\Contract\SessionInterface;
use Hyperf\HttpServer\Contract\RequestInterface as HttpRequest;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Trait JsonResponse
 * @package App\Http
 */
trait JsonResponse
{
    /**
     * @var int
     */
    protected $errorCode = 0;

    /**
     * @return int
     */
    protected function getErrorCode(): int
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     * @return $this
     */
    protected function setErrorCode(int $errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * 返回封装后的API数据到客户端
     * @access protected
     * @param mixed $data 要返回的数据
     * @param array $headers 发送的Header信息
     * @return ResponseInterface
     */
    protected function succeed($data, array $headers = [])
    {
        $response = $this->response([
            'status' => 'success',
            'data' => $data,
        ]);

        foreach ($headers as $header) {
            $response = $response->withHeader(key($header), value($header));
        }

        return $response;
    }

    /**
     * 返回异常数据到客户端
     * @param $message
     * @return ResponseInterface
     */
    protected function failed($message)
    {
        return $this->response([
            'status' => 'failed',
            'errors' => [
                'code' => $this->getErrorCode(),
                'message' => $message,
            ],
        ]);
    }

    /**
     * 返回 Json 数据格式
     * @param $data
     * @param $name
     * @return ResponseInterface
     */
    protected function response($data, $name = 'X-Client-Id')
    {
        $request = app(HttpRequest::class);
        $response = app(HttpResponse::class);
        $session = app(SessionInterface::class);

        $clientId = $request->header($name);
        if (empty($clientId)) {
            $clientId = $session->getId();
        }

        return $response->json($data)->withHeader($name, $clientId);
    }
}