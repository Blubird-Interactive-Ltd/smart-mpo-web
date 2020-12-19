<?php

namespace App\Http\Controllers;

use App\models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\models\Feature;
use App\models\SubFeature;
use App\models\RoleFeature;
use App\models\FeatureAction;
use App\Utility;
use Validator;
use Session;
use DB;
use Auth;


class PermissionController extends Controller
{

    /**
     * Product View function.
     */
    public function index()
    {
        if(!Auth::check()){
            return redirect('login');
        }
        if(!Utility::userRolePermission(Session::get('role_id'),34)){
            return redirect('404_page');
        }

        $data['page'] = 'Setting';
        $data['roles'] = UserRole::get();
        $data['features'] = Feature::get();
        foreach($data['features'] as $key=>$feature){
            $sub_features = SubFeature::where('feature_id',$feature->feature_id)->get();
            foreach($sub_features as $key2=>$sub_feature){
                $feature_actions = FeatureAction::where('sub_feature_id',$sub_feature->sub_feature_id)->get();
                $sub_features[$key2]->feature_actions = $feature_actions;
            }
            $data['features'][$key]->sub_features = $sub_features;
        }
        return view('user_role_permission',$data);
        //echo "<pre>"; print_r($data['features']); echo "</pre>";
    }

    public function getSubfeatures(Request $request){
        $subfeatures = SubFeature::where('feature_id',$request->feature_id)->get();
        $options = '<option value="">Select Sub Feature</option>';
        foreach($subfeatures as $subfeature){
            $options .= '<option value="'.$subfeature->sub_feature_id.'">'.$subfeature->sub_feature_name.'</option>';
        }
        return ['status'=>200, 'options'=>$options];
    }

    public function getFeatureActions(Request $request){
        $role_features = RoleFeature::where('role_id',$request->role_id)->where('sub_feature_id',$request->sub_feature_id)->get();
        $role_action_array = array();
        foreach($role_features as $features){
            array_push($role_action_array,$features->action_id);
        }
        $actions = FeatureAction::where('sub_feature_id',$request->sub_feature_id)->get();
        $list = '';
        foreach($actions as $action){
            $list .= '<tr>';
            $list .= '<td><input type="checkbox" name="feature_action[]" id="check_'.$action->feature_action_id.'" value="'.$action->feature_action_id.'"';
            if(in_array($action->feature_action_id,$role_action_array)){
                $list .= 'checked';
            }
            $list .= '></td>';
            $list .= '<td>'.$action->action_name.'</td>';
            $list .= '</tr>';
        }
        return ['status'=>200, 'list'=>$list];
    }

    public function updateRolePermission(Request $request){
        RoleFeature::where('role_id',$request->role_id)
            ->where('feature_id',$request->feature)
            ->where('sub_feature_id',$request->sub_feature)
            ->delete();
        $feature_actions = $request->feature_action;
        if(empty($feature_actions)){
            return ['status'=>200, 'reason'=>'Successfully saved'];
        }
        foreach($feature_actions as $action){
            $roleFeature = New RoleFeature();
            $roleFeature->role_id = $request->role_id;
            $roleFeature->feature_id = $request->feature;
            $roleFeature->sub_feature_id = $request->sub_feature;
            $roleFeature->action_id = $action;
            $roleFeature->save();
        }
        return ['status'=>200, 'reason'=>'Successfully saved'];
    }
}
