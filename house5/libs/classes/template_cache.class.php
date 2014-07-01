<?php

final class template_cache {
    public function template_compile($module,$template,$style = 'default') {
        if(strpos($module,'/')=== false) {
            $tplfile = $_tpl = H5_PATH.'templates'.DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html';
        }elseif (strpos($module,'yp/') !== false) {
            $module = str_replace('/',DIRECTORY_SEPARATOR,$module);
            $tplfile = $_tpl = H5_PATH.'templates'.DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html';
        }else {
            $plugin = str_replace('plugin/','',$module);
            $module = str_replace('/',DIRECTORY_SEPARATOR,$module);
            $tplfile = $_tpl = H5_PATH.'plugin'.DIRECTORY_SEPARATOR.$plugin.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$template.'.html';
        }
        if ($style != 'default'&&!file_exists ( $tplfile )) {
            $style = 'default';
            $tplfile = H5_PATH.'templates'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.'.html';
        }
        if (!file_exists ( $tplfile )) {
            showmessage ( "templates".DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.$template.".html is not exists!");
        }
        $content = @file_get_contents ( $tplfile );
        $filepath = CACHE_PATH.'caches_template'.DIRECTORY_SEPARATOR.$style.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR;
        if(!is_dir($filepath)) {
            mkdir($filepath,0777,true);
        }
        $compiledtplfile = $filepath.$template.'.php';
        $content = $this->template_parse($content);
        $strlen = file_put_contents ( $compiledtplfile,$content );
        chmod ( $compiledtplfile,0777 );
        return $strlen;
    }
    public function template_refresh($tplfile,$compiledtplfile) {
        $str = @file_get_contents ($tplfile);
        $str = $this->template_parse ($str);
        $strlen = file_put_contents ($compiledtplfile,$str );
        chmod ($compiledtplfile,0777);
        return $strlen;
    }
    public function template_parse($str) {
        $str = preg_replace ( "/\{template\s+(.+)\}/","<?php include template(\\1); ?>",$str );
        $str = preg_replace ( "/\{include\s+(.+)\}/","<?php include \\1; ?>",$str );
        $str = preg_replace ( "/\{php\s+(.+)\}/","<?php \\1?>",$str );
        $str = preg_replace ( "/\{if\s+(.+?)\}/","<?php if(\\1) { ?>",$str );
        $str = preg_replace ( "/\{else\}/","<?php } else { ?>",$str );
        $str = preg_replace ( "/\{elseif\s+(.+?)\}/","<?php } elseif (\\1) { ?>",$str );
        $str = preg_replace ( "/\{\/if\}/","<?php } ?>",$str );
        $str = preg_replace("/\{for\s+(.+?)\}/","<?php for(\\1) { ?>",$str);
        $str = preg_replace("/\{\/for\}/","<?php } ?>",$str);
        $str = preg_replace("/\{\+\+(.+?)\}/","<?php ++\\1; ?>",$str);
        $str = preg_replace("/\{\-\-(.+?)\}/","<?php ++\\1; ?>",$str);
        $str = preg_replace("/\{(.+?)\+\+\}/","<?php \\1++; ?>",$str);
        $str = preg_replace("/\{(.+?)\-\-\}/","<?php \\1--; ?>",$str);
        $str = preg_replace ( "/\{loop\s+(\S+)\s+(\S+)\}/","<?php \$n=1;if(is_array(\\1)) foreach(\\1 AS \\2) { ?>",$str );
        $str = preg_replace ( "/\{loop\s+(\S+)\s+(\S+)\s+(\S+)\}/","<?php \$n=1; if(is_array(\\1)) foreach(\\1 AS \\2 => \\3) { ?>",$str );
        $str = preg_replace ( "/\{\/loop\}/","<?php \$n++;}unset(\$n); ?>",$str );
        $str = preg_replace ( "/\{([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/","<?php echo \\1;?>",$str );
        $str = preg_replace ( "/\{\\$([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff:]*\(([^{}]*)\))\}/","<?php echo \\1;?>",$str );
        $str = preg_replace ( "/\{(\\$[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\}/","<?php echo \\1;?>",$str );
        $str = preg_replace("/\{(\\$[a-zA-Z0-9_\[\]\'\"\$\x7f-\xff]+)\}/es","\$this->addquote('<?php echo \\1;?>')",$str);
        $str = preg_replace ( "/\{([A-Z_\x7f-\xff][A-Z0-9_\x7f-\xff]*)\}/s","<?php echo \\1;?>",$str );
        $str = preg_replace("/\{h5:(\w+)\s+([^}]+)\}/ie","self::h5_tag('$1','$2', '$0')",$str);
        $str = preg_replace("/\{\/h5\}/ie","self::end_h5_tag()",$str);
        $str = "<?php defined('IN_HOUSE5') or exit('No permission resources.'); ?>".$str;
        return $str;
    }
    public function addquote($var) {
        return str_replace ( "\\\"","\"",preg_replace ( "/\[([a-zA-Z0-9_\-\.\x7f-\xff]+)\]/s","['\\1']",$var ) );
    }
    public static function h5_tag($op,$data,$html) {
        preg_match_all("/([a-z]+)\=[\"]?([^\"]+)[\"]?/i",stripslashes($data),$matches,PREG_SET_ORDER);
        $arr = array('action','num','cache','page','pagesize','urlrule','return','start');
        $tools = array('json','xml','block','get');
        $datas = array();
        $tag_id = md5(stripslashes($html));
        $str_datas = 'op='.$op.'&tag_md5='.$tag_id;
        foreach ($matches as $v) {
            $str_datas .= $str_datas ?"&$v[1]=".($op == 'block'&&strpos($v[2],'$') === 0 ?$v[2] : urlencode($v[2])) : "$v[1]=".(strpos($v[2],'$') === 0 ?$v[2] : urlencode($v[2]));
            if(in_array($v[1],$arr)) {
                $$v[1] = $v[2];
                continue;
            }
            $datas[$v[1]] = $v[2];
        }
        $str = '';
        $num = isset($num) &&intval($num) ?intval($num) : 20;
        $cache = isset($cache) &&intval($cache) ?intval($cache) : 0;
        $return = isset($return) &&trim($return) ?trim($return) : 'data';
        if (!isset($urlrule)) $urlrule = '';
        if (!empty($cache) &&!isset($page)) {
            $str .= '$tag_cache_name = md5(implode(\'&\','.self::arr_to_html($datas).').\''.$tag_id.'\');if(!$'.$return.' = tpl_cache($tag_cache_name,'.$cache.')){';
        }
        if (in_array($op,$tools)) {
            switch ($op) {
                case 'json':
                    if (isset($datas['url']) &&!empty($datas['url'])) {
                        $str .= '$json = @file_get_contents(\''.$datas['url'].'\');';
                        $str .= '$'.$return.' = json_decode($json, true);';
                    }
                    break;
                case 'xml':
                    $str .= '$xml = h5_base::load_sys_class(\'xml\');';
                    $str .= '$xml_data = @file_get_contents(\''.$datas['url'].'\');';
                    $str .= '$'.$return.' = $xml->xml_unserialize($xml_data);';
                    break;
                case 'get':
                    $str .= 'h5_base::load_sys_class("get_model", "model", 0);';
                    if ($datas['dbsource']) {
                        $dbsource = getcache('dbsource','commons');
                        if (isset($dbsource[$datas['dbsource']])) {
                            $str .= '$get_db = new get_model('.var_export($dbsource,true).', \''.$datas['dbsource'].'\');';
                        }else {
                            return false;
                        }
                    }else {
                        $str .= '$get_db = new get_model();';
                    }
                    $num = isset($num) &&intval($num) >0 ?intval($num) : 20;
                    if (isset($start) &&intval($start)) {
                        $limit = intval($start).','.$num;
                    }else {
                        $limit = $num;
                    }
                    if (isset($page)) {
                        $str .= '$pagesize = '.$num.';';
                        $str .= '$page = intval('.$page.') ? intval('.$page.') : 1;if($page<=0){$page=1;}';
                        $str .= '$offset = ($page - 1) * $pagesize;';
                        $limit = '$offset,$pagesize';
                        if ($sql = preg_replace('/select([^from].*)from/i',"SELECT COUNT(*) as count FROM ",$datas['sql'])) {
                            $str .= '$r = $get_db->sql_query("'.$sql.'");$s = $get_db->fetch_next();$pages=pages($s[\'count\'], $page, $pagesize, $urlrule);';
                        }
                    }
                    $str .= '$r = $get_db->sql_query("'.$datas['sql'].' LIMIT '.$limit.'");while(($s = $get_db->fetch_next()) != false) {$a[] = $s;}$'.$return.' = $a;unset($a);';
                    break;
                case 'block':
                    $str .= '$block_tag = h5_base::load_app_class(\'block_tag\', \'block\');';
                    $str .= 'echo $block_tag->h5_tag('.self::arr_to_html($datas).');';
                    break;
            }
        }else {
            if (!isset($action) ||empty($action)) return false;
            if (module_exists($op) &&file_exists(H5_PATH.DIRECTORY_SEPARATOR.'modules'.DIRECTORY_SEPARATOR.$op.DIRECTORY_SEPARATOR.'classes'.DIRECTORY_SEPARATOR.$op.'_tag.class.php')) {
                $str .= '$'.$op.'_tag = h5_base::load_app_class("'.$op.'_tag", "'.$op.'");if (method_exists($'.$op.'_tag, \''.$action.'\')) {';
                if (isset($start) &&intval($start)) {
                    $datas['limit'] = intval($start).','.$num;
                }else {
                    $datas['limit'] = $num;
                }
                if (isset($page)) {
                    $str .= '$pagesize = '.$num.';';
                    $str .= '$page = intval('.$page.') ? intval('.$page.') : 1;if($page<=0){$page=1;}';
                    $str .= '$offset = ($page - 1) * $pagesize;';
                    $datas['limit'] = '$offset.",".$pagesize';
                    $datas['action'] = $action;
                    $str .= '$'.$op.'_total = $'.$op.'_tag->count('.self::arr_to_html($datas).');';
                    $str .= '$pages = pages($'.$op.'_total, $page, $pagesize, $urlrule);';
                    $str .= '$housepages = housepages($'.$op.'_total, $page, $pagesize, $urlrule,$lst);';
                    $str .= '$mobilepages = mobilepages($'.$op.'_total, $page, $pagesize, $urlrule,$keyword);';
                }
                $str .= '$'.$return.' = $'.$op.'_tag->'.$action.'('.self::arr_to_html($datas).');';
                $str .= '}';
            }
        }
        if (!empty($cache) &&!isset($page)) {
            $str .= 'if(!empty($'.$return.')){setcache($tag_cache_name, $'.$return.', \'tpl_data\');}';
            $str .= '}';
        }
        return "<"."?php if(defined('IN_ADMIN')  && !defined('HTML')) {echo \"<div class=\\\"admin_piao\\\" h5_action=\\\"".$op."\\\" data=\\\"".$str_datas."\\\"><a href=\\\"javascript:void(0)\\\" class=\\\"admin_piao_edit\\\">".($op=='block'?L('block_add') : L('edit'))."</a>\";}".$str."?".">";
    }
    static private function end_h5_tag() {
        return '<?php if(defined(\'IN_ADMIN\') && !defined(\'HTML\')) {echo \'</div>\';}?>';
    }
    private static function arr_to_html($data) {
        if (is_array($data)) {
            $str = 'array(';
            foreach ($data as $key=>$val) {
                if (is_array($val)) {
                    $str .= "'$key'=>".self::arr_to_html($val).",";
                }else {
                    if (strpos($val,'$')===0) {
                        $str .= "'$key'=>$val,";
                    }else {
                        $str .= "'$key'=>'".new_addslashes($val)."',";
                    }
                }
            }
            return $str.')';
        }
        return false;
    }
}
?>