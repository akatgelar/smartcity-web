<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResource extends JsonResource
{
    //define properti
    public $status;
    public $statusCode;
    public $message;
    public $data;
    public $metadata;

    /**
     * __construct
     *
     * @param  mixed $status
     * @param  mixed $message
     * @param  mixed $resource
     * @return void
     */
    public function __construct($statusCode, $status, $message, $data, $metadata)
    {
        parent::__construct($data);
        $this->statusCode  = $statusCode;
        $this->status  = $status;
        $this->message = $message;
        $this->data = $data;
        $this->metadata = $metadata;
    }

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'status'   => $this->status,
            'message'   => $this->message,
            'data'      => $this->data,
            'metadata'      => $this->metadata
        ];
    }

    /**
     * Transform the resource into an response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toResponse($request)
    {
        return parent::toResponse($request)->setStatusCode($this->statusCode);
    }
}
