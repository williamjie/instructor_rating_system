<?php
/**
 * Created by PhpStorm.
 * User: 呆呆熊
 * Date: 2018/1/21
 * Time: 22:11
 */
class requestResponse {
    public $Status = "";
    public $StatusCode = "";
    public $Description="";
    public $Error = "";
    public $Ret_Data=array(

    );
}
$retResult = new requestResponse();//一个返回对象
include_once'json_admin.php';
/*//安全起见，将template_new,delete,paper_new.php全部再进行一次管理员是否登录的判断
if (!isset($_SESSION["admin_id"]) || !empty($_SESSION["admin_id"])||
    !isset($_SESSION["admin_name"])||!empty($_SESSION["admin_name"])
)//登陆判断如果没有登陆，是否需要跳转***oauth_log.php
{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="管理员未登录";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信息
}*/

$template=array(
    "title"=>"",
    "c_time"=>"",
    "template_id"=>"",

);
$sql='SELECT * FROM tbl_quetemplate  ';
if($result=mysqli_query($dbcon,$sql))
{
    $retResult->Status= "success";
    $retResult->StatusCode = 1;
    $retResult->Description="";
    $retResult->Error="";
    while($row=$result->fetch_assoc())
    {
        $template['title']=$row['template_title'];
        $template['c_time']=$row['c_time'];
        $template['template_id']=$row['template_id'];
        array_push($retResult->Ret_Data, $template);
    }
    mysqli_free_result($result);
    $dbcon->close();
    exit(json_encode($retResult));

}
else{
    $retResult->Status= "failed";
    $retResult->StatusCode = 0;
    $retResult->Description="";
    $retResult->Error="";
    $retResult->Ret_Data="";
    $dbcon->close();
    exit(json_encode($retResult));//失败返回相关信息

}

