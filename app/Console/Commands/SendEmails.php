<?php

namespace App\Console\Commands;

use App\Constants\TableName;
use App\Mail\PostCreated;
use App\Models\Notification;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendEmails extends Command implements ShouldQueue
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails of all the latest subscriptions that have not been sent.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        function field(string $tableName, string $fieldName, ?string $as = null): string
        {
            return $tableName . '.' . $fieldName . ($as ? " AS $as" : '');
        }

        // Check if a post notification has been sent to every subscriber
        // in an optimal way
        $select = [
            field(TableName::POSTS, 'id', 'post_id'),
            field(TableName::SUBSCRIPTIONS, 'id', 'subscription_id'),
        ];

        DB::table(TableName::POSTS)
            ->select($select)
            ->join(
                TableName::WEBSITES,
                field(TableName::WEBSITES, 'id'),
                field(TableName::POSTS, 'website_id')
            )
            ->join(
                TableName::SUBSCRIPTIONS,
                field(TableName::SUBSCRIPTIONS, 'website_id'),
                field(TableName::WEBSITES, 'id')
            )
            // Make sure only notifications that were never sent are processed
            ->where(fn(Builder $query) => $query
                ->selectRaw('COUNT(*)')
                ->from(TableName::NOTIFICATIONS)
                ->whereColumn(field(TableName::NOTIFICATIONS, 'subscription_id'), field(TableName::SUBSCRIPTIONS, 'id'))
                ->whereColumn(field(TableName::NOTIFICATIONS, 'post_id'), field(TableName::POSTS, 'id'))
                ->limit(1)
                , 0)
            // Start with the oldest post
            ->orderBy(field(TableName::POSTS, 'id'))
            ->get()
            // Generate notification records and map them into pipeline
            ->map(function ($row) {
                $notification = new Notification([
                    'subscription_id' => $row->subscription_id,
                    'post_id' => $row->post_id,
                ]);
                $notification->save();
                return $notification;
            })
            // Queue up the notifications as mail
            ->each(function (Notification $notification) {
                Mail::to($notification->load(['subscription', 'subscription.user'])->subscription->user)
                    ->queue(new PostCreated($notification));
            });

        $this->info('The email sending command was successful!');

        return 0;
    }
}
