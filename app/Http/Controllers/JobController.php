<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;
use App\User;
use App\PrimarySkills;
use App\SecondarySkills;
use App\Platform;
use App\AdditionalSkills;
use Schema;

class JobController extends Controller
{
    // Add Primary Skill
    public function addPrimarySkill(Request $request) {
    	if(!$request->skill) {
    		return Response::json([
                "status" => "ERROR",
                "response" => "Invalid parameters.",
                "message" => "Parameter skill is required"
            ], 400);
    	}
    	$user = User::where('user_token', $request->token)->where('role', 2)->first();
    	if(!$user) {
            return Response::json([
                "status" => "ERROR",
                "response" => "Add primary skill failed.",
                "message" => "Users does not exist or is not allowed to add Job information."
            ], 400);
        }

        // Checks if same skill is previously added or not
        $skill = PrimarySkills::where('recruiter_id', $user->id)->where('skill', $request->skill)->first();
    	if($skill) {
    		return Response::json([
                "status" => "ERROR",
                "response" => "Add primary skill failed.",
                "message" => "Can not add previously added skill again"
            ], 400);
    	}		

        // Insert skill into database
        $skill = PrimarySkills::create(array(
        		"recruiter_id" => $user->id,
        		"skill" => $request->skill
        	)); 
        $skill->save();

        // Reply
        return Response::json([
            "status" => "OK",
            "response" => $skill
        ], 200);
    }

    // Retrive Primary Skills
    public function getPrimarySkills(Request $request) {
		$skills = User::where('user_token', $request->token)
					->where('role', 2)
					->with('primarySkills')
					->first();

		if(!$skills) {
			return Response::json([
                "status" => "ERROR",
                "response" => "Get primary skills failed.",
                "message" => "Users does not exist or is not allowed to retrive Job information"
            ], 400);
		}

		$json = array();
		foreach ($skills->primarySkills as $x) {
			$json[] = [ $x->skill ];
		}
		// Reply
        return Response::json([
            "status" => "OK",
            "response" => $json
        ], 200);

    }

    // Delete Primary Skill
    public function deletePrimarySkill(Request $request) {
        if(!$request->skill) {
            return Response::json([
                "status" => "ERROR",
                "response" => "Invalid parameters."
            ], 400);
        }
        $user = User::where('user_token', $request->token)->first();
        if(!$user) {
            return Response::json([
                "status" => "ERROR",
                "response" => "User doesn't exist"
            ], 400);
        }
        $skill = PrimarySkills::where('recruiter_id',$user->id)->where('skill',$request->skill)->delete();
        // Reply
        return Response::json([
            "status" => "OK",
            "response" => $skill
        ], 200);
    }

    // Add Secondary Skill
    public function addSecondarySkill(Request $request) {
		if(!$request->skill) {
    		return Response::json([
                "status" => "ERROR",
                "response" => "Invalid parameters.",
                "message" => "Parameter skill is required"
            ], 400);
    	}
    	$user = User::where('user_token', $request->token)->where('role', 2)->first();
    	if(!$user) {
            return Response::json([
                "status" => "ERROR",
                "response" => "Add secondary skill failed.",
                "message" => "Users does not exist or is not allowed to add Job information."
            ], 400);
        }

        // Checks if same skill is previously added or not
        $skill = SecondarySkills::where('recruiter_id', $user->id)->where('skill', $request->skill)->first();
    	if($skill) {
    		return Response::json([
                "status" => "ERROR",
                "response" => "Add secondar skill failed.",
                "message" => "Can not add previously added skill again"
            ], 400);
    	}		

        // Insert skill into database
        $skill = SecondarySkills::create(array(
        		"recruiter_id" => $user->id,
        		"skill" => $request->skill
        	)); 
        $skill->save();

        // Reply
        return Response::json([
            "status" => "OK",
            "response" => $skill
        ], 200);
    }

    // Retrive Secondary Skills
    public function getSecondarySkills(Request $request) {
		$skills = User::where('user_token', $request->token)
					->where('role', 2)
					->with('secondarySkills')
					->first();

		if(!$skills) {
			return Response::json([
                "status" => "ERROR",
                "response" => "Get secondary skills failed.",
                "message" => "Users does not exist or is not allowed to retrive Job information"
            ], 400);
		}

		$json = array();
		foreach ($skills->secondarySkills as $x) {
			$json[] = [ $x->skill ];
		}
		// Reply
        return Response::json([
            "status" => "OK",
            "response" => $json
        ], 200);

    }

    // Delete Secondary Skill
    public function deleteSecondarySkill(Request $request) {
        if(!$request->skill) {
            return Response::json([
                "status" => "ERROR",
                "response" => "Invalid parameters."
            ], 400);
        }
        $user = User::where('user_token', $request->token)->first();
        if(!$user) {
            return Response::json([
                "status" => "ERROR",
                "response" => "User doesn't exist"
            ], 400);
        }
        $skill = SecondarySkills::where('recruiter_id',$user->id)->where('skill',$request->skill)->delete();
        // Reply
        return Response::json([
            "status" => "OK",
            "response" => $skill
        ], 200);
    }

