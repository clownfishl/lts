<?php
require('./Medoo.php');

$m = new Medoo([
    // required
	'database_type' => 'mysql',
	'database_name' => 'qdm166276650_db',
	'server' => 'qdm166276650.my3w.com',
	'username' => 'qdm166276650',
	'password' => 'ln121300', 
	// [optional]
	'charset' => 'utf8',
	'port' => 3306,
]);

$opt = isset($_POST['opt'])?$_POST['opt']:'';


$names = ['欣才前台','前台妹妹','前台阿姨','悟空','八戒','靖哥哥','龙儿','华仔','丑的一米','帅八代','丑八代','欣才一哥','爆菊','内裤超人'];

$res = [];
switch($opt){
    case 'init' :
        $res = [
            'err'=>0,
            'data'=>[
                'uid'=>uniqid()
            ],
            'msg'=>''
        ];     
    break;

    case 'getdata':
        $res = $m->select('chart','*',[
            'LIMIT'=>10,
            'ORDER'=>['id'=>'DESC']
        ]);
        $res = [
            'err'=>0,
            'data'=>array_reverse($res),
            'msg'=>''
        ];     
    break;

    case 'add':
        $m->insert('chart',[
            'content'=>$_POST['data']['content'],
            'uname'=>$_POST['data']['uname'],
            'nick'=>!$_POST['data']['nick']?$names[array_rand($names)]:$_POST['data']['nick'],
            'ctime'=>date('Y-m-d H:i:s'),
            'ip'=>$_SERVER['REMOTE_ADDR']
        ]);
        $res = [
            'err'=>0,
            'data'=>[
                'id'=>$m->id(),
            ],
            'msg'=>''
        ];     
    break;
    case 'list':
        $data = $m->select('chart','*',[
            'ORDER'=>['id'=>'DESC'],
            'LIMIT'=>10
        ]);
        $res = [
            'err'=>0,
            'data'=>array_reverse($data),
            'msg'=>''
        ];  
    break;
}

echo json_encode($res);