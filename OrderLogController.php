<?php
/**
 * 根据订单号-查询相关流转状态
 * @author JianxunLiu
 * @version 2015-06-08
 */
class OrderLogController extends Controller {
    public $layout = '//layouts/column2';
    private $orderStatus = array(
         '1' => '创建订单',
         '2' => '运费修改',
         '3' => '用户支付',
         '4' => '订单备货',
         '5' => '订单发货',
         '6' => '确认收货',
         '7' => '订单取消',
         '8' => '订单退货'  
    ); 

    public function actionIndex() {
        $this->render('/order/orderLog',array());
    }

    /*
     * 根据订单ID获取相关流转信息
     */
    public function actionGetOrderInfoById(){
        //接收order_id
        $order_id = parent::getRequest('id');
        if(!$order_id){
            $this->excuteAjaxHtml('/order/orderLogView',array('code'=>'0','msg'=>'亲，你的参数有误!'));
        }
        
        //根据order_id查询订单流转状态
        $sql = "SELECT id,order_id,add_time,type,father_id FROM t_pandora_order_log WHERE order_id = '" . $order_id . "' ORDER BY type ASC";
        $cmd = Yii::app ()->db->createCommand ();
        $cmd->text = $sql;
        $info = $cmd->queryAll ();
        if(empty($info)){
            $this->excuteAjaxHtml('/order/orderLogView',array('code'=>'0','msg'=>'亲，没有订单号:['.$order_id.']的相关信息!'));
        }
        array_walk($info, function(&$info){
            $info['status_msg'] = $this->orderStatus[$info['type']];
        });
        $result = array('code'=>'1','msg'=>$info);

        $this->excuteAjaxHtml('/order/orderLogView',$result);

    }

    /*
     * 根据ID获取该订单的流转详情
     */
    public function actionOrderDetail() {
        //接收id
        $id = parent::getRequest('id');
        if(!$id){
            die("操作失败,检查参数!");
        }

        //根据id查询订单流转详情
        $sql = "SELECT * FROM t_pandora_order_log WHERE id = '" . $id . "' ";
        $cmd = Yii::app ()->db->createCommand ();
        $cmd->text = $sql;
        $info = $cmd->queryAll();
        if(empty($info)){
            die("亲，没有该条订单流转信息!");
        }
        $result = $info[0];
        $result['status_msg'] = $this->orderStatus[$result['type']];
        $contents = unserialize($result['contents']);
        $newContents = $this->formatOrderContents($contents,$result['type']);
        $result['contents'] = $newContents;
        $columnComments = $this->getOrderColumnComments();

        $this->render('/order/orderLogDetail',array('result'=>$result,'comments'=>$columnComments));
    }

