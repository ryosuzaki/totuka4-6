ここにユーザの情報の表示するHTMLを書く
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>戸塚ハッカソン</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- Material Kit CSS -->
    <link href="assets/css/material-kit.css?v=2.0.4" rel="stylesheet" />
    <!-- tablesorter -->
    <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
    <style type="text/css">
        .tablesorter-headerUnSorted {
            height:80%;
            background-image: url("{{asset('img/sort-icon.png')}}");
            background-repeat: no-repeat;
            background-size:auto 60%;
            background-position: center right;
        }
        .tablesorter-headerAsc {
            background-image: url("{{asset('img/sort-asc-icon.png')}}");
            background-repeat: no-repeat;
            background-size:auto 60%;
            background-position: center right;
        }
        .tablesorter-headerDesc {
            background-image: url("{{asset('img/sort-desc-icon.png')}}");
            background-repeat: no-repeat;
            background-size:auto 60%;
            background-position: center right;
        }
    </style>
  </head>
  <body>
<div class="app index-page sidebar-collapse">
  <nav class="navbar navbar-color-on-scroll navbar-expand-lg" color-on-scroll="100">
    <div class="container">
        <div class="navbar-translate">
          <a class="navbar-brand" href="{{ url('/') }}">戸塚ハッカソン</a>
  
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-expanded="false" aria-label="Toggle navigation">
              <span class="sr-only">Toggle navigation</span>
              <span class="navbar-toggler-icon"></span>
              <span class="navbar-toggler-icon"></span>
              <span class="navbar-toggler-icon"></span>
          </button>
        </div>
  
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="material-icons">run_circle</i>避難所マップ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="material-icons">warning</i>危険地点マップ</a>
            </li>
            <li class="nav-item dropdown"> 
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="material-icons">person</i>ユーザー<span class="caret"></span>
              </a>

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="{{ route('user.info') }}">
                      個人情報 確認・編集
                  </a>
                  <a class="dropdown-item" href="{{ route('user.belong') }}">
                      所属一覧
                  </a>
                  <a class="dropdown-item" href="{{ route('logout') }}"
                     onclick="event.preventDefault();
                                   document.getElementById('logout-form').submit();">
                      ログアウト
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
              </div>
          </li>
          </ul>
        </div>
    </div>
  </nav>
</div>
<main class="container">
  <!--ここに内容-->
    <h1>利用者情報</h1>
<details>
	<summary>基本情報</summary>		//利用者の「氏名」「性別」「生年月日」「住所」「電話番号」「位置情報サービス」
	<table>
		<tr><td>氏名</td><td>：山田太郎</td></tr>	
		<tr><td>性別</td><td>：男</td></tr>			
		<tr><td>生年月日</td><td>：1950年7月9日</td></tr>	
		<tr><td>住所</td><td>：〒xxx-xxxx　○○県○○市○○区○○町xx-xx</td></tr>	
		<tr><td>電話番号</td><td>：(xxx)xxx-xxxx</td></tr>	
		<tr><td>位置情報サービス</td><td>：ON</td></tr>		
	</table>
</details>

<details>
	<summary>家族情報</summary>		//家族の「氏名」「性別」「年齢」「続柄」「住所」「電話番号」「メール」
	<table>
		<tr><td>氏名</td><td>：山田一郎</td></tr>	
		<tr><td>性別</td><td>：男</td></tr>			
		<tr><td>年齢</td><td>：23歳</td></tr>		
		<tr><td>続柄</td><td>：息子</td></tr>		
		<tr><td>住所</td><td>：〒xxx-xxxx　○○県○○市○○区○○町xx-xx</td></tr>	
		<tr><td>電話番号</td><td>：(xxx)xxx-xxxx</td></tr>		
		<tr><td>メールアドレス</td><td>：xxxxx@xxxxx.xxx</td></tr>		
	</table>
</details>

<details>
	<summary>住まい</summary>		//住まいの状況「同居人の有無」「最寄りの避難所」
	<table>
		<tr><td>同居人の有無</td><td>：有</td></tr>			//
		<tr><td>最寄りの避難場所</td><td>：○○</td></tr>	//
	</table>
</details>

<details>
	<summary>医療</summary>
	<table>
		<tr><td>平熱</td><td>：36.2</td></tr>		//
		<tr><td>身長</td><td>：170.0</td></tr>		//
		<tr><td>体重</td><td>：61kg</td></tr>		//
	</table>
</details>

<details>
	<summary>薬の使用状況</summary>
	<table>
		<tr><td>アレルギー歴</td><td>：○○、○○</td></tr>	//
		<tr><td>既往歴</td><td>：○○</td></tr>				//
		<tr><td>手術歴</td><td>：○○</td></tr>				//
		<tr><td>かかりつけの病院</td><td>：○○</td></tr>	//
	</table>
</details>

<details>
	<summary>福祉</summary>
	<table>
		<tr><td>障害の有無</td><td>：聴覚、視覚、右足</td></tr>		//
		<tr><td>要支援・要介護認定</td><td>：有</td></tr>			//
		<tr><td>介護者の有無と続柄</td><td>：有（サービス提供者）</td></tr>		//
		<tr><td>介護サービスの有無</td><td>：有</td></tr>		//
		<tr><td>サービス内容</td><td>：在宅サービス</td></tr>		//
		<tr><td>利用サービス施設名称</td><td>：横浜市福祉サービス協会戸塚介護事務所</td></tr>	//
		<tr><td>在宅酸素療法</td><td>：無</td></tr>		//
		<tr><td>介助者</td><td>：有</td></tr>			//
	</table>
</details>

<details>
	<summary>使用するアプリ内容</summary>
	<table>
		<tr><td>平常時安否確認</td><td>：利用しない</td></tr>	//
		<tr><td>災害時安否確認</td><td>：通常版</td></tr>		//
		<tr><td>健康管理</td><td>：利用する</td></tr>			//
	</table>
</details>

</main>
<footer class="footer footer-default" >
  <div class="container">
    <nav class="float-left">
      <ul>
        <li>
          <a href="https://www.creative-tim.com/">
              Creative Tim
          </a>
        </li>
      </ul>
    </nav>
    <div class="copyright float-right">
        &copy;
        <script>
            document.write(new Date().getFullYear())
        </script>, made with <i class="material-icons">favorite</i> by
        <a href="https://www.creative-tim.com/" target="blank">Creative Tim</a> for a better web.
    </div>
  </div>
</footer>

<!--   Core JS Files   -->
<script src="assets/js/core/jquery.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap-material-design.min.js" type="text/javascript"></script>
<script src="assets/js/plugins/moment.min.js"></script>
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker -->
<script src="assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
<script src="assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
<!--  Google Maps Plugin  -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Kit: parallax effects, scripts for the example pages etc -->
<script src="assets/js/material-kit.js?v=2.0.4" type="text/javascript"></script></body>
</html>
