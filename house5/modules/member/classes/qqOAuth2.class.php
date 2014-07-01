<?php
    class qqOAuth2{

        private $appid,$appkey,$callback,$access_token,$openid;

        public function __construct($appid, $appkey, $callback){
            $this->appid = $appid;
            $this->appkey = $appkey;
            $this->callback = $callback;
            $this->access_token= '';
            $this->openid = '';
        }

        public function redirect_to_login()
        {
            //跳转到QQ登录页的接口地址, 不要更改!!
			$state = md5(uniqid(rand(), TRUE));
            $redirect = "https://graph.qq.com/oauth2.0/authorize?response_type=code&client_id=$this->appid&state=$state&scope=get_user_info,add_share,list_album,add_album,upload_pic,add_topic,add_one_blog,add_weibo,check_page_fans,add_t,add_pic_t,del_t,get_repost_list,get_info,get_other_info,get_fanslist,get_idolist&redirect_uri=".rawurlencode($this->callback);
            header("Location:$redirect");
        }
        
        
        //获得登录的 openid
        public function get_openid($code){
            $url = "https://graph.qq.com/oauth2.0/token?grant_type=authorization_code&client_id=$this->appid&client_secret=$this->appkey&code=$code&redirect_uri=".rawurlencode($this->callback);
            $content = file_get_contents( $url);
            if (stristr($content,'access_token=')) {
                $params = explode('&',$content);
                $tokens = explode('=',$params[0]);
                $token  = $tokens[1];
                $this->access_token=$token;
				$_SESSION["qq_access_token"]  = $this->access_token;
                if ($token) {
                     $url="https://graph.qq.com/oauth2.0/me?access_token=$token";
                     $content=file_get_contents($url);
                     $content=str_replace('callback( ','',$content);
                     $content=str_replace(' );','',$content);
                     $returns = json_decode($content);
                     $openid = $returns->openid;
                     $this->openid = $openid;
                     $_SESSION["token2"]  = $openid;
                } else {
                    $openid='';
                }
            } elseif (stristr($content,'error')) {
                $openid='';
            }
            return $openid;
        }
        
        /**
        * 返回用户信息
        * 
        */
        public function get_user_info(){
            $url = "https://graph.qq.com/user/get_user_info?access_token=$this->access_token&oauth_consumer_key=$this->appid&openid=$this->openid";
            $content=file_get_contents($url);
            $result = json_decode($content);
            return $result->nickname;
        }

		/**
        * 返回用户头像
        * 
        */
        public function get_user_head(){
            $url = "https://graph.qq.com/user/get_user_info?access_token=$this->access_token&oauth_consumer_key=$this->appid&openid=$this->openid";
            $content=file_get_contents($url);
            $result = json_decode($content);
            return $result->figureurl_1;
        }

    }
?>