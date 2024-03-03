<?php

namespace Noorfarooqy\SchoolModule\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Noorfarooqy\NoorAuth\Services\NoorServices;
use Noorfarooqy\SchoolModule\DataModels\SchoolBranches;
use Noorfarooqy\SchoolModule\DataModels\Schools;
use Noorfarooqy\SchoolModule\Events\NewSchoolRegistered;

class SchoolServices extends NoorServices
{

    public $has_failed;
    public function addNewSchool($request)
    {
        $this->request = $request;
        $this->rules = [
            'school_id' => 'nullable|integer|exists:scm_schools,id',
            'type' => 'required|string|in:Day,Boarding,Both',
            'name' => 'required|string|unique:scm_schools|min:10|max:150',
            'slogan' => 'nullable|string|min:10|max:150',
            'logo' => 'nullable|file|mimes:png,jpeg,jpg',
            'email' => 'required|email|unique:scm_schools',
            'telephone' => 'required|numeric|unique:scm_schools',
            'principle' => 'nullable|string|min:5|max:150',
            'signature' => 'nullable|file|mimes:png,jpeg,jpg',
            'is_active' => 'nullable|boolean|in:0,1'
        ];

        $this->customValidate();

        if ($this->has_failed) {
            return $this->getResponse();
        }
        $data = $this->validatedData();

        $user = $request->user();
        if ($user?->id == null) {
            $this->setError('User authentication missing');
            return $this->getResponse();
        }
        $user = User::find($user->id);
        if ($user->hasSchool && !isset($data['school_id'])) {
            $this->setError('School has already been registered under the user');
            return $this->getResponse();
        }

        try {
            DB::beginTransaction();
            if ($request->logo != null) {
                $logo_path = "/scm/logos/";
                $logo = Storage::disk('public')->put($logo_path, $data['logo']);
                $data['logo'] = $logo;
            }

            if ($request->signature != null) {
                $filesystem =  Storage::disk('public');
                $signature_path = "/scm/signatures/";
                $signature = $filesystem->put($signature_path, $data['signature']);
                $data['signature_path'] =  $signature;
                unset($data['signature']);
            }
            if (isset($data['school_id'])) {
                $data['id'] = $data['school_id'];
                unset($data['school_id']);
            }

            $data['owner'] = $user->id;
            if (isset($data['id'])) {
                $school = Schools::find($data['id']);
                $school->update($data);
            } else
                $school = Schools::create($data);

            $branch = SchoolBranches::create([
                'school' => $school->id,
                'branch' => $school->name . ' - Main',
                'address' => $request->address,
                'manager' => $request->address,
                'signature' => isset($data['signature_path']) ? $data['signature_path'] : null,
            ]);

            NewSchoolRegistered::dispatch($school);
            $this->setError('', 0);
            $this->setSuccess('success');
            DB::commit();
            return $this->getResponse($school);
        } catch (\Throwable $th) {
            if (isset($data['logo'])) {
                unlink(Storage::disk('public')->path($data['logo']));
            }

            if (isset($data['signature'])) {
                unlink(Storage::disk('public')->path($data['signature_path']));
            }

            $this->setError($th->getMessage());
            return $this->getResponse();
        }
    }


    public function getSchoolDetails($request)
    {
        $this->request = $request;

        $user = $request->user();
        if (!$user) {
            $this->setError('User authentication missing');
            return $this->getResponse();
        }

        $school = Schools::where('owner', $user->id)->with('Branches')->get()->first();

        $this->setError('', 0);
        $this->setSuccess('success');
        return $this->getResponse($school);
    }
}
