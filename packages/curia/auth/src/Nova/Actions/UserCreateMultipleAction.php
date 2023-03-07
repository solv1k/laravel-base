<?php

namespace Curia\Auth\Nova\Actions;

use Curia\Auth\Enums\User\UserTypeEnum;
use Curia\Auth\Models\User\User;
use Curia\Download\Enums\CuriaDownloadCollectionEnum;
use Curia\Download\Models\CuriaDownload;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class UserCreateMultipleAction extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Извлекает все email построчно в массив.
     *
     * @param string $emailsRawString
     * @return array
     */
    protected function extractEmailsArray(string $emailsRawString): array
    {
        // this regex handles more email address formats like a+b@google.com.sg, and the i makes it case insensitive
        $pattern = '/[a-z0-9_\-\+]+@[a-z0-9\-]+\.([a-z]{2,3})(?:\.[a-z]{2})?/i';

        // preg_match_all returns an associative array
        preg_match_all($pattern, $emailsRawString, $matches);

        return $matches[0] ?? [];
    }

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        $authData = [];
        $startIncrement = User::count();
        $time = time();
        $filename = config('curia.auth.users-create-multiple.filename-prefix') . 
                $time . config('curia.auth.users-create-multiple.file-extension');

        try {
            DB::beginTransaction();

            // Создаем новых юзеров по списку почт
            foreach ($this->extractEmailsArray($fields->emails ?? '') as $email) {
                $email = trim($email);
                $password = \Str::random(15);
    
                User::create([
                    'name' => config('curia.auth.users-create-multiple.username-prefix') . ++$startIncrement,
                    'email' => $email,
                    'password' => Hash::make($password),
                    'type' => $fields->type
                ]);
    
                $authData[] = implode(':', [$email, $password]);
            }

            // Сохраняем файл с кредами созданных юзеров
            if (!empty($authData)) {
                $content = implode(PHP_EOL, $authData);

                // Пробуем сохранить файл в хранилище
                if (!Storage::put($filename, $content)) {
                    DB::rollBack();
                    return Action::danger(__('curia.auth::nova.users-create-multiple.cant-upload-file'));
                }
    
                /**
                 * @var CuriaDownload
                 */
                $nd = CuriaDownload::create([
                    'name' => __('curia.auth::nova.users-create-multiple.filename', compact('time')),
                    'filename' => $filename
                ]);
    
                $nd->addMediaFromDisk($filename)
                    ->toMediaCollection(CuriaDownloadCollectionEnum::FILES->value);
            }

            DB::commit();

            return Action::redirect(curia_download_link(
                curiaDownloadId: $nd->id, 
                mediaCollectionName: CuriaDownloadCollectionEnum::FILES->value, 
                fileIndex: $nd->files()->count()
            ));

        } catch (\Throwable $e) {
            DB::rollBack();

            throw $e;
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            Textarea::make('Emails')
                ->rules('required'),

            Select::make('Type')
                ->rules('required')
                ->options(UserTypeEnum::array(useLabels: true)),
        ];
    }
}