    /*
     *  格式化输出订单日志输出内容
     */ 
    private function formatOrderContents($contents,$type){
        if(empty($contents)) return array();
        $newContents = array();
        switch ($type) {
            case '1': //创建订单
                //走的新接口 : order/createNew
                if(!empty($contents['ext_attr_data'])&&(is_array($contents['ext_attr_data']))){
                    $newContents['express_id'] = $contents['express_info']['express_id'];
                    $newContents['buyer_id'] = $contents['express_info']['buyer_id'];
                    $newContents['order_id'] = $contents['express_info']['order_id'];
                    $newContents['shop_id'] = $contents['express_info']['shop_id'];
                    $newContents['receiver_name'] = $contents['express_info']['receiver_name'];
                    $newContents['receiver_mobile'] = $contents['express_info']['receiver_mobile'];
                    $newContents['receiver_address'] = $contents['express_info']['receiver_address'];
                    $newContents['bank_code'] = $contents['pay_info']['bank_code'];
                    $newContents['pm_code'] = $contents['pay_info']['pm_code'];
                    $newContents['total_amount'] = $contents['ext_attr_data']['total_amount'];
                    $newContents['coupon_amount'] = $contents['ext_attr_data']['coupon_amount'];
                    $newContents['goods_amount'] = $contents['ext_attr_data']['goods_amount'];
                    $newContents['share_source'] = isset($contents['ext_attr_data']['share_source'])?$contents['ext_attr_data']['share_source']:'';
                    $newContents['is_new'] = isset($contents['ext_attr_data']['is_new'])?$contents['ext_attr_data']['is_new']:'';
                }else{
                    unset($contents['order_state'],$contents['order_status']);
                    $newContents = $contents;
                }
                $newContents['order_state_new'] = '1';
                $newContents['order_status_new'] = '1';
                break;
            case '2':  //运费修改
                $contents['order_state_new'] = '1';
                $contents['order_status_new'] = '1';
                break;
            case '3':  //用户支付
                $contents['order_state_new'] = '1';
                $contents['order_status_new'] = '2';
                break;
            case '4':  //订单备货                   
                $contents['order_state_new'] = '1';
                $contents['order_status_new'] = '3';
                break;
            case '5':  //订单发货
                $contents['order_state_new'] = '1';
                $contents['order_status_new'] = '4';
                break;
            case '6':  //确认收货                 
                $contents['order_state_new'] = '2';
                $contents['order_status_new'] = '5';
                break;
            case '7':  //取消订单                       
                $contents['order_state_new'] = '-1'; 
                break;  
            case '8':  //退货                
                $contents['order_state_new'] = '-1';
                break;
            default:
                # code...
                break;
        }
        if($type>1){
            $delKey = array('transport_id','transport_type','timelag_days','timelag_nums','usertimelag_nums','order_close_remark','order_remark','confirm_time');    
            foreach ($contents as $key => $value) {
                if (in_array($key, $delKey)) {
                     unset($contents[$key]);
                }
            }
            $newContents = $contents;
        }
        unset($contents);
        return $newContents;
    }

    //获取每个字段的备注意思
    private function getOrderColumnComments(){
        return array(
            'order_id' => '订单ID',
            'shop_id' => '商家ID',
            'express_id' => '物流ID',
            'pay_id' => '支付ID',
            'buyer_id' => '买家ID',
            'order_sn' => '订单号',
            'order_amount' => '货物总额',
            'shipping_fee' => '订单总运费',
            'total_amount' => '订单总金额',
            'coupon_amount' => '代金券抵扣金额',
            'payable_amount' => '应付金额',
            'used_coupon' => '优惠标识',
            'transport_id' => '运费模版ID',
            'order_ip' => '买家ip',
            'order_status' => '订单流转状态',
            'order_remark' => '订单备注',
            'order_state' => '订单大状态',
            'order_close' => '订单关闭方式',
            'order_type' => '订单状态',
            'order_success' => '交易成功方式',
            'order_close_remark' => '订单关闭原因',
            'confirm_time' => '确认到货时间',
            'latestconfirm_time' => '最晚确认到货时间',
            'timelag_days' => '延长收货天数',
            'timelag_nums' => '延长收货次数',
            'usertimelag_nums' => '用户延长收货次数',
            'vip_flag' => 'VIP订单标识',
            'order_mtime' => '订单修改时间',
            'order_ctime' => '订单创建时间',
            'order_channel' => '订单渠道',
            'order_via' => '创建订单的设备',
            'transport_type' => '邮寄方式',
            '3rd_logistics_sent_goods' => '三方物流公司是否发货',
            'goods_id' => '商品ID',
            'receiver_name' => '接收人',
            'receiver_mobile' => '接收电话',
            'receiver_address' => '接收地址',
            'bank_code' => '银行编号',
            'pm_code' => '支付方式',
            'goods_amount' => '单品金额',
            'new_shipping_fee' => '修改后>订单总运费',
            'new_payable_amount' => '修改后>应付金额',
            'new_total_amount' => '修改后>订单总金额',
            'operator_type' => '处理方式',
            'return_nums' => '退货数量',
            'order_state_new' => '当前：订单大状态',
            'order_status_new' => '当前：订单流转状态',
            'share_source' => '微信返利参数',
            'is_new' => '是否新用户'
        );  
    }

    //ajax返回html数据
    private function excuteAjaxHtml($pageView,$result=array()){
        $this->renderPartial($pageView,array('result'=>$result));die;
    }

}
