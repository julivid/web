<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//赛场地图状态配置
$config['match_map_cfg'] = array(
    '0'  =>array('desc'=>'无效状态', 'style'=>'disabled'),
    '1'  =>array('desc'=>'正常', 'style'=>'info'),
    '2'  =>array('desc'=>'已删除', 'style'=>'danger')
);

//赛事类型状态配置
$config['match_type_cfg'] = array(
    '0'  =>array('desc'=>'无效状态', 'style'=>'disabled'),
    '1'  =>array('desc'=>'正常', 'style'=>'info'),
    '2'  =>array('desc'=>'已删除', 'style'=>'danger')
);

//赛事状态配置
$config['match_status_cfg'] = array(
    '0'  =>array('desc'=>'未发布', 'style'=>'disabled'),
    '1'  =>array('desc'=>'报名中', 'style'=>'default'),
    '2'  =>array('desc'=>'进行中', 'style'=>'info'),
    '3'  =>array('desc'=>'已结束', 'style'=>'warning'),
    '4'  =>array('desc'=>'截止报名', 'style'=>'warning'),
    '9'  =>array('desc'=>'已删除', 'style'=>'danger')
);


//参赛卡积分配置
$config['match_ticket_cfg'] = array(
    'jjs'    =>array('score'=>0,  'desc'=>'晋级赛'),
    'csk_1'  =>array('score'=>120000,  'desc'=>'1200资格或120K积分'),
    'csk_2'  =>array('score'=>240000,  'desc'=>'2400资格或240K积分'),
    'csk_3'  =>array('score'=>360000,  'desc'=>'3600资格或360K积分'),
    'csk_4'  =>array('score'=>480000,  'desc'=>'4800资格或480K积分'),
    'csk_6'  =>array('score'=>600000,  'desc'=>'6000资格或600K积分'),
    'cpg_a'  =>array('score'=>1000000, 'desc'=>'10000A组资格或1M积分'),
    'cpg_b'  =>array('score'=>1000000, 'desc'=>'10000B组资格或1M积分'),
    'cpg_c'  =>array('score'=>1000000, 'desc'=>'10000C组资格或1M积分')
);




