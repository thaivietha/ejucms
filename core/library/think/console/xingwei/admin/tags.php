<?php

// 应用行为扩展定义文件
return [
    // 模块初始化
    'module_init'  => [
        'think\\console\\xingwei\\admin\\ModuleInit',
    ],
    // 操作开始执行
    'action_begin' => [
        'think\\console\\xingwei\\admin\\ActionBegin',
    ],
    // 视图内容过滤
    'view_filter'  => [],
    // 日志写入
    'log_write'    => [],
    // 应用结束
    'app_end'      => [
        'think\\console\\xingwei\\admin\\AppEnd',
    ],
];
