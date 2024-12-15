<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Jobapplication;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class JobController extends Controller
{
    public function karir()
    {
        $jobapplications = Jobapplication::latest()->paginate(10)->where('status', 'Aktif');
        return view('company/karir', compact('jobapplications'));
    }
    /*************  ✨ Codeium Command 🌟  *************/
    public function apply(Request $request, $id)
    {

        try {
            $validated = $request->validate([
                'image'                 => 'required|image|mimes:jpeg,png,jpg|max:1024',
                'name'                  => 'required|string|max:255',
                'age'                   => 'required|numeric',
                'gender'                => 'required|string|max:255',
                'email'                 => 'required|email',
                'phone'                 => 'required|numeric|digits_between:1,15',
                'address'               => 'required|string',
                'skill'                 => 'required|array',
                'skill.*'               => 'string|max:255',
                'last_year_education'   => 'required|string',
                'last_level_education'  => 'required|string',
                'last_education'        => 'required|string',
                'last_year_position'    => 'required|array',
                'last_year_position.*'  => 'string|max:255',
                'last_level_position'   => 'required|string',
                'last_company'          => 'required|string',
                'experience'            => 'required|string',
                'salary'                => 'required|numeric',
                'on_working'            => 'required|string|in:yes,no',
                'cv'                    => 'required|mimes:pdf|max:2048',
            ]);
        } catch (ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        if (!$this->createApplicant($validated, $id)) {
            return redirect()->back()->with('error', 'Data gagal disimpan!');
        }
        return redirect()->back()->with('success', 'Your application has been submitted successfully!');
    }

    private function createApplicant($validated, $id)
    {
        $jobApplication = JobApplication::find($id);
        if (!$jobApplication) {
            return response()->json(['error' => 'Data job application tidak ditemukan'], 404);
        }

        try {
            $photoPath = $validated['image']->storeAs('uploads/photos', Str::uuid() . '.' . $validated['image']->extension(), 'public');
            $cvPath = $validated['cv']->storeAs('uploads/cvs', Str::uuid() . '.' . $validated['cv']->extension(), 'public');
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menyimpan file'], 500);
        }

        try {
            $jobApplication->jobapplicants()->create([
                'jobs_id'               => $jobApplication->id,
                'name'                  => $validated['name'],
                'age'                   => $validated['age'],
                'gender'                => $validated['gender'],
                'email'                 => $validated['email'],
                'phone'                 => $validated['phone'],
                'address'               => $validated['address'],
                'skill'                 => implode(', ', $validated['skill']),
                'last_year_education'   => $validated['last_year_education'],
                'last_level_education'  => $validated['last_level_education'],
                'last_education'        => $validated['last_education'],
                'last_year_position'    => implode(' - ', $validated['last_year_position']),
                'last_level_position'   => $validated['last_level_position'],
                'last_company'          => $validated['last_company'],
                'experience'            => $validated['experience'],
                'salary'                => $validated['salary'],
                'on_working'            => $validated['on_working'],
                'image'                 => $photoPath,
                'cv'                    => $cvPath,
                'status'                => 'New',
            ]);

            // Kirim email ke admin
            // $adminEmail = 'admin.jkt@cvdeagroup.com'; // Ganti dengan email admin
            // Mail::to($adminEmail)->send(new JobApplicationNotification($jobApplicant));

            return true;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Data gagal disimpan!');
        }

        return redirect()->back()->with('success', 'Your application has been submitted successfully!');
    }
    /******  1078013a-1b31-4660-9c30-137b15ba1037  *******/
}
