@extends('admin.layout.index')
@section('content')
    <div class="mws-stat-container clearfix">
                	
        <!-- Statistic Item -->
    	<a class="mws-stat" href="#">
        	<!-- Statistic Icon (edit to change icon) -->
        	<span class="mws-stat-icon icol32-building"></span>
            
            <!-- Statistic Content -->
            <span class="mws-stat-content">
            	<span class="mws-stat-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">管理员数量</font></font></span>
                <span class="mws-stat-value"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $admin }}</font></font></span>
            </span>
        </a>

    	<a class="mws-stat" href="#">
        	<!-- Statistic Icon (edit to change icon) -->
        	<span class="mws-stat-icon icol32-sport"></span>
            
            <!-- Statistic Content -->
            <span class="mws-stat-content">
            	<span class="mws-stat-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">用户数量</font></font></span>
                <span class="mws-stat-value"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $users }}</font></font></span>
            </span>
        </a>

    	<a class="mws-stat" href="#">
        	<!-- Statistic Icon (edit to change icon) -->
        	<span class="mws-stat-icon icol32-walk"></span>
            
            <!-- Statistic Content -->
            <span class="mws-stat-content">
            	<span class="mws-stat-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">商品数量</font></font></span>
                <span class="mws-stat-value"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $good }}</font></font></span>
            </span>
        </a>
        
    	<a class="mws-stat" href="#">
        	<!-- Statistic Icon (edit to change icon) -->
        	<span class="mws-stat-icon icol32-bug"></span>
            
            <!-- Statistic Content -->
            <span class="mws-stat-content">
            	<span class="mws-stat-title"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">订单数量</font></font></span>
                <span class="mws-stat-value"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">{{ $order1 }}</font></font></span>
            </span>
        </a>
        
    	
    </div>
    <div style="background:white;width: 900px;height:500px;margin-left:150px;margin-top:50px;border:1px solid gray;border-radius:10px;">
    	<div id="main" style="background:white;width: 900px;height:500px;"></div>
    </div>
    <script type="text/javascript" src="/table/echarts-all-3.js"></script>
    <script type="text/javascript" src="/table/china.js"></script>

    <script type="text/javascript">
        // 基于准备好的dom，初始化echarts实例
        var admin = {{ $admin }};
        var users = {{ $users }};
        var order1 = {{ $order1 }};
        var good = {{ $good }};
        // console.log(admin);
        var myChart = echarts.init(document.getElementById('main'));

        // 指定图表的配置项和数据
        var option = {
            title: {
                text: '项目比例'
            },
            tooltip: {},
            legend: {
                data:['数量']
            },
            xAxis: {
                data: ["管理员","用户","商品","订单"]
            },
            yAxis: {},
            series: [{
                name: '数量',
                type: 'bar',
                data: [admin,users,good,order1]
            }]
        };

        // 使用刚指定的配置项和数据显示图表。
        myChart.setOption(option);
    </script>
@endsection