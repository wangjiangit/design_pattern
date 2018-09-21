<?php

/**
 * 解释器设计模式：用于分析一个实体的关键元素，并且针对每个元素都提供自己的解释或响应的动作
 *当使用关键词或宏语言引用一组指令时，最佳的做法是使用基于解释器设计模式的类
 */
class User
{
    protected $_username = '';

    public function __construct($username)
    {

        $this->_username = $username;

    }


    public function getProfilePage()
    {

        $profile = "<h2>I like Never Again!</h2>";
        $profile .= "I love all of their songs . My favorite CD:<br/>";
        $profile .= "{{myCD.getTitle}}!!";
        return $profile;

    }
}

class UserCD
{
    protected $_user = null;

    public function setUser($user)
    {

        $this->_user = $user;

    }

    public function getTitle()
    {

        $title = 'Waste of a Rib';
        return $title;
    }
}


class userCDInterpreter
{

    protected $_user=null;

    public function setUser(User $user)
    {
        $this->_user=$user;
    }

    /**
     * 将相应的宏，替换成相应文本
     * @return mixed
     */
    public function getInterpreted()
    {

        $profile=$this->_user->getProfilePage();

        if(preg_match_all('/\{\{myCD\.(.*?)\}\}/',$profile,$triggers,PREG_SET_ORDER)){
            $replacements=[];

            foreach ($triggers as $trigger){
                $replacements[]=$trigger[1];
            }

            $replacements=array_unique($replacements);
            $myCD=new userCD();
            $myCD->setUser($this->_user);

            foreach($replacements as $replacement){
                $profile=str_replace("{{myCD.{$replacement}}}",call_user_func([$myCD,$replacement]),$profile);
            }

        }

        return $profile;

    }

}

//调用
$username="jack";
$user=new User($username);
$interpreter=new userCDInterpreter();
$interpreter->setUser($user);
print  "<h1>{$username} 's Profile</h1>";
print $interpreter->getInterpreted();
