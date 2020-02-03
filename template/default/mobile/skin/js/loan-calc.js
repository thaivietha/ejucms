/**
* 房贷计算器
*/
var page = {};

page.empty = function (val) {
    if (val === null || typeof val == 'undefined' || $.trim(val) === '') {
        return '';
    }
    return val;
};

/**
 * 验证是否为数字
 * @param str
 * @returns {boolean}
 */
page.regNum = function (str) {
    var rex = /^\d+(\.\d+)?$/;
    return rex.test(str);
};

var pageKey = 'calc';
// 参数设置
var params = {};

var $selectHkfs = null, // 还款方式
    $selectJsfs = null, // 计算方式
    $houseTotal = null, // 房屋总价
    $ajcs = null, // 按揭成数
    $totalPrice = null, // 贷款总额
    $busiDk = null, // 商业贷款
    $accuDk = null, // 公积金贷款
    $selectYears = null, // 按揭年数
    $selectRate = null, // 利率
    $singleRate = null, // 存储商贷/公积金利率值
    $busiRate = null, // 商贷利率
    $accuRate = null; // 公积金利率

var dkType = 1, // 贷款类别
    busiRate = 0, // 商贷利率
    accuRate = 0; // 公积金利率

var busiRateBase = 4.9;
var accuRateBase = 3.25;

//商贷利率折扣
var busiDKRate = [];
busiDKRate[1] = 1;
busiDKRate[2] = 1.2;
busiDKRate[3] = 1.1;
busiDKRate[4] = 0.9;
busiDKRate[5] = 0.8;
busiDKRate[6] = 0.7;

var calcedDkType ;
//是否已计算
var calced = false;

/**
 * 重置参数
 */
var resetArgs = function () {
    $selectJsfs = $('#jsfs'); // 计算方式
    $houseTotal = $('#houseTotal'); // 房屋总价
    $ajcs = $('#ajcs'); // 按揭成数
    $totalPrice = $('#totalPrice'); // 贷款总额
    $busiDk = $('#busiDK'); // 商业贷款
    $accuDk = $('#accuDK'); // 公积金贷款
    $selectYears = $('#years'); // 按揭年数
    $busiRate = $('#busiDKRate'); // 商贷利率
    $accuRate = $('#accuDKRate'); // 公积金利率

    dkType = 1; // 贷款类别
    busiRate = 0; // 商贷利率
    accuRate = 0; // 公积金利率
};


/**
 * 初始化
 */
var init = function () {
    initShow();
    bindEvent();
};

/**
 * 初始化显示
 */
var initShow = function () {
    $("#dk_1").addClass('on');
    $("#accuDKLi").hide();
    $("#busiDKLi").show();
    $("#accuDKRateLi").hide();

    $("#calcResult").hide();

    // 重置参数
    resetArgs();
    countDK();
    initRate(30);
};

/**
 * 绑定事件
 */
var bindEvent = function () {
    $(document).off('click').on('click', function (e) {
        var $target = $(e.target);

        // Tab 切换 贷款类别
        var $calc_tabs = $target.closest('.tab-2');
        if ($calc_tabs.length) {
            var $li = $target.closest('li');
            if ($li.length) {
                $li.siblings().removeClass('on');
                $li.addClass('on');
                dkType = $li.attr('id').split('_')[1];
                countDK();
                if (dkType == 1) {
                    $("#accuDKLi").hide();
                    $("#busiDKLi").show();
                    $("#busiDKRateLi").show();
                    $("#accuDKRateLi").hide();
                    dkType = 1;
                } else if (dkType == 2) {
                    $("#busiDKLi").hide();
                    $("#accuDKLi").show();
                    $("#accuDKRateLi").show();
                    $("#busiDKRateLi").hide();
                    dkType = 2;
                } else if (dkType == 3) {
                    $("#accuDKLi").show();
                    $("#busiDKLi").show();
                    $("#busiDKRateLi").show();
                    $("#accuDKRateLi").show();
                    dkType = 3;
                }
                if(calced) toResult();
            }
        }
    });
    //切换首付比例
    $ajcs.on('change', function(){
        countDK();
    });
    // 开始计算
    $("#startCount").on('click', function(){
        toResult();
    });
    //更改房款总额
    $houseTotal.change(function(){
        if(!checkHouseTotalPrice()){
            return;
        }
        countDK();
    });
    //更改贷款期限
    $selectYears.change(function(e){
        initRate($(this).val());
    });
};

