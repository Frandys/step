<?php
/**
 * Created by PhpStorm.
 * User: Gurinder
 * Date: 03-09-2018
 * Time: 08:51
 */


function SuccessResponse($reglt,$meg)
{
    $output = array('success' => '1', 'result' =>$reglt,'message'=>$meg, 'error' => null);
    return response()->json($output);
}

function ValidationResponse($ex,$mess)
{
    $output = array('success' => '0', 'result' => null,  'message' => $mess ,'error' => $ex);
    return response()->json($output);
}

function FailResponse($meg)
{
    $output = array('success' => '0', 'result' => null, 'message' => $meg,'error' => null);
    return response()->json($output);
}