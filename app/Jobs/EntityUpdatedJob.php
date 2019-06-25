<?php


namespace App\Jobs;


use App\Models\Entity;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EntityUpdatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var int
     */
    public $entityId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Entity $entity)
    {
        // Can't save the entity directly into the job because of the child() function not returning a
        // string? Maybe something to do with the to array part of the queue.
        $this->entityId = $entity->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /** @var Entity $entity */
        $entity = Entity::findOrFail($this->entityId);

        // Invalid cache
        cache()->forget($entity->child->tooltipCacheKey());

        if ($entity->type == 'tag') {
            foreach ($entity->child->allChildren()->get() as $child) {
                cache()->forget($child->child->tooltipCacheKey());
            }
        } elseif ($entity->type == 'family') {
            foreach ($entity->child->members as $child) {
                cache()->forget($child->tooltipCacheKey());
            }
        }
    }

    public function failure()
    {
        // Sentry will handle this
    }

}