var initBusRateSelect = function(){
    var selected = $("#busiDKRate").val() || 1;
    $("#busiDKRate").empty();
    for(var i=1; i<busiDKRate.length; i++){
        var rateText = "";
        if(busiDKRate[i] == 1){
            rateText = "基准利率";
        }else if(busiDKRate[i] > 1){
            rateText = busiDKRate[i] + '倍';
        }else if(busiDKRate[i] < 1){
            rateText = busiDKRate[i]*10 + '.0折';
        }
        $("<option value="+i+">"+busiRateBase+"% * "+ rateText+"</option>").appendTo($("#busiDKRate"));
        $("#busiDKRate").val(selected);
    }
};

var initAccuRateInput = function(){
    $("#accuDKRate").val(accuRateBase+'%');
};

var initRate = function(year){
    if(year <= 1){
        busiRateBase = 4.35;
    }
    if(year > 1 && year <= 5){
        busiRateBase = 4.75;
    }
    if(year > 5){
        busiRateBase = 4.9;
        accuRateBase = 3.25;
    }else{
        accuRateBase = 2.75;
    }
    initBusRateSelect();
    initAccuRateInput();
};

var countDK = function(){
    var totalPrice = $houseTotal.val();
    if(!page.empty(totalPrice)) return;
    var ajcs = $ajcs.val() * 0.1;
    var dkje = totalPrice - (totalPrice * ajcs);
    dkje = Math.round(dkje*100)/100;
    if(dkType == 1){
        $busiDk.val(dkje);
    }else if(dkType == 2){
        $accuDk.val(dkje);
    }else if(dkType == 3){
        var amount = dkje / 2 ;
        $busiDk.val(amount);
        $accuDk.val(amount);
    }
}

var checkHouseTotalPrice = function(){
    var houseTotal = $houseTotal.val();
    if (!page.empty(houseTotal)) {
        layer.msg('请填写房款总额');
        return false;
    }
    if (!page.regNum(houseTotal)) {
        layer.msg('请填写数字');
        return false;
    }
    return true;
};

var checkBusLoanAmount = function(){
    var busLoanAmount = $busiDk.val();
    if (!page.empty(busLoanAmount)) {
        layer.msg('请填写商业贷款金额');
        return false;
    }
    if (!page.regNum(busLoanAmount)) {
        layer.msg('商业贷款金额请填写数字');
        return false;
    }
    return true;
};

var checkAccumulationFundAmount = function(){
    var accumulationFundAmount = $accuDk.val();
    if (!page.empty(accumulationFundAmount)) {
        layer.msg('请填写公积金贷款金额');
        return false;
    }
    if (!page.regNum(accumulationFundAmount)) {
        layer.msg('公积金贷款金额请填写数字');
        return false;
    }
    return true;
};

var getDkType = function(){
    var $lis = $(".tab-nav > li");
    $lis.each(function(){
        if($(this).hasClass("on")){
            return $(this).attr("id").split("_")[1];
        }
    });
};

/**
 * 开始计算
 */
var toResult = function () {
    if(!checkHouseTotalPrice()) return ;
    var args = {};
    args.hkfs = $("input[name='hkfs']:checked").val(); //还款方式：1为本息，2为本金
    args.ajcs = $ajcs.val(); // 按揭成数
    args.years = $selectYears.val(); // 按揭年数
    args.dkType = dkType; // 贷款方式

    var houseTotal = $houseTotal.val(); // 房屋总价
    var busiRateIndex = $busiRate.val();//选择的商贷利率index
    var accRate = $accuRate.val().replace('%','');//公贷利率
    var busiDk = $busiDk.val(); // 商业贷款金额
    var accuDk = $accuDk.val(); // 公积金贷款金额

    switch (dkType){
        case 1:
            if(!checkBusLoanAmount()) return;
            args.singleRate = busiDKRate[busiRateIndex] * busiRateBase;
            args.busiDk = busiDk; // 商业贷款金额
            break;
        case 2:
            if(!checkAccumulationFundAmount()) return;
            args.singleRate = accRate;
            args.accuDk = accuDk; // 公积金贷款金额
            break;
        case 3:
            if(!checkBusLoanAmount()) return;
            if(!checkAccumulationFundAmount()) return;
            args.busiDk = busiDk; // 商业贷款金额
            args.accuDk = accuDk; // 公积金贷款金额
            args.accuRate = accRate;
            args.busiRate = busiDKRate[busiRateIndex] * busiRateBase;
            break;
    }

    args.houseTotal = houseTotal;
    calculate(args);
};

