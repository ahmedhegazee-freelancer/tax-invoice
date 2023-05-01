<?php

namespace Modules\Users\Http\Controllers\Admin;

use App\Helpers\Translator;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Modules\Auth\Entities\User;
use Modules\Users\Http\Requests\Admin\StoreAdminRequest;
use Modules\Users\Services\UserService;
use Illuminate\Support\Str;
use Modules\Country\Entities\Nationality;
use Modules\Country\Services\CountryService;
use Modules\Users\DataTransferObjects\CreateUserDto;
use Modules\Users\DataTransferObjects\UpdateUserDto;
use Modules\Users\Http\Requests\Admin\UpdateAdminRequest;

class UsersController extends Controller
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
        $users = User::role('admin')->where('id', '>', 1)->paginate(15);
        return Inertia::render('Users/Index', [
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $countries = CountryService::getFormatted();
        $nationalities = Translator::getAll(Nationality::class);
        $roles = $this->service->getFormattedRoles();
        return Inertia::render('Users/Create', [
            'roles' => $roles,
            'countries' => $countries,
            'nationalities' => $nationalities,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(StoreAdminRequest $request)
    {
        $phone = $request->get('phone');
        $country = CountryService::validate($request->get('country'), $phone);

        $createUserDto = new CreateUserDto($request);
        $createUserDto->setCountry($country);
        $this->service->createAdmin(
            $createUserDto,
            $request->roles
        );
        return success_add('user.index');
    }


    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(User $user)
    {
        $roles = $this->service->getFormattedRoles();
        $user->load('roles');
        $user->formatted_roles = $user->roles->map(fn ($role) => ['id' => $role->id])->keyBy('id');
        unset($user->roles);
        $countries = CountryService::getFormatted();
        $nationalities = Translator::getAll(Nationality::class);
        return Inertia::render('Users/Edit', [
            'roles' => $roles,
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
    public function update(UpdateAdminRequest $request, User $user)
    {
        $phone = $request->get('phone');
        $country = CountryService::validate($request->get('country'), $phone);

        $updateUserDto = new UpdateUserDto($request);
        $updateUserDto->setCountry($country);
        $this->service->updateAdmin(
            $user,
            $updateUserDto,
            $request->roles
        );
        return success_update('user.index');
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
}