    // Add Platform
    public function addPlatform(Request $request) {
		if(!$request->platform) {
    		return Response::json([
                "status" => "ERROR",
                "response" => "Invalid parameters.",
                "message" => "Parameter platfrom is required"
            ], 400);
    	}
    	$user = User::where('user_token', $request->token)->where('role', 2)->first();
    	if(!$user) {
            return Response::json([
                "status" => "ERROR",
                "response" => "Add platform failed.",
                "message" => "Users does not exist or is not allowed to add Job information."
            ], 400);
        }

        // Checks if same platform is previously added or not
        $platform = Platform::where('recruiter_id', $user->id)->where('platform', $request->platform)->first();
    	if($platform) {
    		return Response::json([
                "status" => "ERROR",
                "response" => "Add platform failed.",
                "message" => "Can not add previously added platform again"
            ], 400);
    	}		

        // Insert platform into database
        $platform = Platform::create(array(
        		"recruiter_id" => $user->id,
        		"platform" => $request->platform
        	)); 
        $platform->save();

        // Reply
        return Response::json([
            "status" => "OK",
            "response" => $platform
        ], 200);
    }

    // Retrive Platforms
    public function getPlatforms(Request $request) {
		$platforms = User::where('user_token', $request->token)
					->where('role', 2)
					->with('platform')
					->first();

		if(!$platforms) {
			return Response::json([
                "status" => "ERROR",
                "response" => "Get platforms failed.",
                "message" => "Users does not exist or is not allowed to retrive Job information"
            ], 400);
		}

		$json = array();
		foreach ($platforms->platform as $x) {
			$json[] = [ $x->platform ];
		}
		// Reply
        return Response::json([
            "status" => "OK",
            "response" => $json
        ], 200);
    }

    // Delete Platform
    public function deletePlatform(Request $request) {
        if(!$request->platform) {
            return Response::json([
                "status" => "ERROR",
                "response" => "Invalid parameters."
            ], 400);
        }
        $user = User::where('user_token', $request->token)->first();
        if(!$user) {
            return Response::json([
                "status" => "ERROR",
                "response" => "User doesn't exist"
            ], 400);
        }
        $platform = Platform::where('recruiter_id',$user->id)->where('platform',$request->platform)->delete();
        // Reply
        return Response::json([
            "status" => "OK",
            "response" => $platform
        ], 200);
    }

    // Add Platform
    public function addAdditionalSkill(Request $request) {


    	if($request->gpa_required && $request->gpa_required > 0 && !$request->gpa_threshold) {
    		return Response::json([
                "status" => "ERROR",
                "response" => "Invalid parameters."
            ], 400);
    	}

    	$user = User::where('user_token', $request->token)->where('role', 2)->first();
    	if(!$user) {
            return Response::json([
                "status" => "ERROR",
                "response" => "Add Additional Skills failed.",
                "message" => "Users does not exist or is not allowed to add Job information."
            ], 400);
        }
            
        $skill = AdditionalSkills::where('recruiter_id', $user->id)->first();
        if(!$skill) {
            $skill = AdditionalSkills::create(array("recruiter_id" => $user->id));
            $skill = AdditionalSkills::where('recruiter_id', $user->id)->first();
        }
        $skill->fill($request->all());
    	if($request->gpa_required && $request->gpa_required > 0)
            $skill->gpa_required = 1;
        else
            $skill->gpa_threshold = '0.0';
	    $skill->save();
        // Reply
        return Response::json([
            "status" => "OK",
            "response" => $skill
        ], 200);
    }

    // Retrive Platforms
    public function getAdditionalSkill(Request $request) {
		$skills = User::where('user_token', $request->token)
					->where('role', 2)
					->with('additionalSkills')
					->first();

		if(!$skills) {
			return Response::json([
                "status" => "ERROR",
                "response" => "Get additional skills failed.",
                "message" => "Users does not exist or is not allowed to retrive Job information"
            ], 400);
		}

		// Reply
        return Response::json([
            "status" => "OK",
            "response" => $skills->additionalSkills
        ], 200);
    }

    // Delete Platform
    public function deleteAdditionalSkill(Request $request) {
    
    }

    // Retrive Job
	public function getJob(Request $request) {
        $job = User::where('user_token', $request->token)
                    ->where('role', 2)
                    ->with('primarySkills')
                    ->with('secondarySkills')
                    ->with('platform')
                    ->with('additionalSkills')
                    ->first();
        if(!$job) {
            return Response::json([
                "status" => "ERROR",
                "response" => "Get job description failed.",
                "message" => "Users does not exist or is not allowed to retrive Job description"
            ], 400);
        }

        // Reply
        return Response::json([
            "status" => "OK",
            "response" => $job
        ], 200);
    }

    // Delete Job
    public function deleteJob(Request $request) {
        
    }    
}
