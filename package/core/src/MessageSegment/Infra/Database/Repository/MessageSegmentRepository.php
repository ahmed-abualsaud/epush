<?php

namespace Epush\Core\MessageSegment\Infra\Database\Repository;

use Illuminate\Support\Facades\DB;

use Epush\Core\MessageSegment\Infra\Database\Model\MessageSegment;
use Epush\Core\MessageSegment\Infra\Database\Repository\Contract\MessageSegmentRepositoryContract;

class MessageSegmentRepository implements MessageSegmentRepositoryContract
{
    public function __construct(

        private MessageSegment $messageSegment
        
    ) {}

    public function all(int $take): array
    {
        return DB::transaction(function () use ($take) {

            return $this->messageSegment->with(['message'])->latest()->paginate($take)->toArray();

        });
    }

    public function insert(string $messageID, array $messageSegments): array
    {
        return DB::transaction(function () use ($messageID, $messageSegments) {

            $messageSegments = array_map(function ($messageSegment) use ($messageID) {

                return [
                    'message_id' => $messageID,
                    'segment_number' => $messageSegment['number'],
                    'segment_content' => $messageSegment['content'],
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
    
            }, $messageSegments);
    
            $this->messageSegment->insert($messageSegments);
    
            return $this->messageSegment->with(['message'])->where('message_id', $messageID)->get()->toArray();

        });
    }

    public function delete(string $messageID): bool
    {
        return DB::transaction(function () use ($messageID) {

            return $this->messageSegment->where('message_id', $messageID)->delete();

        });
    }

    public function searchColumn(string $column, string $value, int $take = 10): array
    {
        return DB::transaction(function () use ($column, $value, $take) {

            $messageSegment = $this->messageSegment->with(['message']);

            $messageSegment = match ($column)
            {
                "message", "content", "message_content" => 
                $messageSegment->whereHas('message', function ($query) use ($value) {
                    $query->whereRaw("LOWER(content) LIKE ?", ['%' . strtolower($value) . '%']);
                }),

                default => $messageSegment->whereRaw("LOWER($column) LIKE '%" . strtolower($value) . "%'")
            };

            return $messageSegment->latest()->paginate($take)->toArray();
        });
    }
}