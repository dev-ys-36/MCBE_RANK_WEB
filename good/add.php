<!DOCTYPE html>
<html>
<head>
    <title>마인크래프트 BE 한국 서버 목록</title>

    <meta charset="utf-8">
    <meta name="description" content="마인크래프트 BE 한국 서버 목록, 마인크래프트 PE 한국 서버 목록, 마인크래프트 BE 24시간 한국 서버 목록, 마인크래프트 PE 24시간 한국 서버 목록">

    <!-- Mobile browser viewport -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Google AdSense -->
    <script data-ad-client="ca-pub-4109567926919554" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-158697158-1"></script>
    <script>window.dataLayer = window.dataLayer || [];function gtag(){dataLayer.push(arguments);}gtag('js', new Date());gtag('config', 'UA-158697158-1');</script>

    <!--Bootstrap CSS-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!--Bootstrap JS-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <style>
    .center {
        text-align: center;
    }
    .ce {
        width:800px;
        margin: 0 auto;
    }
    .card {
        margin: 0 auto;
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-primary navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="mcbe_logo" style="width: 170px; height:auto;">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="/search">쿼리 검색하기</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/add">서버 추가하기</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!--<div class="alert alert-primary" role="alert">
        <strong>공지 / 리뉴얼 전 사이트 <a href="/old">클릭</a></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <hr>사이트 문의는 <a href="https://open.kakao.com/o/siVsGWXb">이곳</a>을 클릭 해주세요!
        <br/>
    </div>-->
    <div class="alert alert-primary" role="alert">
        <strong>사이트 문의는 <a href="https://open.kakao.com/o/siVsGWXb">이곳</a>을 클릭 해주세요!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="container">
        <br/>
        <br/>
        <p>&nbsp;&nbsp;&nbsp;<small class="text-muted">배너를 클릭하면 해당 광고 사이트로 이동합니다..</small></p>
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="2500">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="https://pf.kakao.com/_hxcyxnT"><img class="d-block w-100" src="rp_cloud" alt="First slide"></a>
                </div>
                <div class="carousel-item">
                    <a href="https://cafe.naver.com/mcbecafe"><img class="d-block w-100" src="kk_cafe" alt="Second slide"></a>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <br/>
        <br/>
        <?php
        echo '<br/>';
        echo '<br/>';
        echo '<br/>';
        //var_dump($argv);
        echo '<form method="GET" action="/good">';
        echo '<div class="form-group">';
        //echo '<label>서버 추천하기.. (NOT ENABLE)</label>';
        echo '<br/>';
        echo '<label>서버 아이피</label>';
        if (isset($argv[1])){
            echo '<input type="text" name="ip" class="form-control" id="disabledInput" value="' . $argv[1] . '">';
        }else{
            echo '<input type="text" name="ip" class="form-control" id="disabledInput" value="">';
        }
        echo '<br/>';
        echo '<label>서버 포트</label>';
        if (isset($argv[2])){
            echo '<input type="text" name="port" class="form-control" id="disabledInput" value="' . $argv[2] . '">';
        }else{
            echo '<input type="text" name="port" class="form-control" id="disabledInput" value="">';
        }
        echo '<br/>';
        echo '<label>닉네임</label>';
        echo '<input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="ex) BleanSexy">';
        echo '<br/>';
        echo '<button type="submit" class="btn btn-primary">추천하기</button>';
        echo '</div>';
        echo '<form>';
        ?>
    </div>
</body>
<br/>
<br/>
<br/>
<!-- footer -->
	<div class="jumbotron text-center mt-5 mb-0">
		<h3 class="text-secondary">Kim Developer - MCBE</h3>
		<p>Copyright(C) 2020 <span class="text-primary">Kim_Developer</span>. All rights reserved.</p>
	</div>
</html>
