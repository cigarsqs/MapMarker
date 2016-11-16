
<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" href="../../favicon.ico">

    <!-- Loading Bootstrap -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="../css/flat-ui.min.css" rel="stylesheet">

    <title>MapMarker</title>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=HZfqDHAQFBg7tLMsVSE1VuOH"></script>




    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    

      
      <!-- Main component for a primary marketing message or call to action -->
      
       <div  class="col-xs-12 col-sm-12" id ="allmap" style="height: 1000px">
       </div>
 





    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.min.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!--<script src="../js/vendor/jquery.min.js"></script>-->
    <script src="../js/flat-ui.min.js"></script>

    <script src="../js/application.js"></script>
    <script src="../js/drawingManager.js"></script>
    <script type="text/javascript" src="../js/MarkerClusterer.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/library/TextIconOverlay/1.2/src/TextIconOverlay_min.js"></script>

    <script type="text/javascript">
      // 百度地图API功能

      function G(id) {
        return document.getElementById(id);
      }
      var map = new BMap.Map("allmap");

      var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});// 左上角，添加比例尺
      var top_left_navigation = new BMap.NavigationControl();  //左上角，添加默认缩放平移控件
      //var top_right_navigation = new BMap.NavigationControl({anchor: BMAP_ANCHOR_TOP_RIGHT, type: BMAP_NAVIGATION_CONTROL_SMALL}); //右上角，仅包含平移和缩放按钮

      map.addControl(top_left_navigation);
      map.addControl(top_left_control);     
      //map.addControl(top_right_navigation);
      /*缩放控件type有四种类型:
      BMAP_NAVIGATION_CONTROL_SMALL：仅包含平移和缩放按钮；BMAP_NAVIGATION_CONTROL_PAN:仅包含平移按钮；BMAP_NAVIGATION_CONTROL_ZOOM:仅包含缩放按钮*/

      map.centerAndZoom("上海", 15);

      // 定义一个控件类,即function
      function ZoomControl(){
        // 默认停靠位置和偏移量
        this.defaultAnchor = BMAP_ANCHOR_TOP_RIGHT;
        this.defaultOffset = new BMap.Size(10, 10);
      }

      // 通过JavaScript的prototype属性继承于BMap.Control
      ZoomControl.prototype = new BMap.Control();

      // 自定义控件必须实现自己的initialize方法,并且将控件的DOM元素返回
      // 在本方法中创建个div元素作为控件的容器,并将其添加到地图容器中
      ZoomControl.prototype.initialize = function(map){
        // 创建一个DOM元素
        var div = document.createElement("div");
        var input = document.createElement("input");
        var select = document.createElement("select");
        select.setAttribute("class", "form-control select-primary select-block");
        var option1 = document.createElement("option");
        option1.appendChild(document.createTextNode("年代"));
        option1.setAttribute("style","display:inline");
        option1.setAttribute("value", "0");

        var option2 = document.createElement("option");
        option2.appendChild(document.createTextNode("价格"));
        option2.setAttribute("style","display:inline");
        option2.setAttribute("value", "1");

        var option3 = document.createElement("option");
        option3.appendChild(document.createTextNode("年代/价格"));
        option3.setAttribute("style","display:inline");
        option3.setAttribute("value", "2");

        select.appendChild(option1);
        select.appendChild(option2);
        select.appendChild(option3);
        input.setAttribute("class", "form-control flat");
        input.setAttribute("style","display:inline");
        //input.setAttribute("style","border-color:#bdc3c7");
        //var button_div = document.createElement("div");
        var button = document.createElement("button");
        button.setAttribute("class", "btn btn-primary");

        button.style.width="60px";
        button.style.height="30px";
        button.appendChild(document.createTextNode("搜索"));

        // 添加文字说明
        div.appendChild(select);
        div.appendChild(input);
        div.appendChild(button);
        

        input.style.width="150px";
        input.style.height="30px";
        //input.style.border="2px solid #bdc3c7";

        // 绑定事件,点击一次放大两级
        button.onclick = function(e){
        //map.setZoom(map.getZoom() + 2);
        alert(input.value);
        //getCommunityInfoByYear(input.value);
        getCommunityInfoByOption(input.value,select.value);
        }
        // 添加DOM元素到地图中
        map.getContainer().appendChild(div);
        // 将DOM元素返回
        return div;
      }
    // 创建控件
      var myZoomCtrl = new ZoomControl();

      
      map.addControl(myZoomCtrl);


      var overlays = [];
      var overlaycomplete = function(e){
        overlays.push(e.overlay);
      };
      var markerClusterer;
      //var json = require('./point.json');
      
      //function getPointInfo(e){
        //alert(e.point.lng + ", " + e.point.lat);  
        //var zoom = map.getZoom(); 
        //map.clearOverlays();
        //getCommunityInfo();  
      //}

      function getCommunityInfoByOption(value,option){
        
        map.clearOverlays();
        //alert(option);
        var postURL;
        if (option === '0') {
          postURL = "../php/getPointsListInfoByYear.php";          
        }else if(option === '1'){
          postURL = "../php/getPointsListInfoByPrice.php";
        }else if (option === '2') {
          postURL = "../php/getPointsListInfoByBoth.php";
        }
        getCommunityInfoBySearchOption(value,postURL);
      }
      function getCommunityInfoBySearchOption(value,postURL){

        $.ajax({
          url:postURL,
          type:"POST",
          dataType:"json",
          data:{value:value},
          error: function(data,status){
            alert(status);
          },
          success: function(data,status){
            alert("success");
            var markers = [];
            
             $.each(data,function(i,item){
              var sw = map.getBounds().getSouthWest(); //返回矩形区域的西南角
              var ne = map.getBounds().getNorthEast(); //返回矩形区域的东北角
              //alert(item['position_x'])
              var point = new BMap.Point(parseFloat(item['position_x']) , parseFloat(item['position_y']));
              var label = new BMap.Label(item['community_name']+" "+item['house_number']+ " "+item['comminity_per_price'],{offset:new BMap.Size(20,-10)});
              var bds = map.getBounds(); //测试Bounds对象
              //var result = BMapLib.GeoUtils.isPointInRect(point, bds);
              //alert(point.lng);
              
              if ((point.lat > sw.lat&&point.lat < ne.lat) && (point.lng > sw.lng && point.lng < ne.lng))  {
                //setMarker(point,label);
                //
                var marker = setMarker(point,label);
                markers.push(marker);
              }
              });
              markerClusterer = new BMapLib.MarkerClusterer(map, {markers:markers});
              markerClusterer.setMaxZoom(18);
             //alert(markerClusterer.getGridSize());
            }
            
        });

      }
      function getCommunityInfo(){
        
        $.ajax({
         url: "../php/getPointsListInfo.php",  
         type: "GET",
         dataType: "json",
         error: function(data,status){ 
              alert(status); 
             alert('Error loading XML document');  
         },  
         success: function(data,status){//如果调用php成功
             alert("Success~")
             console.log(data)//解码，显示汉字
             var markers = [];

             $.each(data,function(i,item){
              var sw = map.getBounds().getSouthWest(); //返回矩形区域的西南角
              var ne = map.getBounds().getNorthEast(); //返回矩形区域的东北角
              //alert(item['position_x'])
              var point = new BMap.Point(parseFloat(item['position_x']) , parseFloat(item['position_y']));
              var label = new BMap.Label(item['community_name']+" "+item['house_number']+ " "+item['comminity_per_price'],{offset:new BMap.Size(20,-10)});
              var bds = map.getBounds(); //测试Bounds对象
              //var result = BMapLib.GeoUtils.isPointInRect(point, bds);
              //alert(point.lng);
              
              if ((point.lat > sw.lat&&point.lat < ne.lat) && (point.lng > sw.lng && point.lng < ne.lng))  {
                //setMarker(point,label);
                //
                var marker = setMarker(point,label);
                markers.push(marker);
              }
              });
             var markerClusterer = new BMapLib.MarkerClusterer(map, {markers:markers});
             markerClusterer.setMaxZoom(18);
             //alert(markerClusterer.getGridSize());
            }
         
        });
      }

      function setMarker(point,label){
        var marker = new BMap.Marker(point);
        label.setStyle({
          border:"0",
          fontSize : "12px",
          height : "20px",
          lineHeight : "20px",
          fontFamily:"微软雅黑",
          backgroundColor:"rgba(0,0,0,0.1)"
        });
        //map.addOverlay(marker);
        marker.setLabel(label);
        return marker;
      }

      map.addEventListener("click", getPointInfo);


    </script>

  </body>
</html>

