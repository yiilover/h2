<?php
return array(
//��վ·��
'web_path' => '/',
//Session����
'session_storage' => 'mysql',
'session_ttl' => 1800,
'session_savepath' => CACHE_PATH.'sessions/',
'session_n' => 0,
//Cookie����
'cookie_domain' => '', //Cookie ������
'cookie_path' => '/', //Cookie ����·��
'cookie_pre' => 'wCGkl_', //Cookie ǰ׺��ͬһ�����°�װ����ϵͳʱ�����޸�Cookieǰ׺
'cookie_ttl' => 0, //Cookie �������ڣ�0 ��ʾ�����������
//ģ���������
'tpl_root' => 'templates/', //ģ�屣������·��
'tpl_name' => 'default', //��ǰģ�巽��Ŀ¼
'tpl_css' => 'default', //��ǰ��ʽĿ¼
'tpl_referesh' => 1,
'tpl_edit'=>1,//�Ƿ��������߱༭ģ��
//�����������
'upload_path' => 'uploadfile/',
'upload_url' => 'http://localhost:7030/uploadfile/', //����·��
'attachment_stat' => '0',//�Ƿ��¼����ʹ��״̬ 0 ͳ�� 1 ͳ�ƣ� ע��: �����ܻ���ط���������

'js_path' => 'http://localhost:7030/statics/js/', //CDN JS
'css_path' => 'http://localhost:7030/statics/css/', //CDN CSS
'img_path' => 'http://localhost:7030/statics/images/', //CDN img
'app_path' => 'http://localhost:7030/',//��̬�������õ�ַ
'house_path' => 'http://localhost:7030/house/',
'esf_path' => 'http://localhost:7030/esf/',
'member_path' => 'http://localhost:7030/my',
'tuan_path' => 'http://localhost:7030/tuan/',
'bbs_path' => '',

'charset' => 'gbk', //��վ�ַ���
'timezone' => 'Etc/GMT-8', //��վʱ����ֻ��php 5.1���ϰ汾��Ч����Etc/GMT-8 ʵ�ʱ�ʾ���� GMT+8
'debug' => 0, //�Ƿ���ʾ������Ϣ
'admin_log' => 1, //�Ƿ��¼��̨������־
'errorlog' => 1, //1�����������־�� cache/error_log.php | 0����ҳ��ֱ����ʾ
'gzip' => 1, //�Ƿ�Gzipѹ�������
'relative_path' => 0,//�Ƿ���URL��Ե�ַ
'auth_key' => 'qyX9dqodlX2XIuiPWNCf', //��Կ
'lang' => 'zh-cn',  //��վ���԰�
'lock_ex' => '1',  //д�뻺��ʱ�Ƿ����ļ��������������ʹ��nfs����رգ�

'admin_founders' => '1', //��վ��ʼ��ID�����ID���ŷָ�
'execution_sql' => 0, //EXECUTION_SQL

'phpsso' => '1',	//�Ƿ�ʹ��phpsso
'phpsso_appid' => '1',	//Ӧ��id	
'phpsso_api_url' => 'http://localhost:7030/house5_server',	//�ӿڵ�ַ
'phpsso_auth_key' => 'buf9iGIhI4GzpcRDcxIwHL1cYyV6nSaK', //������Կ
'phpsso_version' => '1', //phpsso�汾

'html_root' => '/news',//���ɾ�̬�ļ�·��
'safe_card'=>'1',//�Ƿ����ÿ��

'connect_enable' => '1',	//�Ƿ����ⲿͨ��֤
'sina_akey' => '',	//sina AKEY
'sina_skey' => '',	//sina SKEY
'qq_akey' => '',	//qq skey
'qq_skey' => '',	//qq skey
'plugin_debug' => '0',
'admin_url' => '',	//������ʺ�̨������
'qq_appid' => '',
  'qq_appkey' => '',
  'qq_callback' => 'http://localhost:7030/index.php?s=member/index/public_qq_loginnew&forward={$forward}','house_domain' => '',
'weixin_token' => '',
'weixin_reply' => '',
);
?>