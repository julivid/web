<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

Class Func {
    /**
     * Main function for the system.
     * 
     * @auth    zhuliwei at 2016-03-01 15:50:36
     * 
     */

    //获取客户端IP
    public function get_client_ip() {
        if(getenv('HTTP_CLIENT_IP')){
            $client_ip = getenv('HTTP_CLIENT_IP');
        } elseif(getenv('HTTP_X_FORWARDED_FOR')) {
            $client_ip = getenv('HTTP_X_FORWARDED_FOR');
        } elseif(getenv('REMOTE_ADDR')) {
            $client_ip = getenv('REMOTE_ADDR');
        } else {
            $client_ip = $_SERVER['REMOTE_ADDR'];
        }
        return $client_ip;
    }

    //截取字符串长度
    public function getContentBrief($content=NULL, $len = 20)
    {
        if ( mb_strlen($content) <= $len) {
            return $content;
        }
        return mb_substr($content, 0, $len) . '...';
    }

    //字符串转换成数组,去除空值并按值（低->高）排序
    public function str2Arr($str, $delimiter=','){
        if($str==''){
            return array();
        }
        if(is_array($str)){
            return $str;
        }
        $arr = array();
        $tmpArr = explode($delimiter, $str);
        $tmpArr = array_unique($tmpArr);
        foreach($tmpArr as $k=>$v){
            if($v!==''){
                $arr[$k] = intval($v);
            }
        }
        sort($arr, SORT_NUMERIC);
        unset($tmpArr);
        return $arr;
    }
    
    //验证是否为空或数组中是否存在空元素(0,false,NULL,'',array())--可选参数：例外索引，例外值
    public function hasEmptyEle($d, $exceptKey=array(), $exceptVal=array()){
        $isEmpty = empty($d) ? true : false;
        if(!$isEmpty && is_array($d)){
            foreach($d as $k=>$v){
                if(is_array($v)){ //多维数组递归
                    $this->hasEmptyEle($v, $exceptKey, $exceptVal);
                }
                if(empty($v) && !in_array($k, $exceptKey) && !in_array($v, $exceptVal) ){
                    $isEmpty = true;
                    break;
                }
            }
        }
        return $isEmpty;
    }
    
    //生成唯一随机字符－－如果存在，重新生成一个【用于生成卡的随机编号】
    public function getUniqStr($arrExists=array(), $arr=array(), $len=12, $difChar=NULL, $difLen=0)
    {
        $str = $this->generateStr( $len, $difChar, $difLen );
        if (in_array($str, $arr) || in_array($str, $arrExists)) 
        {
            $this->getUniqStr($arr, $len, $difChar, $difLen );
        }
        return $str;
    }

    //随机生成字符串。para:length-字符串长度，difChar-分隔符，difLen-分隔间隔，chars-字符序列
    public function generateStr( $length = 8, $difChar=NULL, $difLen=0, $chars = NULL)
    {
        if ($chars == NULL) 
        {
            //$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            $chars = 'abcdefghijkmnpqrstuvwxyz23456789'; // 已去掉 l,L,1,0,o,O,便于手机输入字母全部小写
        }

        
        $cahrsArr = str_split($chars);
        shuffle($cahrsArr);
        $str = '';
        for ( $i = 0; $i < $length; $i++ ) 
        {
            $str .= $cahrsArr[ mt_rand(0, strlen($chars) - 1) ];
            if( !empty($difChar) && $difLen > 0 && ($i+1)%$difLen==0 )
            { //用分隔符将字符串分隔
                $str .= $difChar;
            }
        }
        //$str = rtrim( $str, $difChar );
        return rtrim( $str, $difChar );
    }



    //格式化数据
    public function responseData($code = -1, $msg = '系统错误', $data = array(), $numeric_flag=false, $format='json'){
        
        $res = array('status'=>$code, 'msg'=>$msg, 'data'=>$data);
        /*switch ( $format ) {
            case 'json':
                echo $numeric_flag==false ? json_encode( $res ) : json_encode( $res,JSON_NUMERIC_CHECK ); 
                exit();
                break;
            case 'xml':
                $xml = simplexml_load_string('<request />');
                $this->_createXMLBody($res, $xml);
                exit( $xml->saveXML() );
                break;
            case 'html':
                $_CI = &get_instance();
                $_CI->load->view('response_view', array('data'=>$res) );
                break;
        }*/
        echo $numeric_flag==false ? json_encode( $res ) : json_encode( $res, JSON_NUMERIC_CHECK ); 
        exit();
    }
    //生成XML@格式化数据
    private function _createXMLBody($array, $xml) {
        foreach($array as $k=>$v) {
            if(is_array($v)) {
                $x = $xml->addChild($k);
                $this->_createXMLBody($v, $x);
            }else{
                $xml->addChild($k, $v);
            }
        }
    }

    //产品标签样式
    public function productTag($tag='')
    {
        $t = explode(',', $tag);
        $tmp = '';
        foreach ($t as $k => $v) {
            $tmp .= '<span class="tag">'.$v.'</span>';
        }
        return $tmp;
    }

    //密码加密函数
    public function encryptPwd( $pwd = NULL, $salt = NULL){
        if (empty($pwd) || empty($salt)) {
            return NULL;
        }
        return hash_hmac( 'sha1', sha1( $pwd), $salt );
    }

    //格式化座位号
    public function matchSeatFormat($seat='')
    {
        if ($seat==0) {
            return '未分桌';
        }
        $s = intval(mb_substr($seat, -1)); //座位号
        $t = intval(mb_substr($seat, 0, strlen($seat)-1)); //桌号
        return $t.'桌'.($s+1).'号';
    }

    public function hidePwd($pwd='', $tag='part')
    {
        if (strlen($pwd)<2 || $tag=='all') {
            return '******';
        }
        return mb_substr($pwd, 0, 1, 'utf-8').'****'.mb_substr($pwd, (strlen($pwd)-1), 1, 'utf-8');
    }

    //Excel输出
    public function excelExport($header=array(), $data=array(), $filename='tickets')
    {
        require_once("phpexcel/PHPExcel.php");
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("Jupiter")
                             ->setLastModifiedBy("julivid@qq.com")
                             ->setTitle("CPG Manager Data Download")
                             ->setSubject("CPG Manager Data Download.")
                             ->setDescription("This list is used for printing the data of CPG games.")
                             ->setKeywords("cpg,poker")
                             ->setCategory("download");
        
        $colArr = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        //设置header
        $hcount = count($header);
        if ($hcount < 1) {
            exit( 'No header data...' );
        }
        for ($i=0; $i < $hcount; $i++) { 
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colArr[$i].'1', $header[$i]);
        }

        //设置数据
        $dcount = count($data);
        if ($dcount < 1) {
            exit( 'No data...' );
        }
        for ($i=0; $i < $dcount; $i++) {
            foreach ($data[$i] as $k => $v) {
                $objPHPExcel->setActiveSheetIndex(0)->setCellValue($colArr[$k].($i+2), $v, PHPExcel_Cell_DataType::TYPE_STRING);
            }
        }

        $objPHPExcel->getActiveSheet()->setTitle('发卡统计'); //设置sheet标题
        $objPHPExcel->setActiveSheetIndex(0); //设置第一个sheet为活跃页
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.date('ymdHis').'.xls"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

}






/* End of file Func.php */
/* Location: ./application/libraries/Func.php */