var calculate = function (params) {
    var hkfs = params.hkfs || 1; //还款方式：1为本息，2为本金
    var houseTotal = params.houseTotal || 0; // 房屋总价
    var ajcs = params.ajcs || 7; // 按揭成数
    var busiDk = params.busiDk || 0; // 商业贷款金额
    var accuDk = params.accuDk || 0; // 公积金贷款金额
    var years = params.years || 20; // 按揭年数
    var busiRate = params.busiRate || 0; // 商业贷款利率
    var accuRate = params.accuRate || 0; // 公积金贷款利率
    var singleRate = params.singleRate || 0; // 单一贷款利率
    var dkType = params.dkType || 1; // 贷款方式
    calcedDkType = dkType;
    calced = true;

    // 计算结果
    var data = {};
    var month = years * 12;
    data.years = years;
    data.hkfs = hkfs;
    data.month = month; // 显示贷款月数
    var daikuan_total = 0; // 贷款总额
    var month_money2 = '', all_total2 = 0;
    if (dkType == 3) {  // 组合型
        busiDk = busiDk; // 商业贷款金额
        accuDk = accuDk; // 公积金贷款金额

        data.fkze = '略'; // 房款总额
        data.sf = 0; // 首付

        // 贷款总额
        daikuan_total = busiDk*1 + accuDk*1;
        data.dkze = daikuan_total;

        var lilv_sd = busiRate / 100; // 得到商贷利率
        var lilv_gjj = accuRate / 100; // 得到公积金利率


        if (hkfs == 1) { // 1.等额本息
            // 月均还款（单位：元）
            var result_yjhk = getMonthMoney1(lilv_sd, busiDk * 10000, month) + getMonthMoney1(lilv_gjj, accuDk * 10000, month); //调用函数计算
            data.yjhk = Math.round(result_yjhk * 100) / 100;
            // 还款总额（单位：万元）
            var all_total = result_yjhk * month;
            data.hkze = (Math.round(all_total * 100 / 1000) / 1000).toFixed(2);
            // 支付利息
            data.lx = (Math.round((all_total - daikuan_total * 10000) * 100 / 1000) / 1000).toFixed(2);
        } else { // 2. 等额本金
            var monthMoneyArr = [];
            // 月均金额
            for (var i = 0; i < month; i++) {
                var huankuan = getMonthMoney2(lilv_sd, busiDk * 10000, month, i) + getMonthMoney2(lilv_gjj, accuDk * 10000, month, i);
                all_total2 += huankuan;
                huankuan = Math.round(huankuan * 100) / 100;
                monthMoneyArr[i+1] = huankuan;
                //month_money2 += (i + 1) + '月,' + huankuan + '(元)<br/>';
            }
            //data.yjje = month_money2;
            data.mydj = ((monthMoneyArr[1] - monthMoneyArr[month]) / (month - 1 )).toFixed(2);
            data.syyg = monthMoneyArr[1];

            // 还款总额
            data.hkze = (Math.round(all_total2 * 100 / 1000) / 1000).toFixed(2);

            // 支付利息
            data.lx = (Math.round((all_total2 - daikuan_total * 10000) * 100 / 1000) / 1000).toFixed(2);
        }


    } else { // 非组合型


        var lilv = singleRate / 100; // 得到利率

        // 房款总额
        var fangkuan_total = houseTotal * 10000;
        data.fkze = houseTotal;

        // 贷款总额
        //daikuan_total = fangkuan_total * (1 - ajcs / 10);
        //data.dkze = daikuan_total / 10000;
        data.dkze =  dkType == 1? busiDk : accuDk;
        daikuan_total = data.dkze * 10000;


        // 首期付款
        var money_first = fangkuan_total - daikuan_total;
        data.sf = money_first / 10000;

        if (hkfs == 1) { // 1.等额本息
            // 月均还款
            var month_money1 = getMonthMoney1(lilv, daikuan_total, month); //调用函数计算
            data.yjhk = Math.round(month_money1 * 100) / 100;

            // 还款总额
            var all_total1 = month_money1 * month;
            data.hkze = (Math.round(all_total1 * 100 / 1000) / 1000).toFixed(2);

            // 支付利息
            data.lx = (Math.round((all_total1 - daikuan_total) * 100 / 1000) / 1000).toFixed(2);
        } else { // 2. 等额本金
            var monthMoneyArr = [];
            // 月均金额
            for (var j = 0; j < month; j++) {
                // 调用函数计算: 本金月还款额
                var huankuan2 = getMonthMoney2(lilv, daikuan_total, month, j);
                all_total2 += huankuan2;
                huankuan2 = Math.round(huankuan2 * 100) / 100;
                monthMoneyArr[j+1] = huankuan2;
                //month_money2 += (j + 1) + '月,' + huankuan2 + '(元)<br/>';
            }
            //data.yjje = month_money2;
            data.mydj = ((monthMoneyArr[1] - monthMoneyArr[month]) / (month - 1 )).toFixed(2) ;
            data.syyg = monthMoneyArr[1];

            // 还款总额
            data.hkze = (Math.round(all_total2 * 100 / 1000) / 1000).toFixed(2);

            // 支付利息
            data.lx = (Math.round((all_total2 - daikuan_total) * 100 / 1000) / 1000).toFixed(2);
        }
    }
    data.dkType = dkType;
    showResult(data);
};

