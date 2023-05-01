<?php

namespace Modules\Users\Http\Controllers\Admin;

use App\Filters\Search;
use App\Helpers\FCMHelper;
use App\Helpers\Translator;
use App\Jobs\AddNotificationsToUsersJob;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Auth\Entities\User;
use Modules\Country\Entities\Nationality;
use Modules\Country\Services\CountryService;
use Modules\Users\DataTransferObjects\CreateUserDto;
use Modules\Users\DataTransferObjects\UpdateUserDto;
use Modules\Users\Http\Requests\Admin\SendTopicRequest;
use Modules\Users\Http\Requests\Admin\StoreCustomerRequest;
use Modules\Users\Http\Requests\Admin\UpdateCustomerRequest;
use Modules\Users\Services\UserService;

class CustomerController extends Controller
{
    public function __construct(private UserService $service)
    {
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $customers = app(Pipeline::class)
            ->send(User::role('customer'))
            ->through([
                Search::class,
            ])
            ->thenReturn()
            ->paginate(15);
        return Inertia::render('Customers/Index', [
            'customers' => $customers,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(User $user)
    {
        $countries = CountryService::getFormatted();
        $nationalities = Translator::getAll(Nationality::class);
        return Inertia::render('Customers/Edit', [
            'user' => $user,
            'countries' => $countries,
            'nationalities' => $nationalities,
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(UpdateCustomerRequest $request, User $user)
    {
        $phone = $request->get('phone');
        $country = CountryService::validate($request->get('country'), $phone);

        $updateUserDto = new UpdateUserDto($request);
        $updateUserDto->setCountry($country);
        $this->service->update(
            $user,
            $updateUserDto,
        );
        return success_update('student.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(User $user)
    {
        $user->delete();
        return success_delete('user.index');
    }
    public function sendNotification(SendTopicRequest $request)
    {
        foreach ($request->only(['ar', 'en']) as $key => $value) {
            AddNotificationsToUsersJob::dispatch(new \Modules\Notification\DataTransferObjects\NotificationDto(
                $value['title'],
                $value['body'],
                'Modules\Notification\Notifications\EventIsAddedNotification',
                $key
            ))->onQueue('notifications');
            FCMHelper::sendTopic($value['title'], $value['body'],  $key);
        }
        return success_add('');
    }
}