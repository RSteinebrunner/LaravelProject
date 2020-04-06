<?php

namespace App\Http\Controllers;
/*
 Project name/Version: LaravelCLC Version: 6
 Module name: JobRestModule
 Authors: Jack Setrak
 Date: 04/03/2020
 Synopsis: Rest service that will return eiteher all jobs saved in DB in Json format or one single desired job in the same Json format
 Version#: 1
 References: N/A
 */
use Illuminate\Http\Request;
use Exception;
use App\Services\Business\JobPostingService;
use App\Models\DTO;

class jobsRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            //call service to get all jobs'
            $service = new JobPostingService();
            $jobs = $service->findAllJobs();
            //create dto
            $dto = new DTO(0, "OK", $jobs);
            //serialize the dto to JSON
            $json = json_encode($dto);
            
            return $json;
            
        } catch (Exception $e1) {
            
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified job.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            //call service to get job by id
            $service = new JobPostingService();
            $job = $service->findJobById($id);
            //create dto
            if($job == null){
                $dto = new DTO(-1, "Job not found", "");
            }else{
                $dto = new DTO(0, "OK", $job);
            }
            //serialize the dto to JSON
            $json = json_encode($dto);
            
            return $json;
            
        } catch (Exception $e1) {
            
            $dto = new DTO(-2, $e1->getMessage(), "");
            return json_encode($dto);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