var initResult = function(dkType){
    if(calcedDkType != dkType) {
        $("#calcResult").hide();
        $("#startCount").text("开始计算");
    }
};

var showResult = function(data){
    var $calcResultFields = $("#calcResultFields");
    var html = "";
    if(data.hkfs == 1){
        html = "<li><p>贷款期限</p><span>"+ data.years +"年</span></li> " +
            "<li><p>参考月供</p><span>"+ data.yjhk +"元/月</span></li> " +
            "<li><p>合计利息</p><span>" + data.lx + "万元</span></li> " +
            "<li><p>本息合计</p><span >"+ data.hkze +"万元</span></li>";

    }else if(data.hkfs == 2){
        html = "<li><p>贷款期限</p><span>"+ data.years +"年</span></li> " +
        "<li><p>首月月供</p><span>"+ data.syyg +"元/月</span></li> " +
        "<li><p>每月递减</p><span>"+ data.mydj +"元/月</span></li> " +
        "<li><p>合计利息</p><span>" + data.lx + "万元</span></li> " +
        "<li><p>本息合计</p><span >"+ data.hkze +"万元</span></li>";
    }
    $calcResultFields.html(html);
    $("#calcResultFDZE").html("房贷总额："+ data.dkze +" 万元");
    $("#startCount").text("重新计算");
    $("#calcResult").show();
}

/**
 * 本息还款的月还款额
 * @param lilv 年利率
 * @param total 贷款总额
 * @param month 贷款总月份
 * @returns {number}
 */
var getMonthMoney1 = function (lilv, total, month) {
    var lilv_month = lilv / 12; // 月利率
    return total * lilv_month * Math.pow(1 + lilv_month, month) / (Math.pow(1 + lilv_month, month) - 1);
};


/**
 * 本金还款的月还款额
 * @param lilv 年利率
 * @param total 贷款总额
 * @param month 贷款总月份
 * @param cur_month 贷款当前月0～length-1
 * @returns {number}
 */
var getMonthMoney2 = function (lilv, total, month, cur_month) {
    var lilv_month = lilv / 12; //月利率
    var benjin_money = total / month;
    return (total - benjin_money * cur_month) * lilv_month + benjin_money;
};